<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if ((isset($_GET["id_cama"])) && (isset($_GET["id_piso"])) && (isset($_GET["id_derecho"])) && (isset($_GET["servicio"])) && (isset($_GET["medico"])) && (isset($_GET["estado"]))) {
	$id_cama = $_GET["id_cama"];
	$id_piso = $_GET["id_piso"];
	$estado= $_GET["estado"];
	$fecha = $_GET["fecha"];
	$servicio = $_GET["servicio"];
	$medico = $_GET["medico"];
	$id_derecho = $_GET["id_derecho"];
	$alergias = $_GET["alergias"];
	$hayError = true;
	$duplica = existeDuplica("SELECT * FROM pacientes_en_piso WHERE id_cama='" . $id_cama . "'");
	if (!$duplica) {
		$duplica = existeDuplica("SELECT * FROM pacientes_en_piso WHERE id_derecho='" . $id_derecho . "'");
		if (!$duplica) {
			$query_query = "INSERT INTO pacientes_en_piso VALUES (NULL,'" .  $id_cama . "','" . $id_derecho . "','" . $medico . "','" . $servicio . "','" . formatoFechaBD($fecha) . "','" . date('Hi') . "','" . $estado . "','" . $_GET['diagnostico'] . "', '" . $alergias . "');";
			$res = ejecutarSQL($query_query);
			if ($res[0] == 0) {// no hay error
				$query_query = "UPDATE camas SET status='1' WHERE id_cama='" . $id_cama . "' LIMIT 1";
				$res = ejecutarSQL($query_query);
				if ($res[0] == 0) {// no hay error
					echo "Paciente Ingresado Correctamente";
					$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|paciente asignado a cama " . date("H:i d/m/Y") . "|" . $id_cama . "|" . $id_derecho . "|" . $medico . "|" . $servicio . "','2')";
					$res = ejecutarSQL($query_query);
					$res = extrasDH($id_derecho, $_GET['grupo_sanguineo'], $alergias, '', '', $id_derecho . '.jpg', $_SESSION['idUsuario'], '', '', '', '', '', '', '', '');
				} else { // hay error mysql al agregar receta
					echo "la cama no se pudo bloquear";
				}
			} else { // hay error mysql al agregar receta
				echo "El paciente no se pudo ingresar";
			}
		} else { // else de receta duplicada en su n. de serie
			echo "El paciente esta ocupando otra cama";
		}
	} else { // else de receta duplicada en su n. de serie
		echo "Ya existe un paciente en esta cama en la base de datos";
	}
} else {
	echo "No se pudo ingresar al paciente, pongase en contacto con el administrador del sistema";
}
?>
