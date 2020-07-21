<?php
session_start ();
include_once('lib/misFunciones.php');

if ((isset($_GET["id_cama"])) && (isset($_GET["observaciones"]))) {
	$id_cama = $_GET["id_cama"];
	$observaciones = $_GET["observaciones"];
	$hayError = true;
		$query_query = "UPDATE pacientes_en_piso SET observaciones='" . $observaciones . "' WHERE id_cama='" . $id_cama . "' LIMIT 1";
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
