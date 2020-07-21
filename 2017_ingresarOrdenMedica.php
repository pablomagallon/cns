<?php
session_start ();
include_once('lib/misFunciones.php');


function getOrdenMedicamentos($id_cama, $id_derecho, $id_medico, $id_servicio, $fecha) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM ordenes WHERE id_cama='" . $id_cama . "' AND id_derecho='" . $id_derecho . "' AND id_medico='" . $id_medico . "' AND id_servicio='" . $id_servicio . "' AND fecha='" . $fecha . "' AND status='1'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
      $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "' ORDER BY tipo ASC, id_concepto ASC";
      $query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
      $row_query2 = mysql_fetch_assoc($query2);
      $totalRows_query2 = mysql_num_rows($query2);
        if ($totalRows_query2 > 0) {
            do {
                $ret[] = $row_query2;
            } while ($row_query2 = mysql_fetch_assoc($query2));
        }
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}


function getOptionDiagnosticos() {
    global $hostname_bdissste;
    global $database_bdisssteC;
    global $username_bdisssteC;
    global $password_bdisssteC;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteC, $password_bdisssteC) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteC, $bdissste);
    $query_query = "SELECT * FROM cie_10_simef ORDER BY Clave ASC, Decripcion ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = '';
    if ($totalRows_query > 0) {
        do {
			$ret .= '<option value="' . $row_query['Clave'] . ' - ' . $row_query['Decripcion'] . '">' . $row_query['Clave'] . ' - ' . $row_query['Decripcion'] . '</option>';
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;

}

function getDiagnosticos($id_movimiento) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_diagnosticos WHERE id_movimiento='" . $id_movimiento . "' AND status='1' ORDER BY id ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
      do {
        $ret[] = $row_query;
      } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

//$optionDiagnosticos = getOptionDiagnosticos();

function getHistorial($id_movimiento) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_en_piso_observaciones WHERE id_movimiento='" . $id_movimiento . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = "";
    if ($totalRows_query > 0) {
		do {
			$ret .= formatoDia($row_query['fecha'], 'fecha') . ' ' . formatoHora($row_query['hora']) . '<small>';
			if (trim($row_query['pendientes']) != '') $ret .= ', Pendientes: ' . $row_query['pendientes'];
			if (trim($row_query['observaciones']) != '') $ret .= ', Observaciones: ' . $row_query['observaciones'];
			if (trim($row_query['interconsultas']) != '') $ret .= ', Interconsultas: ' . $row_query['interconsultas'];
			if (trim($row_query['diagnostico']) != '') $ret .= ', Diagn&oacute;stico: ' . $row_query['diagnostico'];
			$ret .= '</small><br />';
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return strtolower($ret);
}

function getDatosPacienteEnCama2014_2($id_cama) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_en_piso WHERE id_cama='" . $id_cama . "' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    $ret = "";
	$tmpHistorial = '';
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
        $tmpHistorial = getHistorial($row_query['id_movimiento']);
        $ret = array(
            'id_movimiento' => $row_query['id_movimiento'],
            'id_cama' => $row_query['id_cama'],
            'id_derecho' => $row_query['id_derecho'],
            'id_medico' => $row_query['id_medico'],
            'id_servicio' => $row_query['id_servicio'],
            'fecha_ingreso' => $row_query['fecha_ingreso'],
            'hora_ingreso' => $row_query['hora_ingreso'],
            'procedencia' => $row_query['procedencia'],
            'observaciones' => $row_query['observaciones'],
            'extra' => $row_query['extra1'],
            'cedula' => $datosPaciente['cedula'],
            'cedula_tipo' => $datosPaciente['cedula_tipo'],
            'ap_p' => $datosPaciente['ap_p'],
            'ap_m' => $datosPaciente['ap_m'],
            'nombres' => $datosPaciente['nombres'],
            'telefono' => $datosPaciente['telefono'],
            'direccion' => $datosPaciente['direccion'],
            'estado' => $datosPaciente['estado'],
            'medico_cedula' => $datosMedico['cedula'],
            'medico_cedula_tipo' => $datosMedico['cedula_tipo'],
            'medico_titulo' => $datosMedico['titulo'],
            'medico_ap_p' => $datosMedico['ap_p'],
            'medico_ap_m' => $datosMedico['ap_m'],
            'medico_nombres' => $datosMedico['nombres'],
			 'historial' => $tmpHistorial,
            'servicio_nombre' => $datosServicio
        );
    }
    return $ret;
}


