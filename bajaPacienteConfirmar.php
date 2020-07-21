<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if ((isset($_GET["id_cama"])) && (isset($_GET["id_piso"])) && (isset($_GET["fecha"])) && (isset($_GET["observaciones"]))) {
	$id_cama = $_GET["id_cama"];
	$id_piso = $_GET["id_piso"];
	$tipo = $_GET["tipo"];
	$fecha = $_GET["fecha"];
	$observaciones = $_GET["observaciones"];
	$datos = getDatosPacienteEnCama($id_cama);
	$hayError = true;
		$query_query = "INSERT INTO pacientes_historial VALUES (NULL,'" .  $id_cama . "','" . $datos['id_derecho'] . "','" . $datos['id_medico'] . "','" . $datos['id_servicio'] . "','" . $datos['fecha_ingreso'] . "','" . $datos['hora_ingreso'] . "','" . formatoFechaBD($fecha) . "','" . date("Hi") . "','" . $datos['procedencia'] . "','" . $datos['observaciones'] . "','" . $observaciones . "','" . $tipo . "');";
		$res = ejecutarSQL($query_query);
		if ($res[0] == 0) {// no hay error
			$query_query = "UPDATE camas SET status='0' WHERE id_cama='" . $id_cama . "' LIMIT 1";
			$res = ejecutarSQL($query_query);
			if ($res[0] == 0) {// no hay error
				$query_query = "DELETE FROM pacientes_en_piso WHERE id_cama='" . $id_cama . "' LIMIT 1";
				$res = ejecutarSQL($query_query);
				if ($res[0] == 0) {// no hay error
					echo "Salida del Paciente Realizada Correctamente";
					$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|paciente eliminado de cama " . date("H:i d/m/Y") . "|" . $id_cama . "|" . $datos['id_derecho'] . "|" . $datos['id_medico'] . "|" . $datos['id_servicio'] . "','3')";
					$res = ejecutarSQL($query_query);
				} else { // hay error mysql al agregar receta
					echo "el paciente no se pudo borrar de pacientes en piso";
				}
			} else { // hay error mysql al agregar receta
				echo "la cama no se pudo desbloquear";
			}
		} else { // hay error mysql al agregar receta
			echo "El paciente no se pudo egresar";
		}
} else {
	echo "No se pudo egresar al paciente, pongase en contacto con el administrador del sistema";
}
?>
