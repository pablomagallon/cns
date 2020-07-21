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
    $query_query = "SELECT * FROM ordenes WHERE id_cama='" . $id_cama . "' AND id_derecho='" . $id_derecho . "' AND id_medico='" . $id_medico . "' AND id_servicio='" . $id_servicio . "' AND status='1' ORDER BY fecha DESC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
      do {
        $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "'";
        $query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
        $row_query2 = mysql_fetch_assoc($query2);
        $totalRows_query2 = mysql_num_rows($query2);
        $ret2 = array();
          if ($totalRows_query2 > 0) {
              do {
                  $ret2[] = $row_query2;
              } while ($row_query2 = mysql_fetch_assoc($query2));
          }
        $ret[] = array("id_orden" => $row_query["id_orden"], "id_cama" => $row_query["id_cama"], "id_derecho" => $row_query["id_derecho"], "id_medico" => $row_query["id_medico"], "id_servicio" => $row_query["id_servicio"], "fecha" => $row_query["fecha"], "fecha_agrego" => $row_query["fecha_agrego"], "fecha_modifico" => $row_query["fecha_modifico"], "status" => $row_query["status"], "extra" => $row_query["extra"], "id_usuario" => $row_query["id_usuario"], "conceptos" => $ret2);
      } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}



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
$tabla_conceptosP = '
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
  foreach ($orden as $key => $ord) {
    $expandida = "false";
    $collapse = "";
    if ($ord["fecha"] == $_GET["fecha"]) { $expandida = "true"; $collapse = " in"; }
    $tabla_conceptosP .= '
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading' . $ord["id_orden"] . '">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $ord["id_orden"] . '" aria-expanded="' . $expandida . '" aria-controls="collapse' . $ord["id_orden"] . '">
          ' . formatoDia($ord["fecha"], 'fecha') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript: void(0);" class="btn btn-xs btn-info" onclick="imprimirOrden(\'' . $ord["fecha"] . '\', \'' . $_GET['id_cama'] . '\', \'' . $datos['id_derecho'] . '\', \'' . $datos['id_medico'] . '\', \'' . $datos['id_servicio'] . '\', \'' . $_SESSION['idUsuario'] . '\');"><span class="fa fa-print"></span></a>
        </a>
      </h4>
    </div>
    <div id="collapse' . $ord["id_orden"] . '" class="panel-collapse collapse' . $collapse . '" role="tabpanel" aria-labelledby="heading' . $ord["id_orden"] . '">
      <div class="panel-body">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Tipo</th><th>Orden</th><th>Indicaciones</th><th>Creado</th><th>Aplicado</th>
                            </tr>
                          </thead>
                          <tbody>
    ';
    foreach ($ord["conceptos"] as $keyC => $conc) {
      $vFecha = $vHora = $vIdUsuario = $vNombre = $vIndicaciones = '';
      if ($conc["valores"] != '') {
        $valores = json_decode($conc["valores"]);
        $vFecha = $valores->fecha;
        $vHora = $valores->hora . '<br>';
        $vIdUsuario = $valores->id_usuario;
        $vNombre = '<small><small>' . $valores->nombre . '</small></small>';
        $vIndicaciones = $valores->indicaciones;
      }
      $aFecha = explode(" ", $conc["fecha_creacion"]);
      $obj = json_decode($conc["campos"]);
      $tabla_conceptosP .= '<tr><td>' . $obj->tipo . '</td><td><small>' . $obj->descripcion . '</small></td><td><small>' . $obj->indicaciones . '</small></td><td>' . $aFecha[1] . '</td><td>' . $vHora . $vNombre . '</td></tr>';
    }
    $tabla_conceptosP .= '
                          </tbody>
                        </table>
      </div>
    </div>
  </div>
    ';
  }
$tabla_conceptosP .= '</div>';
?>

  <div class="smart-wrap">
      <div class="smart-forms smart-flat smart-container wrap-1">
          <div class="form-header header-primary">
              <h4>ORDEN MEDICA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <small>fecha: <strong><?php echo formatoDia($_GET['fecha'],"fechaI") ?></strong></small></h4>
            </div><!-- end .form-header section -->
            
            <form method="post" action="" id="forma_guarda_orden">
              <input type="hidden" id="id_cama" value="<?php echo $_GET['id_cama']; ?>" />
              <input type="hidden" id="id_derecho" value="<?php echo $datos['id_derecho']; ?>" />
              <input type="hidden" id="id_medico" value="<?php echo $datos['id_medico']; ?>" />
              <input type="hidden" id="id_servicio" value="<?php echo $datos['id_servicio']; ?>" />
              <input type="hidden" id="fecha" value="<?php echo date("Ymd"); ?>" />
              <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['idUsuario']; ?>" />
              <div class="form-body">
                
                    <div class="spacer-b30">
                      <div class="tagline"><span> DATOS DE LA ORDEN MEDICA </span></div><!-- .tagline -->
                    </div>
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
                        NOMBRE DH: <strong><?php echo ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) ?></strong>
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
                    <div class="spacer-b30">
                      <div class="tagline"><span> ORDENES </span></div><!-- .tagline -->
                    </div>
                    <div class="frm-row">
                      <div class="section colm colm12">
                            <?php echo $tabla_conceptosP; ?>
                       </div>
                    </div>
              </div><!-- end .form-body section -->
                <div class="form-footer">
                  <button type="button" class="btn btn-sm btn-danger"  onclick="javascript: bajaPaciente_2017('<?php echo $_GET["id_cama"] ?>');"> Regresar </button>
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->
    
    <div></div><!-- end section -->
