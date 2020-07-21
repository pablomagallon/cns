<?php session_start ();
error_reporting(0);
include_once('lib/misFunciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>HOJA DE ORDENES MEDICAS</title>
<style type="text/css">
	@import url("lib/impresion.css") print;
	@import url("lib/reportes.css") screen;
</style>
</head>
</head>

<body>

<?php
$renglon = 0;
$out = "";
$reporte = "";


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

function getUltimasOrdenes($id_cama, $id_derecho, $id_medico, $id_servicio, $fecha) {
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
    $ultimaHora = '';
    if ($totalRows_query > 0) {
      $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "'";
      $query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
      $row_query2 = mysql_fetch_assoc($query2);
      $totalRows_query2 = mysql_num_rows($query2);
        if ($totalRows_query2 > 0) {
            do {
                $ultimaHora = $row_query2["fecha_creacion"];
            } while ($row_query2 = mysql_fetch_assoc($query2));
        }
      $query_query3 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "' AND fecha_creacion='" . $ultimaHora . "' ORDER BY tipo ASC";
      $query3 = mysql_query($query_query3, $bdissste) or die(mysql_error());
      $row_query3 = mysql_fetch_assoc($query3);
      $totalRows_query3 = mysql_num_rows($query3);
        if ($totalRows_query3 > 0) {
            do {
                $ret[] = $row_query3;
            } while ($row_query3 = mysql_fetch_assoc($query3));
        }
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

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
      $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "' ORDER BY tipo ASC";
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

function cambiarPagina($reporteActual, $out, $datos, $nombre_medico) {
	$fechaInicio = $_GET['fechaI'];
	$fechaFin = $_GET['fechaF'];
	$claveUnidadMedica = "&nbsp;";
	$unidadMedica = "H.R. VALENTIN GOMEZ FARIAS, ZAPOPAN";
	$reporte = $reporteActual . '
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom: solid 4px #000;">
						<tr>
							<td width="74" align="left"><img src="diseno/logoEncabezado.png" width="74" height="74" /></td>
							<td width="130" class="tituloIssste" align="left">Instituto de Seguridad<br /> y Servicios Sociales de los<br />Trabajadores del Estado</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2" align="center" class="tituloIssste">Dirección Médica</td>
							<td align="center">HOSPITAL REGIONAL "DR. VALENTIN GOMEZ FARIAS"</td>
						</tr>
					</table>
					<p align="right"><small>LICENCIA SANITARIA 0000C380-A</small></p>
					<p align="center"><b>HOJA DE ORDENES MEDICAS</b></p>
				</td>
			<tr>
				<td align="left">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="left" colspan="2" width="60%"><span class="contenido8bold">Nombre: </span><span class="contenido8">' . ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) . '</span></td>
							<td align="left" width="40%"><span class="contenido8bold">No.: </span><span class="contenido8"></span></td>
						</tr>
						<tr>
							<td align="left"><span class="contenido8bold">Cédula o Exp. No.: </span><span class="contenido8">' . $datos['cedula'] . "/" . $datos['cedula_tipo'] . '</span></td>
							<td align="left"><span class="contenido8bold">Servicio: </span><span class="contenido8">' . ponerAcentos($datos['servicio_nombre']) . '</span></td>
							<td align="left"><span class="contenido8bold">Cama: </span><span class="contenido8">' . $datos['cama_descripcion'] . '</span></td>
						</tr>
					</table>
				</td>
			</tr>
			</tr>
	  <tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #999999;">
				<tr>
					<td width="30" align="center" class="contenido8bold" style="padding: 0 2px;">FECHA</td>
					<td width="30" align="center" class="contenido8bold" style="padding: 0 2px;">HORA</td>
					<td align="center" class="contenido8bold" style="padding: 0 2px;">ORDENES</td>
					<td width="30" align="center" class="contenido8bold" style="padding: 0 2px;">HORA APLICACION</td>
					<td align="center" class="contenido8bold" style="padding: 0 2px;">NOMBRE DE LA ENFERMERA</td>
				</tr>' . $out . '
			</table>
		  </td>
		</tr>
		</table>
		<div style="margin: auto; margin-top: 80px; border-top: 1px solid #000000; width: 400px; text-align: center;">' . $nombre_medico . '</div>
		<H1 class="SaltoDePagina"> </H1>
	';

	return $reporte;
}



$datos = getDatosPacienteEnCama2014_2($_GET['id_cama']);
$datos_cama = getDatosCama($_GET['id_cama']);
$datos["cama_descripcion"] = $datos_cama["descripcion"];

   
if ($_GET['tipo'] == 'ultima') {
	$ordenes = getUltimasOrdenes($_GET['id_cama'], $_GET["id_derecho"], $datos["id_medico"], $datos["id_servicio"], $_GET["fecha"]);
}

if ($_GET['tipo'] == 'todas') {
	$ordenes = getOrdenMedicamentos($_GET['id_cama'], $_GET["id_derecho"], $datos["id_medico"], $datos["id_servicio"], $_GET["fecha"]);
}

	$ret = "";
	$out = "";
	$reporte = "";
	$titulo = "";
	$laboratorio = "";
	foreach ($ordenes as $key => $orden) {
	    $vFecha = $vHora = $vIdUsuario = $vNombre = $vIndicaciones = '';
	    if ($orden["valores"] != '') {
	      $valores = json_decode(eregi_replace("[\n|\r|\n\r]", ' ', $orden["valores"]));
	      $vFecha = $valores->fecha;
	      $vHora = $valores->hora;
	      $vIdUsuario = $valores->id_usuario;
	      $vNombre = '<small><small>' . $valores->nombre . '</small></small>';
	      $vIndicaciones = $valores->indicaciones;
	    }
	    $obj = json_decode(eregi_replace("[\n|\r|\n\r]", ' ', $orden["campos"]));

		$aFecha = explode(" ", $orden["fecha_creacion"]);
		$aFecha2 = explode("-", $aFecha[0]);
		if ($titulo != $obj->tipo) {
			if (($obj->tipo == "DESAYUNO") || ($obj->tipo == "COMIDA") || ($obj->tipo == "CENA")) $tituloTmp = "ALIMENTOS"; else $tituloTmp = $obj->tipo;
			if ($titulo != $tituloTmp) {
				$titulo = $tituloTmp;
				$out .= '<tr><th colspan="5" style="border-top: 1px solid #999999;">' . $titulo . '</th></tr>';
			}
		}
        if (($obj->tipo != "DESAYUNO") && ($obj->tipo != "COMIDA") && ($obj->tipo != "CENA")) {
            $tipo = '';
        } else {
            $tipo = $obj->tipo . ': ';
        }
		$out .= '<tr>
			<td align="left" class="contenido8" style="padding: 0 3px;">' . $aFecha2[2] . '-' . $aFecha2[1] . '-' . $aFecha2[0] . '</td>
			<td align="left" class="contenido8" style="padding: 0 3px;">' . $aFecha[1] . '</td>
			<td align="left" class="contenido8" style="padding: 0 3px;">' . $tipo . substr($obj->descripcion, 0, 95) . '<br>' . substr($obj->indicaciones, 0, 95) . '</td>
			<td align="left" class="contenido8" style="padding: 0 3px;">' . $vHora . '</td>
			<td align="left" class="contenido8" style="padding: 0 3px;">' . $vNombre . '</td>
		  </tr>';
		if ($obj->tipo == "AUX. DIAGNOSTICO") {
			$laboratorio = 'window.open("2017_solicitudLaboratorioPrint.php?id_orden=' . $orden["id_orden"] . '&fecha=' . $orden["fecha_creacion"] . '");
			';
		}
	}
	$usuario = getUsuarioXid($_SESSION["idUsuario"]);
	$reporte = cambiarPagina($reporte, $out, $datos, $usuario["nombre"]);
	echo $reporte;
?>
<script type="text/javascript">
<?php echo $laboratorio; ?>
</script>

</body>
</html>
