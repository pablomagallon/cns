<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if ((isset($_GET["id_cama"])) && (isset($_GET["id_piso"])) && (isset($_GET["id_derecho"])) && (isset($_GET["cama"]))) {
	$id_cama = $_GET["id_cama"];
	$id_piso = $_GET["id_piso"];
	$id_derecho = $_GET["id_derecho"];
	$cama = $_GET["cama"];
	
	$hayError = true;
			$query_query = "UPDATE camas SET status='0' WHERE id_cama='" . $id_cama . "' LIMIT 1";
			$res = ejecutarSQL($query_query);
			$query_query = "UPDATE camas SET status='1' WHERE id_cama='" . $cama . "' LIMIT 1";
			$res = ejecutarSQL($query_query);
			$query_query = "UPDATE pacientes_en_piso SET id_cama='" . $cama . "' WHERE id_cama='" . $id_cama . "' LIMIT 1";
			$res = ejecutarSQL($query_query);
			if ($res[0] == 0) {// no hay error
					echo "Transferencia del Paciente Realizada Correctamente";
					$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|paciente transferido de cama " . date("H:i d/m/Y") . "|" . $id_cama . "|" . $id_derecho . "|" . $cama . "','4')";
					$res = ejecutarSQL($query_query);
				} else { // hay error mysql al agregar receta
					echo "el paciente no se pudo transferir";
				}
		
		
} else {
	echo "No se pudo transferir al paciente, pongase en contacto con el administrador del sistema";
}
?>