$datos = getDatosPacienteEnCama2014_2($_GET['id_cama']);
$datos_cama = getDatosCama($_GET['id_cama']);
$datos_piso = getPiso($datos_cama['id_piso']);
$servicios = listaServicios();

$orden = getOrdenMedicamentos($_GET['id_cama'], $_GET["id_derecho"], $datos["id_medico"], $datos["id_servicio"], $_GET["fecha"]);

$pisos = getPisos();
$tPisos = count($pisos);
$listaPisos = "<option value= \"0\"> </option>";
for ($i=0; $i<$tPisos; $i++) {
	$listaPisos .= "<option value= \"" . $pisos[$i]['id_piso'] . "\">" . $pisos[$i]['nombre'] . "</option>";
}

$foto = '';
if (file_exists('fotosIngresos/' . $datos['id_derecho'] . '.jpg')) {
	$foto = '<img src="fotosIngresos/' . $datos['id_derecho'] . '.jpg" />';
}

?>

<?php 

$tabla_conceptosP = '';
$aliD = $aliC = $aliE = 0;
$enca='ALIMENTOS';
$imprime_enca = true;
$aTipos = array("SOLUCION" => "SOLUCIONES", "AUX. DIAGNOSTICO" => "AUX. DIAGNOSTICO", "CUIDADO" => "CUIDADOS", "MEDICAMENTO" => "MEDICAMENTOS");
  foreach ($orden as $key => $ord) {
    $vFecha = $vHora = $vIdUsuario = $vNombre = $vIndicaciones = '';
    if ($ord["valores"] != '') {
      $valores = json_decode(preg_replace("[\n|\r|\n\r|\t]", ' ', $ord["valores"]));
      $vFecha = $valores->fecha;
      $vHora = $valores->hora . '<br>';
      $vIdUsuario = $valores->id_usuario;
      $vNombre = '<small><small>' . $valores->nombre . '</small></small>';
      $vIndicaciones = $valores->indicaciones;
    }
    $aFecha = explode(" ", $ord["fecha_creacion"]);
    $obj = json_decode(preg_replace("[\n|\r|\n\r|\t]", ' ', $ord["campos"]));
    if ((int)$ord["tipo"] <= 2) { // son desayuno, comida o cena
      if ($enca != 'ALIMENTOS') $imprime_enca = true;
    } else {
      if ($enca != $aTipos[$obj->tipo]) {
        $imprime_enca = true;
        $enca = $aTipos[$obj->tipo];
      }
    }
    if ($imprime_enca) $tabla_conceptosP .= '<tr><th colspan="5" style="text-align:center">' . $enca . '</th></tr>';
    $tabla_conceptosP .= '<tr><td>' . $obj->tipo . '</td><td><small>' . $obj->descripcion . '</small></td><td><small>' . $obj->indicaciones . '</small></td><td>' . $aFecha[1] . '</td><td>' . $vHora . $vNombre . '</td></tr>';
    $imprime_enca = false;
    if ($obj->tipo == 'DESAYUNO') $aliD++;
    if ($obj->tipo == 'COMIDA') $aliC++;
    if ($obj->tipo == 'CENA') $aliE++;
  }

