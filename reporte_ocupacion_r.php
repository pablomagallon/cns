<?php session_start ();
error_reporting(0);
include_once('lib/misFunciones.php');

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
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
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
            'servicio_nombre' => $datosServicio
        );
    }
    return $ret;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>REPORTE DE OCUPACION</title>
<style type="text/css">
	@import url("lib/impresion.css") print;
	@import url("lib/reportes.css") screen;
</style>
</head>
</head>

<body>

<?php $renglon = 0;
$out = "";
$reporte = "";

function cambiarPagina($reporteActual, $out) {
	$fechaInicio = $_GET['fechaI'];
	$fechaFin = $_GET['fechaF'];
	$claveUnidadMedica = "&nbsp;";
	$unidadMedica = "H.R. VALENTIN GOMEZ FARIAS, ZAPOPAN";
	$delegacion = "DELEGACION ESTATAL EN JALISCO";
	$reporte = $reporteActual . "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
	<td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
		<td width=\"74\" align=\"left\"><img src=\"diseno/logoEncabezado.png\" width=\"74\" height=\"74\" /></td>
		<td width=\"80\" class=\"tituloIssste\" align=\"left\">Instituto de<br />
		  Seguridad y<br />Servicios<br />Sociales de los<br />Trabajadores del<br />Estado</td>
		<td align=\"center\">SUBDIRECCIÓN GENERAL MÉDICA<br />Reporte de Ocupaci&oacute;n</td>
		<td width=\"150\" valign=\"bottom\" align=\"right\"><table width=\"150\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\">
		  <tr>
			<td class=\"tituloEncabezado\" align=\"center\">Fecha Inicio</td>
			<td class=\"tituloEncabezado\" align=\"center\">Fecha Fin</td>
		  </tr>
		  <tr>
			<td align=\"center\" class=\"contenido8bold\">" . $fechaInicio . "</td>
			<td align=\"center\" class=\"contenido8bold\">" . $fechaFin . "</td>
		  </tr>
		</table></td>
	  </tr>
	</table></td>
	  </tr>
	  <tr>
	<td align=\"left\" class=\"tituloEncabezadoConBorde\">Datos de la Unidad Médica</td>
	  </tr>
	  <tr>
	<td align=\"left\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"left\" width=\"20%\"><span class=\"contenido8bold\">Clave Unidad Médica: </span><span class=\"contenido8\">" . $claveUnidadMedica . "</span></td><td align=\"left\" width=\"40%\"><span class=\"contenido8bold\">Unidad Médica: </span><span class=\"contenido8\">" . $unidadMedica . "</span></td><td align=\"left\" width=\"40%\"><span class=\"contenido8bold\">Delegación: </span><span class=\"contenido8\">" . $delegacion . "</span></td></tr></table></td>
	  </tr>
	  <tr>
	<td align=\"left\" class=\"tituloEncabezadoConBorde\">&nbsp;</td>
	  </tr>
	  <tr>
	<td class=\"tituloEncabezadoConBorde\" height=\"2\"></td>
	  </tr>
	  <tr>
	<td><table width=\"100%\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
		<td width=\"10\" align=\"center\" class=\"contenido8bold\">Piso</td>
		<td width=\"30\" align=\"center\" class=\"contenido8bold\">Cedula</td>
		<td width=\"100\" align=\"center\" class=\"contenido8bold\">Nombre</td>
		<td width=\"50\" align=\"center\" class=\"contenido8bold\">Servicio Origen</td>
		<td width=\"15\" align=\"center\" class=\"contenido8bold\">Fecha y hora Ingreso</td>
		<td width=\"30\" align=\"center\" class=\"contenido8bold\">Dias Estancia</td>
		<td width=\"100\" align=\"center\" class=\"contenido8bold\">M&eacute;dico</td>
		<td width=\"50\" align=\"center\" class=\"contenido8bold\">Servicio</td>
		<td align=\"left\" class=\"contenido8bold\">Observaciones</td>
		</tr>" . $out . "
	</table></td>
	  </tr>
	</table><H1 class=\"SaltoDePagina\"> </H1>";
	return $reporte;
}


// reporte por consultorio

