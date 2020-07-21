<?php
session_start ();
include_once('lib/misFunciones.php');

if ((isset($_GET["id_cama"])) && (isset($_GET["id_movimiento"])) && (isset($_GET["pendientes"])) && (isset($_GET["observaciones"])) && (isset($_GET["interconsulta"])) && (isset($_GET["diagnostico"]))) {
	$id_cama = $_GET["id_cama"];
	$id_movimiento = $_GET["id_movimiento"];
	$pendientes = $_GET["pendientes"];
	$observaciones = $_GET["observaciones"];
	$interconsulta = $_GET["interconsulta"];
	$diagnostico = $_GET["diagnostico"];
	$folio = $_GET["folio"];
	$aInterconsulta = explode("_", $interconsulta);
	if ($aInterconsulta[0] != '0') {
		$servicio = getServicioXid($aInterconsulta[0]);
		$medico = getMedicoXid($aInterconsulta[1]);
		$inter = $servicio . ' - ' . ponerAcentos($medico['titulo'] . " " . $medico['ap_p'] . " " . $medico['ap_m'] . " " . $medico['nombres']);
	} else {
		$inter = '';
	}
	$hayError = true;
	if ($diagnostico != '') {
		$query_query = "UPDATE pacientes_en_piso SET observaciones='" . $diagnostico . "' WHERE id_cama='" . $id_cama . "' LIMIT 1";
		$res = ejecutarSQL($query_query);		
		$diagnostico = 'CAMBIO A ' . $diagnostico;
	}
		$query_query = "INSERT INTO pacientes_en_piso_observaciones VALUES(NULL,'" . $id_movimiento . "','" . date('Ymd') . "','" . date("His") . "','" . $pendientes . "','" . $observaciones . "','" . $inter . "','" . $diagnostico . "','" . $folio . "')";
		echo $query_query;
		$res = ejecutarSQL($query_query);
		if ($res[0] == 0) {// no hay error
			echo "ok";
		} else { // hay error mysql al agregar receta
			echo "error";
		}
} else {
	echo "error en variables";
}
?>
