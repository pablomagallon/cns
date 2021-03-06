<?php
session_start ();
include_once('lib/misFunciones.php');

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

$optionDiagnosticos = getOptionDiagnosticos();

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body class="soria">
<form id="formaCita" method="POST" action="javascript: validarBajaPaciente('<?php echo $datos_cama['id_piso'] ?>','<?php echo $_GET['id_cama'] ?>');">

<table width="700" border="0" cellspacing="0" cellpadding="0" class="ventana">
  <tr>
    <td colspan="3" class="tituloVentana">SALIDA DE PACIENTE EN <?php echo $datos_piso['nombre'] ?> - <?php echo $datos_cama['descripcion'] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">CEDULA: </td>
    <td align="left" colspan="2"><?php echo $datos['cedula'] . "/" . $datos['cedula_tipo'] ?>
    </td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">NOMBRE:</td>
    <td align="left" colspan="2"><?php echo ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) ?></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right" valign="top">SERVICIO:</td>
    <td colspan="2"><?php echo ponerAcentos($datos['servicio_nombre']) ?><br /><input type="button" name="modifica" id="modifica" value="Modificar Servicio" class="botones"  onclick="javascript: mostrarDiv('modificarServicio');" />
    <br />
    <div id="modificarServicio" style="display:none;">
    	<br />
		<table width="300" border="0" cellspacing="0" cellpadding="0" class="ventana">
          <tr>
            <td colspan="2" class="tituloVentana">MODIFICAR SERVICIO</td>
          </tr>
          <tr>
            <td class="textosParaInputs" align="right">SERVICIO:</td>
            <td><select name="servicio" id="servicio" onchange="javascript:opcionesMedicosReceta(this);"><?php echo $servicios; ?>
            </select></td>
          </tr>
          <tr>
            <td class="textosParaInputs" align="right">MEDICO:</td>
            <td><div id="medicos"><select name="medico" id="medico"><option value="0"> </option></select></div></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
          <input type="button" name="cerrar" id="cerrar" value="Cancelar" class="botones" onclick="javascript: ocultarDiv('modificarServicio');" />&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="modificar" id="modificar" value="Modificar" class="botones" onclick="javascript: modificarServicio('<?php echo $datos_cama['id_piso'] ?>','<?php echo $_GET['id_cama'] ?>');" />
          <br /><div id="enviandoModificacion">&nbsp;</div></td>
          </tr>
        </table>
        <br />
    </div>
    </td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">MEDICO:</td>
    <td colspan="2"><?php echo ponerAcentos($datos['medico_titulo'] . " " . $datos['medico_ap_p'] . " " . $datos['medico_ap_m'] . " " . $datos['medico_nombres']) ?></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">SERVICIO ORIGEN:</td>
    <td colspan="2"><?php echo ponerAcentos($datos['procedencia']) ?>
  </td>
  </tr>
  <tr>
  	<td class="textosParaInputs" align="right">FECHA DE INGRESO: </td>
    <td colspan="2"><?php echo formatoDia($datos['fecha_ingreso'],"fechaI") ?></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">FECHA DE SALIDA:</td>
    <td colspan="2"><input name="fecha" type="text" id="fecha" maxlength="10" value="<?php echo date('d/m/Y') ?>" /></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">TIPO:</td>
    <td colspan="2"><select name="tipo" id="tipo">
      <option value="0"> </option>
      <option value="CURACION">CURACION</option>
      <option value="MEJORIA">MEJORIA</option>
      <option value="SIN MEJORIA">SIN MEJORIA</option>
      <option value="DEFUNCION">DEFUNCION</option>
      <option value="PASE">PASE A OTRA UNIDAD</option>
      <option value="ALTA">ALTA VOLUNTARIA</option>
      <option value="CANCELACION">CANCELACION DE CIRUGIA</option>
      <option value="OTRO">OTRO MOTIVO</option>
    </select></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">OBSERVACIONES:</td>
    <td><textarea name="observaciones" cols="40" rows="4" id="observaciones"></textarea></td>
    <td><?php echo $foto; ?><input type="button" value="Reimprimir Brazalete" onclick="javascript: window.open('imprimirBrazalete.php?id_piso=<?php echo $datos_cama['id_piso'] ?>&id_cama=<?php echo $_GET['id_cama'] ?>')" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center">
  <input type="button" name="regresar" id="regresar" value="Regresar" class="botones"  onclick="javascript: infoPiso('<?php echo $datos_cama['id_piso'] ?>');" />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" name="agregar" id="agregar" value="Continuar" class="botones" />
  <br /><br /><div id="enviando">&nbsp;</div></td>
  </tr>
</table>
</form>
<br /><br />
<form id="formaCita2" method="POST" action="javascript: validarTransferencia('<?php echo $datos_cama['id_piso'] ?>','<?php echo $_GET['id_cama'] ?>','<?php echo $datos['id_derecho'] ?>');">

<table width="700" border="0" cellspacing="0" cellpadding="0" class="ventana">
  <tr>
    <td colspan="4" class="tituloVentana">TRANSFERIR PACIENTE A:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right" width="50">PISO: </td>
    <td align="left" width="50"><select id="piso" name="piso" onchange="javascript:listaCamasVacias(this);"><?php echo $listaPisos ?></select>
    </td>
    <td class="textosParaInputs" align="right" width="50">CAMA: </td>
    <td align="left"><div id="camas"><select name="cama" id="cama"><option value="0"> </option></select></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
  <input type="button" name="regresar" id="regresar" value="Regresar" class="botones"  onclick="javascript: infoPiso('<?php echo $datos_cama['id_piso'] ?>');" />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" name="agregar" id="agregar" value="Transferir" class="botones" />
  <div id="enviando">&nbsp;</div></td>
  </tr>
</table>
</form>

<br /><br />
<form id="modificar_obs" method="POST" action="javascript: validarModificarObs2014('<?php echo $_GET['id_cama'] ?>', '<?php echo $datos_cama['id_piso'] ?>','<?php echo $datos['id_movimiento'] ?>');">

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
    <td align="left" colspan="3">
        <div class="ui-widget">
          <select id="combobox" name="combobox">
          	<option value="" selected="selected"></option>
          	<?php echo $optionDiagnosticos; ?>
          </select>
        </div>
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
  <input type="button" name="regresar" id="regresar" value="Regresar" class="botones"  onclick="javascript: infoPiso('<?php echo $datos_cama['id_piso'] ?>');" />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" name="agregar" id="agregar" value="Modificar" class="botones" />
  <div id="enviando">&nbsp;</div></td>
  </tr>
</table>
</form>

</body>
</html>