if ($_GET['tipoReporte'] == 'piso') {
	$ret = "";
	$camas = getCamasXpiso($_GET['piso']);
	$nCamas = count($camas);
	$piso = getPiso($_GET['piso']);

	for($i=0; $i<$nCamas; $i++) {
		if ($renglon < 14)
			$renglon++;
		else
			$renglon = 0;
		if (($renglon == 0) && ($out != "")) {
			$reporte = cambiarPagina($reporte, $out);
			$out = "";
		}
		$paciente = getDatosPacienteEnCama2014_2($camas[$i]['id_cama']);
		if ($paciente == "") {
			$out .= "<tr height=\"30\">
				<td align=\"left\" class=\"contenido8\"><small>" . $piso['nombre'] . " - " . $camas[$i]['descripcion'] . "</small></td>
				<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA VACIA</td>
				</tr>";
		} else {
			$historial = getHistorial($paciente['id_movimiento']);
			$nombre = $paciente['ap_p'] . " " . $paciente['ap_m'] . " " . $paciente['nombres'];
			$nombreM = $paciente['medico_ap_p'] . " " . $paciente['medico_ap_m'] . " " . $paciente['medico_nombres'];
			$nDias = getDiasEstancia($paciente['fecha_ingreso'], $paciente['hora_ingreso'], $_GET['piso']); 
			$out .= "<tr height=\"30\">
				<td align=\"left\" class=\"contenido8\"><small>" . $piso['nombre'] . " - " . $camas[$i]['descripcion'] . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . $paciente['cedula'] . "/" . $paciente['cedula_tipo'] . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($nombre) . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($paciente['procedencia']) . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . formatoDia($paciente['fecha_ingreso'],"fecha") . " - " . formatoHora($paciente['hora_ingreso']) . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . $nDias . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($nombreM) . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($paciente['servicio_nombre']) . "</small></td>
				<td align=\"left\" class=\"contenido8\"><small>DIAGNOSTICO: " . ponerAcentos($paciente['observaciones']) . "<br />" . $historial . "</small></td>
			  </tr>";
		}
	}
	$reporte = cambiarPagina($reporte, $out);
	echo $reporte;
}

// reporte por unidad
if ($_GET['tipoReporte'] == 'unidad') {
	$ret = "";
	$pisos = getPisos();
	$Npisos = count($pisos);

	for ($x=0; $x<$Npisos; $x++) {
		$camas = getCamasXpiso($pisos[$x]['id_piso']);
		$nCamas = count($camas);
		$piso = getPiso($pisos[$x]['id_piso']);
		for($i=0; $i<$nCamas; $i++) {
			if ($renglon < 14)
				$renglon++;
			else
				$renglon = 0;
			if (($renglon == 0) && ($out != "")) {
				$reporte = cambiarPagina($reporte, $out);
				$out = "";
			}
			$paciente = getDatosPacienteEnCama2014_2($camas[$i]['id_cama']);
			if ($paciente == "") {
				$out .= "<tr height=\"30\">
					<td align=\"left\" class=\"contenido8\"><small>" . $piso['nombre'] . " - " . $camas[$i]['descripcion'] . "</small></td>
					<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA VACIA</td>
					</tr>";
			} else {
				$historial = getHistorial($paciente['id_movimiento']);
				$nombre = $paciente['ap_p'] . " " . $paciente['ap_m'] . " " . $paciente['nombres'];
				$nombreM = $paciente['medico_ap_p'] . " " . $paciente['medico_ap_m'] . " " . $paciente['medico_nombres'];
				$nDias = getDiasEstancia($paciente['fecha_ingreso'], $paciente['hora_ingreso'], $$pisos[$x]['id_piso']); 
				$out .= "<tr height=\"30\">
					<td align=\"left\" class=\"contenido8\"><small>" . $piso['nombre'] . " - " . $camas[$i]['descripcion'] . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . $paciente['cedula'] . "/" . $paciente['cedula_tipo'] . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($nombre) . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($paciente['procedencia']) . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . formatoDia($paciente['fecha_ingreso'],"fecha") . " - " . formatoHora($paciente['hora_ingreso']) . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . $nDias . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($nombreM) . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>" . ponerAcentos($paciente['servicio_nombre']) . "</small></td>
					<td align=\"left\" class=\"contenido8\"><small>DIAGNOSTICO: " . ponerAcentos($paciente['observaciones']) . "<br />" . $historial . "</small></td>
				  </tr>";
			}
		}
	}
	$reporte = cambiarPagina($reporte, $out);
	echo $reporte;
}
?>
</body>
</html>
