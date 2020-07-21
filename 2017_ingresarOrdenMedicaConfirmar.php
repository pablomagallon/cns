<?php session_start ();
include_once('lib/misFunciones.php');

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
    $ret = 0;
    if ($totalRows_query > 0) {
        $ret = $row_query['id_orden'];
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

$arregloTiposOrdenes = array("DESAYUNO" => "0", "COMIDA" => "1", "CENA" => "2", "CUIDADO" => "3", "SOLUCION" => "4", "MEDICAMENTO" => "5", "AUX. DIAGNOSTICO" => "6");

?>
<?php if ((isset($_POST["id_cama"])) && (isset($_POST["fecha"])) && (isset($_POST["id_derecho"])) && (isset($_POST["id_servicio"])) && (isset($_POST["id_medico"])) && (isset($_POST["id_usuario"]))) {
	$hayError = true;
	$duplica = existeDuplica("SELECT * FROM ordenes WHERE id_cama='" . $_POST["id_cama"] . "' AND id_derecho='" . $_POST["id_derecho"] . "' AND id_medico='" . $_POST["id_medico"] . "' AND id_servicio='" . $_POST["id_servicio"] . "' AND fecha='" . $_POST["fecha"] . "' AND status='1'");
	$objeto = json_decode($_POST["objeto"]);
	$fecha_creacion = date('Y-m-d H:i:s');
	if (!$duplica) { // no existe la orden, se debe hacer insert
		$query_query = "INSERT INTO ordenes VALUES (NULL,'" .  $_POST["id_cama"] . "','" . $_POST["id_derecho"] . "','" . $_POST["id_medico"] . "','" . $_POST["id_servicio"] . "','" . $_POST["fecha"] . "','" . $fecha_creacion . "','1970-01-01 00:00:00','1', '','" . $_POST["id_usuario"] . "');";
		$res = ejecutarSQL($query_query);
		$id_orden = getOrdenMedicamentos($_POST["id_cama"], $_POST["id_derecho"], $_POST["id_medico"], $_POST["id_servicio"], $_POST["fecha"]);
		if ($res[0] == 0) {// no hay error
			foreach ($objeto as $indice => $obj) {
				$query_query = "INSERT INTO ordenes_conceptos VALUES (NULL,'" .  $id_orden . "','" . $arregloTiposOrdenes[$obj->tipo] . "','','" . json_encode($obj, JSON_UNESCAPED_UNICODE) . "','','" . $fecha_creacion . "','1970-01-01 00:00:00','1', '','" . $obj->id . "','');";
				$res = ejecutarSQL($query_query);
				if ($obj->tipo == "AUX. DIAGNOSTICO") {
				    $query_query2 = "INSERT INTO citas_detalle_laboratorio VALUES(NULL, '".$id_orden."', '0', '".$obj->id."', '".$obj->descripcion."', 'CE', '".$obj->indicaciones."', '".$fecha_creacion."', '".$_POST["id_usuario"]."');";
					$res = ejecutarSQLF($query_query2);
				}
			}
			echo 'ok';
		} else {
			echo 'Error al crear la orden médica';
		}
	} else { // ya existe la orden anteriormente creada, se debe hacer update
		$id_orden = getOrdenMedicamentos($_POST["id_cama"], $_POST["id_derecho"], $_POST["id_medico"], $_POST["id_servicio"], $_POST["fecha"]);
		foreach ($objeto as $indice => $obj) {
			$query_query = "INSERT INTO ordenes_conceptos VALUES (NULL,'" .  $id_orden . "','" . $arregloTiposOrdenes[$obj->tipo] . "','','" . json_encode($obj, JSON_UNESCAPED_UNICODE) . "','','" . $fecha_creacion . "','1970-01-01 00:00:00','1', '','" . $obj->id . "','');";
			$res = ejecutarSQL($query_query);
			if ($obj->tipo == "AUX. DIAGNOSTICO") {
			    $query_query2 = "INSERT INTO citas_detalle_laboratorio VALUES(NULL, '".$id_orden."', '0', '".$obj->id."', '".$obj->descripcion."', 'CE', '".$obj->indicaciones."', '".$fecha_creacion."', '".$_POST["id_usuario"]."');";
				$res = ejecutarSQLF($query_query2);
			}
		}
		echo 'ok';
	}
} else {
	echo "Error en variables";
}
?>
