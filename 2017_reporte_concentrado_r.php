<?php session_start ();
error_reporting(0);
include_once('lib/misFunciones.php');


$medicamentos = array();

function getMedicamentosOrdenesXcama($id_cama, $fechaI, $fechaF) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    global $database_bdisssteF;
    global $medicamentos;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM ordenes WHERE id_cama='" . $id_cama . "' AND fecha  BETWEEN '" . $fechaI . "' AND '" . $fechaF . "' AND status='1' ORDER BY fecha DESC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
      do {
	    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
	    mysql_select_db($database_bdissste, $bdissste);
        $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "' AND (tipo='4' OR tipo='5')";
        $query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
        $row_query2 = mysql_fetch_assoc($query2);
        $totalRows_query2 = mysql_num_rows($query2);
        $ret2 = array();
      if ($totalRows_query2 > 0) {
          do {
			    $bdisssteF = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
			    mysql_select_db($database_bdisssteF, $bdisssteF);
		        $query_query3 = "SELECT * FROM medicamentos_censo WHERE id_medicamento='" . $row_query2['id_campos'] . "' AND status='1' LIMIT 1;";
		        $query3 = mysql_query($query_query3, $bdisssteF) or die(mysql_error());
		        $row_query3 = mysql_fetch_assoc($query3);
		        $row_query2["se_convierte"] = $row_query2["factor_conversion"] = $row_query2["unidad_conversion"] = $row_query2["fecha_conversion"] = $row_query2["presentacion"] = $row_query2["unidad"] = '';
		        if (count($row_query3) > 0) {
			        $row_query2["se_convierte"] = $row_query3["se_convierte"];
			        $row_query2["factor_conversion"] = $row_query3["factor_conversion"];
			        $row_query2["unidad_conversion"] = $row_query3["unidad_conversion"];
			        $row_query2["fecha_conversion"] = $row_query3["fecha"];
		        }
		        $query_query3 = "SELECT id_medicamento, presentacion, unidad  FROM medicamentos WHERE id_medicamento='" . $row_query2['id_campos'] . "' AND status='1' LIMIT 1;";
		        $query3 = mysql_query($query_query3, $bdisssteF) or die(mysql_error());
		        $row_query3 = mysql_fetch_assoc($query3);
		        if (count($row_query3) > 0) {
			        $row_query2["presentacion"] = $row_query3["presentacion"];
			        $row_query2["unidad"] = $row_query3["unidad"];
		        }
            	$medicamentos[$row_query2["tipo"]][$row_query2["id_campos"]][] = $row_query2;
          } while ($row_query2 = mysql_fetch_assoc($query2));
      }
//        $ret[] = array("id_orden" => $row_query["id_orden"], "id_cama" => $row_query["id_cama"], "id_derecho" => $row_query["id_derecho"], "id_medico" => $row_query["id_medico"], "id_servicio" => $row_query["id_servicio"], "fecha" => $row_query["fecha"], "fecha_agrego" => $row_query["fecha_agrego"], "fecha_modifico" => $row_query["fecha_modifico"], "status" => $row_query["status"], "extra" => $row_query["extra"], "id_usuario" => $row_query["id_usuario"], "conceptos" => $ret2);
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

$renglon = 0;
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
		<td align=\"center\">SUBDIRECCIÓN GENERAL MÉDICA<br />Reporte de Medicamentos Concentrados</td>
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

function cambiarPagina2017($out) {
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
		<td align=\"center\">SUBDIRECCIÓN GENERAL MÉDICA<br />Reporte de Medicamentos Concentrados</td>
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
	<td>" . $out . "
	</td>
	  </tr>
	</table><H1 class=\"SaltoDePagina\"> </H1>";
	return $reporte;
}



$aFecha = explode("-", $_GET['fechaI']);
$fechaI = $aFecha[2] . $aFecha[1] . $aFecha[0];
$aFecha = explode("-", $_GET['fechaF']);
$fechaF = $aFecha[2] . $aFecha[1] . $aFecha[0];

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
		$medicamentosTmp = getMedicamentosOrdenesXcama($camas[$i]['id_cama'], $fechaI, $fechaF);

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
	//echo $reporte;
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
			$medicamentosTmp = getMedicamentosOrdenesXcama($camas[$i]['id_cama'], $fechaI, $fechaF);
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
	//echo $reporte;
}
$renglon = 0;
$out = "";
$reporte = "";
$aTipos = array("4" => "SOLUCIONES", "5" => "MEDICAMENTOS");

$out .= '<table width="100%" border="1">';
foreach ($medicamentos as $tipo => $medi) {
	$out .= '<tr><th colspan="5" align="center">&nbsp;</th></tr>';
	$out .= '<tr><th colspan="5" align="center">' . $aTipos[$tipo] . '</th></tr>';
	$out .= '<tr><th>Código</th><th>Concepto</th><th>Total bruto</th><th>Total Unidades</th><th>Total Paquetes</th></tr>';
	foreach ($medi as $codigo => $med) {
	    $objT = json_decode(preg_replace("[\n|\r|\n\r|\t]", ' ', $med[0]["campos"]));
		$out .= '<tr><td align="left" class="contenido8">' . $codigo . '</td><td align="left" class="contenido8">' . $objT->concepto . '</td>';
		$total = $totalT = $totalP = $presentacion = 0;
		$factor_conversion = $factor_conversion2 = 1;
		$unidad_conversion = $unidad_conversion2 = $unidad = '';
		foreach ($med as $key => $m) {
			if ((float)$m["presentacion"]> 0) {
				$unidad_conversion = $m["unidad"];
				$factor_conversion = (float)$m["presentacion"];
			}
			if ($m["se_convierte"] == "s") {
				$unidad_conversion2 = $m["unidad_conversion"];
				$factor_conversion2 = (float)$m["factor_conversion"];
			}
		    $obj = json_decode(preg_replace("[\n|\r|\n\r|\t]", ' ', $m["campos"]));
		    $total += (float)$obj->cantidad;
			$totalT += ceil($total/$factor_conversion2);
			//$out .= '<tr><td colspan="2" align="right" class="contenido8">' . $obj->cantidad . '</td></tr>';
		}
		$totalP = ceil($totalT/$factor_conversion);
		$out .= '<td align="right" class="contenido8" style="padding-right:10px;">' . $total . '</td>';
		$out .= '<td align="right" class="contenido8" style="padding-right:10px;">' . $totalT . '</td>';
		$out .= '<td align="right" class="contenido8" style="padding-right:10px;">' . $totalP . '</td></tr>';
	}
}
$out .= '</table>';


switch ($_GET["tipo"]) {
	case 'excel':
		header('Content-Type: text/html; charset=utf-8');
		header("Content-type: application/vnd.ms-excel; name='excel'");
		header("Content-Disposition: filename=concentrado_" . date("Y-m-d-H-i-s") . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo utf8_decode(cambiarPagina2017($out));
		break;
	
	default:
	echo '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>REPORTE DE MEDICAMENTOS CONCENTRADOS</title>
			<style type="text/css">
				@import url("lib/impresion.css") print;
				@import url("lib/reportes.css") screen;
			</style>
			</head>
			</head>

			<body>
				' . cambiarPagina2017($out) . '
			</body>
			</html>';
		break;
}


?>


