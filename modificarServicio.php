<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if ((isset($_GET["servicio"])) && (isset($_GET["medico"])) && (isset($_GET["id_piso"])) && (isset($_GET["id_cama"]))) {
	$id_cama = $_GET["id_cama"];
	$id_piso = $_GET["id_piso"];
	$servicio = $_GET["servicio"];
	$medico = $_GET["medico"];
	$query_query = "UPDATE pacientes_en_piso SET id_servicio='" . $servicio . "', id_medico='" . $medico . "' WHERE id_cama='" . $id_cama . "' LIMIT 1";
	$res = ejecutarSQL($query_query);
	if ($res[0] == 0) {// no hay error
		echo "Servicio Modificado Correctamente";
		$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|servicio modificado " . date("H:i d/m/Y") . "|" . $id_cama . "|" . $medico . "|" . $servicio . "','8')";
		$res = ejecutarSQL($query_query);
	} else { // hay error mysql al agregar receta
		echo "el servicio no se pudo modificar";
	}
} else {
	echo "No se pudo modificar el servicio, pongase en contacto con el administrador del sistema";
}
?>
