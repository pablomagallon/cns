<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if (isset($_GET["cami"])) {
	$cami = $_GET["cami"];
	
	$hayError = true;
	$duplica = existeDuplica("SELECT * FROM camas WHERE id_cama='" . $cami . "' AND status='1'");
	if (!$duplica) {
		$query_query = "DELETE FROM camas WHERE id_cama='" . $cami . "' LIMIT 1;";
		$res = ejecutarSQL($query_query);
		if ($res[0] == 0) {// no hay error
			$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|camilla eliminada " . date("H:i d/m/Y") . "|" . $cami . "','6')";
			$res = ejecutarSQL($query_query);
			echo "ok";
		} else { // hay error mysql al agregar receta
			echo "la camilla no se pudo eliminar";
		}
	} else { // else de receta duplicada en su n. de serie
		echo "la camilla esta ocupada no la puedes eliminar";
	}
} else {
	echo "No se pudo eliminar la camilla";
}
?>
