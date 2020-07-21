<?php session_start ();
include_once('lib/misFunciones.php');
?>
<?php if (isset($_GET["cami"])) {
	$cami = $_GET["cami"];
	
	$hayError = true;
	$duplica = existeDuplica("SELECT * FROM camas WHERE descripcion='" . $cami . "' AND id_piso='1' AND tipo='2'");
	if (!$duplica) {
		$query_query = "INSERT INTO camas VALUES('','1','" . $cami . "','2','0','');";
		$res = ejecutarSQL($query_query);
		if ($res[0] == 0) {// no hay error
			$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|camilla agregada " . date("H:i d/m/Y") . "|" . $cami . "','5')";
			$res = ejecutarSQL($query_query);
			echo "ok";
		} else { // hay error mysql al agregar receta
			echo "la camilla no se pudo agregar";
		}
	} else { // else de receta duplicada en su n. de serie
		echo "Ya existe una cama con este nombre en la base de datos";
	}
} else {
	echo "No se pudo agregar la camilla";
}
?>
