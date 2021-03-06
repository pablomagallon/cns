<?php session_start ();
include_once('lib/misFunciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>REPORTE DE INGRESOS</title>
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
		<td align=\"center\">SUBDIRECCIÓN GENERAL MÉDICA<br />Reporte de Ingresos</td>
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
		<td width=\"10\" align=\"center\" class=\"contenido8bold\">Cama</td>
		<td width=\"30\" align=\"center\" class=\"contenido8bold\">Cedula</td>
		<td width=\"100\" align=\"center\" class=\"contenido8bold\">Nombre</td>
		<td width=\"50\" align=\"center\" class=\"contenido8bold\">Estado</td>
		<td width=\"50\" align=\"center\" class=\"contenido8bold\">Servicio Origen</td>
		<td width=\"15\" align=\"center\" class=\"contenido8bold\">Fecha Ingreso</td>
		<td width=\"10\" align=\"center\" class=\"contenido8bold\">Hora Ingreso</td>
		<td width=\"30\" align=\"center\" class=\"contenido8bold\">Dias Estancia</td>
		<td width=\"100\" align=\"center\" class=\"contenido8bold\">M&eacute;dico</td>
		<td width=\"50\" align=\"center\" class=\"contenido8bold\">Servicio</td>
		<td width=\"100\" align=\"center\" class=\"contenido8bold\">Observaciones</td>
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
		$paciente = getDatosPacienteEnCama($camas[$i]['id_cama']);
		if ($paciente == "") {
			$out .= "<tr height=\"30\">
				<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
				<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
				<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA VACIA</td>
				</tr>";
		} else {
			$fechaI = substr($_GET['fechaI'],6,4) . substr($_GET['fechaI'],3,2) . substr($_GET['fechaI'],0,2);
			$fechaF = substr($_GET['fechaF'],6,4) . substr($_GET['fechaF'],3,2) . substr($_GET['fechaF'],0,2);
			if (($fechaI <= $paciente['fecha_ingreso']) && ($paciente['fecha_ingreso'] <= $fechaF)) {
				$nombre = $paciente['ap_p'] . " " . $paciente['ap_m'] . " " . $paciente['nombres'];
				$nombreM = $paciente['medico_ap_p'] . " " . $paciente['medico_ap_m'] . " " . $paciente['medico_nombres'];
				$nDias = getDiasEstancia($paciente['fecha_ingreso'], $paciente['hora_ingreso'], $_GET['piso']); 
				$out .= "<tr height=\"30\">
					<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
					<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
					<td align=\"left\" class=\"contenido8\">" . $paciente['cedula'] . "/" . $paciente['cedula_tipo'] . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($nombre) . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['estado']) . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['procedencia']) . "</td>
					<td align=\"left\" class=\"contenido8\">" . formatoDia($paciente['fecha_ingreso'],"fecha") . "</td>
					<td align=\"left\" class=\"contenido8\">" . formatoHora($paciente['hora_ingreso']) . "</td>
					<td align=\"left\" class=\"contenido8\">" . $nDias . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($nombreM) . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['servicio_nombre']) . "</td>
					<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['observaciones']) . "</td>
				  </tr>";
			} else {
				$out .= "<tr height=\"30\">
					<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
					<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
					<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA OCUPADA</td>
					</tr>";
			}
		}
	}
	$reporte = cambiarPagina($reporte, $out);
	echo $reporte;
}

// reporte por unidad
if ($_GET['tipoReporte'] == 'unidad') {
	$ret = "";
	$out = "";
	$reporte = "";
	$pisos = getPisos();
	$Npisos = count($pisos);

	$fechaInicio = $_GET['fechaI'];
	$fechaFin = $_GET['fechaF'];
	$claveUnidadMedica = "&nbsp;";
	$unidadMedica = "H.R. VALENTIN GOMEZ FARIAS, ZAPOPAN";
	$delegacion = "DELEGACION ESTATAL EN JALISCO";
	$renglon = 0;
	$out = "";
	$reporte = "";
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
			$paciente = getDatosPacienteEnCama($camas[$i]['id_cama']);
			if ($paciente == "") {
				$out .= "<tr height=\"30\">
					<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
					<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
					<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA VACIA</td>
					</tr>";
			} else {
				$fechaI = substr($_GET['fechaI'],6,4) . substr($_GET['fechaI'],3,2) . substr($_GET['fechaI'],0,2);
				$fechaF = substr($_GET['fechaF'],6,4) . substr($_GET['fechaF'],3,2) . substr($_GET['fechaF'],0,2);
				if (($fechaI <= $paciente['fecha_ingreso']) && ($paciente['fecha_ingreso'] <= $fechaF)) {
					$nombre = $paciente['ap_p'] . " " . $paciente['ap_m'] . " " . $paciente['nombres'];
					$nombreM = $paciente['medico_ap_p'] . " " . $paciente['medico_ap_m'] . " " . $paciente['medico_nombres'];
					$nDias = getDiasEstancia($paciente['fecha_ingreso'], $paciente['hora_ingreso'], $$pisos[$x]['id_piso']); 
					$out .= "<tr height=\"30\">
						<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
						<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
						<td align=\"left\" class=\"contenido8\">" . $paciente['cedula'] . "/" . $paciente['cedula_tipo'] . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($nombre) . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['estado']) . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['procedencia']) . "</td>
						<td align=\"left\" class=\"contenido8\">" . formatoDia($paciente['fecha_ingreso'],"fecha") . "</td>
						<td align=\"left\" class=\"contenido8\">" . formatoHora($paciente['hora_ingreso']) . "</td>
						<td align=\"left\" class=\"contenido8\">" . $nDias . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($nombreM) . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['servicio_nombre']) . "</td>
						<td align=\"left\" class=\"contenido8\">" . ponerAcentos($paciente['observaciones']) . "</td>
					  </tr>";
				} else {
					$out .= "<tr height=\"30\">
						<td align=\"left\" class=\"contenido8\">" . $piso['nombre'] . "</td>
						<td align=\"left\" class=\"contenido8\">" . $camas[$i]['descripcion'] . "</td>
						<td colspan=\"10\" align=\"left\" class=\"contenido8\">CAMA OCUPADA</td>
						</tr>";
				}
			}
		}
	}
	$reporte = cambiarPagina($reporte, $out);
	echo $reporte;
}
?>
</body>
</html>