$tabla_diagnosticos = '';
if ($datos["observaciones"] != '') $tabla_diagnosticos .= '<tr><td><small>' . $datos["observaciones"] . '</small></td><td>' . formatoDia($datos['fecha_ingreso'],"fechaI") . ' ' . formatoHora($datos['hora_ingreso']) . '</td><td></td></tr>';
$diagnosticos = getDiagnosticos($datos["id_movimiento"]);
if (count($diagnosticos) > 0) {
  foreach ($diagnosticos as $key => $diag) {
    $tabla_diagnosticos .= '<tr><td><small>' . $diag["diagnostico"] . '</small></td><td>' . formatoDia($diag['fecha'],"fechaI") . ' ' . formatoHora($diag['hora']) . '</td><td></td></tr>';
  }
}

?>

  <div class="smart-wrap">
      <div class="smart-forms smart-flat smart-container wrap-1">
          <div class="form-header header-primary">
              <h4>ORDEN MEDICA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <small>fecha: <strong><?php echo formatoDia($_GET['fecha'],"fechaI") ?></strong></small></h4>
            </div><!-- end .form-header section -->
            
              <div class="form-body">
                
                    <div class="frm-row">
                      <div class="section colm colm6 align-left">
                        PISO Y CAMA: <strong><?php echo $datos_piso['nombre'] ?> - <?php echo $datos_cama['descripcion'] ?></strong>
                      </div>
                      <div class="section colm colm6 align-left">
                        FECHA DE INGRESO: <strong><?php echo formatoDia($datos['fecha_ingreso'],"fechaI") ?></strong>
                      </div>
                    </div>
                    <div class="frm-row">
                      <div class="section colm colm6 align-left">
                        CEDULA: <strong><?php echo $datos['cedula'] . "/" . $datos['cedula_tipo'] ?></strong>
                      </div>
                      <div class="section colm colm6 align-left">
                        NOMBRE: <strong><?php echo ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) ?></strong>
                      </div>
                    </div>
                    <div class="frm-row">
                      <div class="section colm colm6 align-left">
                        MEDICO: <strong><?php echo ponerAcentos($datos['medico_titulo'] . " " . $datos['medico_ap_p'] . " " . $datos['medico_ap_m'] . " " . $datos['medico_nombres']) ?></strong>
                      </div>
                      <div class="section colm colm6 align-left">
                        SERVICIO: <strong><?php echo ponerAcentos($datos['servicio_nombre']) ?></strong>
                      </div>
                    </div>
                    <div class="spacer-b30 spacer-t30">
                      <div class="tagline"><span><a href="javascript: void(0);" onclick="toggle_div_diagnosticos();" class="btn btn-info" style="margin-top:-15px;"> DIGANOSTICOS Y OBSERVACIONES </a></span></div><!-- .tagline -->
                    </div>
                    <div class="frm-row" id="div_diagnosticos" style="display: none;">
                      <div class="section colm colm12">
                                  <form id="modificar_obs" method="POST" action="javascript: validarModificarObs2014('<?php echo $_GET['id_cama'] ?>', '<?php echo $datos['id_derecho'] ?>','<?php echo date('Ymd') ?>','<?php echo $datos["id_movimiento"] ?>');">

                                  <table width="700" border="0" cellspacing="0" cellpadding="0" class="ventana">
                                    <tr>
                                      <td colspan="4" class="tituloVentana">MODIFICAR OBSERVACIONES A PACIENTE:</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="textosParaInputs" align="right" width="70">DIAGNOSTICO DE INGRESO: </td>
                                      <td align="left" style="padding-left:10px;">
                                          <?php echo $datos["observaciones"]; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="textosParaInputs" align="right" width="70" valign="top">HISTORIAL: </td>
                                      <td align="left" style="padding-left:10px;">
                                          <?php echo $datos["historial"]; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="textosParaInputs" align="right">PENDIENTES: </td>
                                      <td align="left" style="padding-left:10px;">
                                          <textarea id="pendientes_mod" name="pendientes_mod" cols="40" rows="4"></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="textosParaInputs" align="right">OBSERVACIONES: </td>
                                      <td align="left" style="padding-left:10px;">
                                          <textarea id="observaciones_mod" name="observaciones_mod" cols="40" rows="4"></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="25" class="textosParaInputs" align="right">INTERCONSULTAS: </td>
                                      <td align="left" style="padding-left:10px;">
                                      <table width="300" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="textosParaInputs" align="right">SERVICIO:</td>
                                              <td><select name="servicio_mod" id="servicio_mod" onchange="javascript:opcionesMedicosReceta2014(this);"><?php echo $servicios; ?>
                                              </select></td>
                                            </tr>
                                            <tr>
                                              <td class="textosParaInputs" align="right">MEDICO:</td>
                                              <td><div id="medicos_mod"><select name="medico_mod" id="medico_mod"><option value="0"> </option></select></div></td>
                                            </tr>
                                          </table>        
                                              
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="textosParaInputs" align="right">DIAGNOSTICO:</td>
                                      <td align="left" colspan="3" style="padding-left:10px;">
                                          <input type="hidden" name="diagnostico_mod" id="diagnostico_mod" value="" />
                                          <input type="text" name="combobox" id="combobox" />
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="textosParaInputs" align="right">FOLIO: </td>
                                      <td align="left" style="padding-left:10px;">
                                          <input type="text" name="folio_mod" id="folio_mod" value="" />
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" align="center">
                                    <input type="submit" name="agregar" id="agregar" value="Modificar" class="btn btn-success" style="color:#FFF;" />
                                    <div id="enviando">&nbsp;</div></td>
                                    </tr>
                                  </table>
                                  </form>
                      </div>
                    </div>
                    <div class="spacer-b30 spacer-t30">
                      <div class="tagline"><span> DATOS DE LA ORDEN MEDICA </span></div><!-- .tagline -->
                    </div>
            <form method="post" action="" id="forma_guarda_orden">
              <input type="hidden" id="id_cama" value="<?php echo $_GET['id_cama']; ?>" />
              <input type="hidden" id="id_derecho" value="<?php echo $datos['id_derecho']; ?>" />
              <input type="hidden" id="id_medico" value="<?php echo $datos['id_medico']; ?>" />
              <input type="hidden" id="id_servicio" value="<?php echo $datos['id_servicio']; ?>" />
              <input type="hidden" id="fecha" value="<?php echo date("Ymd"); ?>" />
              <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['idUsuario']; ?>" />
              <input type="hidden" id="aliD" value="<?php echo $aliD; ?>" />
              <input type="hidden" id="aliC" value="<?php echo $aliC; ?>" />
              <input type="hidden" id="aliE" value="<?php echo $aliE; ?>" />
                    <div class="frm-row">
                      <div class="section colm colm12">
                        <table id="tabla_conceptosP" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Tipo</th><th>Orden</th><th>Indicaciones</th><th>Creado</th><th>Aplicado</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php echo $tabla_conceptosP; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="spacer-b30">
                      <div class="tagline"><span> AGREGAR CONCEPTOS </span></div><!-- .tagline -->
                    </div>
                    <div class="frm-row">
                      <div class="section colm colm2">
                        <a class="btn btn-info" href="javascript: void(0);" id="btn_modal_alimentos">ALIMENTOS</a>
                      </div>
                      <div class="section colm colm2">
                        <a class="btn btn-info" href="javascript: void(0);" id="btn_modal_cuidados">CUIDADOS</a>
                      </div>
                      <div class="section colm colm2">
                        <a class="btn btn-info" href="javascript: void(0);" id="btn_modal_soluciones">SOLUCIONES</a>
                      </div>
                      <div class="section colm colm3">
                        <a class="btn btn-info" href="javascript: void(0);" id="btn_modal_medicamentos">MEDICAMENTOS</a>
                      </div>
                      <div class="section colm colm3">
                        <a class="btn btn-info" href="javascript: void(0);" id="btn_modal_procedimientos">AUX. DIAGNOSTICO</a>
                      </div>
                    </div>
                    <div class="frm-row">
                      <div class="section colm colm12">
                        <table id="tabla_conceptos" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Tipo</th><th>Orden</th><th>Indicaciones</th><th width="10"></th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>


                    <div id="modal_alimentos" class="smart-wrap" style="display: none;">
                        <div class="smart-forms smart-container wrap-2">
                            <div class="form-header header-primary">
                                <h3>Orden de Alimentos</h3>
                            </div><!-- .smartforms-modal-header -->
                            <form method="post" action="" id="alimento_form">
                              <div class="form-body" style="padding-left: 0px; padding-right: 0px;">
                                <div class="frm-row">
                                    <div class="section colm colm4"><h4>DESAYUNO</h4>
                                        <table class="table table-bordered table-hover" style="font-size:9px;" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td></td><th>NO.</th><th>DI.</th><th>HI.</th><th>S/G</th>
                                          </tr>                                          
                                         <tr>
                                            <th>NORMAL</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_n_n" id="d_n_n" value="NORMAL NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_n_d" id="d_n_d" value="NORMAL DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_n_h" id="d_n_h" value="NORMAL HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_n_s" id="d_n_s" value="NORMAL SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>BLANDA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_b_n" id="d_b_n" value="BLANDA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_b_d" id="d_b_d" value="BLANDA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_b_h" id="d_b_h" value="BLANDA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_b_s" id="d_b_s" value="BLANDA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>SECA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_s_n" id="d_s_n" value="SECA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_s_d" id="d_s_d" value="SECA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_s_h" id="d_s_h" value="SECA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_s_s" id="d_s_s" value="SECA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>PAPILLA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_p_n" id="d_p_n" value="PAPILLA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_p_d" id="d_p_d" value="PAPILLA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_p_h" id="d_p_h" value="PAPILLA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_p_s" id="d_p_s" value="PAPILLA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>LICUADA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_l_n" id="d_l_n" value="LICUADA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_l_d" id="d_l_d" value="LICUADA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_l_h" id="d_l_h" value="LICUADA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_l_s" id="d_l_s" value="LICUADA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>GASTRO.</th><td align="center"><input class="chk_alimentos" type="checkbox" name="d_g_n" id="d_g_n" value="GASTROCLISIS NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_g_d" id="d_g_d" value="GASTROCLISIS DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_g_h" id="d_g_h" value="GASTROCLISIS HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="d_g_s" id="d_g_s" value="GASTROCLISIS SIN GRASAS" /></td>
                                          </tr>
                                          <tr>
                                            <td colspan="5"><textarea name="dObservaciones" id="dObservaciones" placeholder="Indicaciones Desayuno" style="width:100%" rows="3"></textarea></td>
                                          </tr>
                                        </table>
                                    </div><!-- end section -->
                                    <div class="section colm colm4"><h4>COMIDA</h4>
                                        <table class="table table-bordered table-hover" style="font-size:9px;">
                                          <tr>
                                            <td></td><th>NO.</th><th>DI.</th><th>HI.</th><th>S/G</th>
                                          </tr>                                          
                                         <tr>
                                            <th>NORMAL</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_n_n" id="c_n_n" value="NORMAL NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_n_d" id="c_n_d" value="NORMAL DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_n_h" id="c_n_h" value="NORMAL HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_n_s" id="c_n_s" value="NORMAL SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>BLANDA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_b_n" id="c_b_n" value="BLANDA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_b_d" id="c_b_d" value="BLANDA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_b_h" id="c_b_h" value="BLANDA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_b_s" id="c_b_s" value="BLANDA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>SECA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_s_n" id="c_s_n" value="SECA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_s_d" id="c_s_d" value="SECA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_s_h" id="c_s_h" value="SECA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_s_s" id="c_s_s" value="SECA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>PAPILLA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_p_n" id="c_p_n" value="PAPILLA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_p_d" id="c_p_d" value="PAPILLA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_p_h" id="c_p_h" value="PAPILLA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_p_s" id="c_p_s" value="PAPILLA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>LICUADA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_l_n" id="c_l_n" value="LICUADA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_l_d" id="c_l_d" value="LICUADA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_l_h" id="c_l_h" value="LICUADA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_l_s" id="c_l_s" value="LICUADA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>GASTRO.</th><td align="center"><input class="chk_alimentos" type="checkbox" name="c_g_n" id="c_g_n" value="GASTROCLISIS NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_g_d" id="c_g_d" value="GASTROCLISIS DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_g_h" id="c_g_h" value="GASTROCLISIS HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="c_g_s" id="c_g_s" value="GASTROCLISIS SIN GRASAS" /></td>
                                          </tr>                                          
                                          <tr>
                                            <td colspan="5"><textarea name="cObservaciones" id="cObservaciones" placeholder="Indicaciones Comida" style="width:100%" rows="3"></textarea></td>
                                          </tr>
                                        </table>
                                    </div><!-- end section -->
                                    <div class="section colm colm4"><h4>CENA</h4>
                                        <table class="table table-bordered table-hover" style="font-size:9px;">
                                          <tr>
                                            <td></td><th>NO.</th><th>DI.</th><th>HI.</th><th>S/G</th>
                                          </tr>                                          
                                         <tr>
                                            <th>NORMAL</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_n_n" id="e_n_n" value="NORMAL NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_n_d" id="e_n_d" value="NORMAL DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_n_h" id="e_n_h" value="NORMAL HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_n_s" id="e_n_s" value="NORMAL SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>BLANDA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_b_n" id="e_b_n" value="BLANDA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_b_d" id="e_b_d" value="BLANDA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_b_h" id="e_b_h" value="BLANDA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_b_s" id="e_b_s" value="BLANDA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>SECA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_s_n" id="e_s_n" value="SECA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_s_d" id="e_s_d" value="SECA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_s_h" id="e_s_h" value="SECA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_s_s" id="e_s_s" value="SECA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>PAPILLA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_p_n" id="e_p_n" value="PAPILLA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_p_d" id="e_p_d" value="PAPILLA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_p_h" id="e_p_h" value="PAPILLA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_p_s" id="e_p_s" value="PAPILLA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>LICUADA</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_l_n" id="e_l_n" value="LICUADA NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_l_d" id="e_l_d" value="LICUADA DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_l_h" id="e_l_h" value="LICUADA HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_l_s" id="e_l_s" value="LICUADA SIN GRASAS" /></td>
                                          </tr>                                          
                                         <tr>
                                            <th>GASTRO.</th><td align="center"><input class="chk_alimentos" type="checkbox" name="e_g_n" id="e_g_n" value="GASTROCLISIS NORMAL" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_g_d" id="e_g_d" value="GASTROCLISIS DIABETICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_g_h" id="e_g_h" value="GASTROCLISIS HIPOSODICA" /></td><td align="center"><input class="chk_alimentos" type="checkbox" name="e_g_s" id="e_g_s" value="GASTROCLISIS SIN GRASAS" /></td>
                                          </tr>                                          
                                          <tr>
                                            <td colspan="5"><textarea name="eObservaciones" id="eObservaciones" placeholder="Indicaciones Cena" style="width:100%" rows="3"></textarea></td>
                                          </tr>
                                        </table>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer">
                                    <div style="float: left; text-align:left; margin-left: 10px;">
                                      <small>
                                        NO. = Normal<br>
                                        DI. = Diabética<br>
                                        HI. = Hiposódica<br>
                                        S/G. = Sin Grasa
                                      </small>
                                    </div>
                                    <div style="float:right; margin-right: 10px;">
                                      <button type="button" class="btn btn-warning" onclick="validar_alimentos()"> AGREGAR CONCEPTOS A LA ORDEN </button>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div><!-- end .form-footer section -->                                                          
                              </div><!-- .smartforms-modal-body -->
                            </form>                                                                                   
                        </div><!-- .smartforms-modal-container -->
                    </div><!-- .smartforms-modal 1 -->

                    <div id="modal_cuidados" class="smart-wrap" style="display: none;">
                        <div class="smart-forms smart-container wrap-2">
                            <div class="form-header header-primary">
                                <h3>Orden de Cuidados</h3>
                            </div><!-- .smartforms-modal-header -->
                            <form method="post" action="" id="cuidados_form">
                              <div class="form-body">
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa la descripción de cuidados
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="cuidados_texto" name="cuidados_texto" placeholder="Cuidados" data-rule-required="true" data-msg-required="ingresa la descripción de cuidados"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="button" class="btn btn-warning" onclick="validar_cuidados()"> AGREGAR CONCEPTO A LA ORDEN </button>
                                </div><!-- end .form-footer section -->                                                          
                              </div><!-- end .form-body section -->
                            </form>                                                                                   
                        </div><!-- .smartforms-modal-container -->
                    </div><!-- .smartforms-modal 1 -->

                    <div id="modal_soluciones" class="smart-wrap" style="display: none;">
                        <div class="smart-forms smart-container wrap-2">
                            <div class="form-header header-primary">
                                <h3>Orden de Soluciones</h3>
                            </div><!-- .smartforms-modal-header -->
                            <form method="post" action="" id="soluciones_form">
                              <div class="form-body">
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa la clave o nombre de la solución
                                      <label class="field prepend-icon">
                                          <input type="hidden" value="" id="soluciones_sel" name="soluciones_sel" />
                                          <textarea class="gui-textarea" style="font-size:10px; padding:4px; line-height:12px; height: 50px;" id="soluciones_sol" name="soluciones_sol" placeholder="Ingresa la clave o nombre de la solución" data-rule-required="true" data-msg-required="selecciona la solución"></textarea>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                     <div class="section colm colm4">Cantidad
                                      <label class="field">
                                          <input type="text" name="soluciones_cantidad" id="soluciones_cantidad" class="gui-input" placeholder="" data-rule-required="true" data-msg-required="Ingresa cantidad">
                                      </label>
                                       <strong><div style="float: left;">Pres:&nbsp;</div><div id="presentacion_sol" style="float: left;"></div> <div id="unidad_sol" style="float: left;"></div></strong>
                                     </div><!-- end section -->
                                     <div class="section colm colm4">Vía de administración
                                      <label class="field select">
                                          <select name="soluciones_via" id="soluciones_via" data-rule-required="true" data-msg-required="Selecciona opción">
                                              <option value="" selected>Selecciona...</option>
                                              <option value="I.V.">I.V.</option>
                                              <option value="V.O.">V.O.</option>
                                          </select>
                                          <i class="arrow double"></i>
                                      </label>
                                    </div><!-- end section -->
                                    <div class="section colm colm4">Periodo (Hrs.)
                                      <label class="field">
                                          <input type="text" name="soluciones_periodo" id="soluciones_periodo" class="gui-input" placeholder="" data-rule-required="true" data-msg-required="Ingresa periodo">
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa indicaciones
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="soluciones_texto" name="soluciones_texto" placeholder="Indicaciones"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="button" class="btn btn-warning" onclick="validar_soluciones()"> AGREGAR SOLUCION A LA ORDEN </button>
                                </div><!-- end .form-footer section -->                                                          
                              </div><!-- end .form-body section -->
                          </form>                                                                                   
                        </div><!-- .smartforms-modal-container -->
                    </div><!-- .smartforms-modal 1 -->

                    <div id="modal_medicamentos" class="smart-wrap" style="display: none;">
                        <div class="smart-forms smart-container wrap-2">
                            <div class="form-header header-primary">
                                <h3>Orden de Medicamentos</h3>
                            </div><!-- .smartforms-modal-header -->
                            <form method="post" action="" id="medicamentos_form">
                              <div class="form-body">
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa la clave o nombre del medicamento
                                      <label class="field prepend-icon">
                                          <input type="hidden" value="" id="medicamentos_sel" name="medicamentos_sel" />
                                          <textarea class="gui-textarea" style="font-size:10px; padding:4px; line-height:12px; height: 50px;" id="medicamentos_med" name="medicamentos_med" placeholder="Ingresa la clave o nombre del medicamento"></textarea>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                     <div class="section colm colm4">Cantidad
                                      <label class="field">
                                          <input type="text" name="medicamentos_cantidad" id="medicamentos_cantidad" class="gui-input" placeholder="" data-rule-required="true" data-msg-required="Ingresa cantidad">
                                      </label>
                                       <strong><div style="float: left;">Pres:&nbsp;</div><div id="presentacion_med" style="float: left;"></div> <div id="unidad_med" style="float: left;"></div></strong>
                                     </div><!-- end section -->
                                     <div class="section colm colm4">Vía de administración
                                      <label class="field select">
                                          <select name="medicamento_via" id="medicamento_via" data-rule-required="true" data-msg-required="Selecciona opción">
                                              <option value="" selected>Selecciona...</option>
                                              <option value="I.V.">I.V.</option>
                                              <option value="V.O.">V.O.</option>
                                          </select>
                                          <i class="arrow double"></i>
                                      </label>
                                    </div><!-- end section -->
                                    <div class="section colm colm4">Periodo (Hrs.)
                                      <label class="field">
                                          <input type="text" name="medicamentos_periodo" id="medicamentos_periodo" class="gui-input" placeholder="" data-rule-required="true" data-msg-required="Ingresa periodo">
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa indicaciones
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="medicamentos_texto" name="medicamentos_texto" placeholder="Indicaciones"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="button" class="btn btn-warning" onclick="validar_medicamentos();"> AGREGAR MEDICAMENTO A LA ORDEN </button>
                                </div><!-- end .form-footer section -->                                                          
                              </div><!-- end .form-body section -->
                            </form>                                                                                   
                        </div><!-- .smartforms-modal-container -->
                    </div><!-- .smartforms-modal 1 -->


                    <div id="modal_procedimientos" class="smart-wrap" style="display: none;">
                        <div class="smart-forms smart-container wrap-2">
                            <div class="form-header header-primary">
                                <h3>Orden de Auxiliares de Diagnóstico</h3>
                            </div><!-- .smartforms-modal-header -->
                            <form method="post" action="" id="procedimientos_form">
                              <div class="form-body">
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa la clave o nombre del procedimiento
                                      <label class="field">
                                          <input type="hidden" value="" id="procedimeintos_sel" name="procedimeintos_sel" />
                                          <input type="text" name="procedimientos_pro" id="procedimientos_pro" class="gui-input" placeholder="Ingresa el procedimiento" data-rule-required="true" data-msg-required="Selecciona opción">
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Ingresa indicaciones
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="procedimientos_texto" name="procedimientos_texto" placeholder="Indicaciones"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="button" class="btn btn-warning" onclick="validar_procedimientos();"> AGREGAR AUX. DE DIAGNOSTICO A LA ORDEN </button>
                                </div><!-- end .form-footer section -->                                                          
                              </div><!-- end .form-body section -->
                            </form>                                                                                   
                        </div><!-- .smartforms-modal-container -->
                    </div><!-- .smartforms-modal 1 -->

              </div><!-- end .form-body section -->
                <div class="form-footer">
                  <button type="button" class="btn btn-sm btn-danger"  onclick="javascript: bajaPaciente_2017('<?php echo $_GET["id_cama"] ?>');"> Regresar </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="button" class="btn btn-l btn-success" id="botonGuardaOrdenMedica" onclick="guardaOrdenMedica()"> ---- GUARDAR LA ORDEN MEDICA ---- </button>
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->
    
    <div></div><!-- end section -->
