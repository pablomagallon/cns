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

$arregloTiposOrdenes = array("DESAYUNO" => "0", "COMIDA" => "1", "CENA" => "2", "CUIDADO" => "3", "SOLUCION" => "4", "MEDICAMENTO" => "5", "PROCEDIMIENTO" => "6");

?>
<?php if ((isset($_POST["id_cama"])) && (isset($_POST["fecha"])) && (isset($_POST["id_derecho"])) && (isset($_POST["id_servicio"])) && (isset($_POST["id_medico"])) && (isset($_POST["id_usuario"])) && (isset($_POST["hora"])) && (isset($_POST["observaciones"])) && (isset($_POST["id_concepto"]))) {
	$usuario = getUsuarioXid($_POST["id_usuario"]);
	$query_query = "UPDATE ordenes_conceptos SET valores='{\"fecha\":\"" . $_POST["fecha"] . "\",\"hora\":\"" . $_POST["hora"] . "\",\"id_usuario\":" . $_POST["id_usuario"] . ",\"nombre\":\"" . $usuario["nombre"] . "\",\"indicaciones\":\"" . $_POST["observaciones"] . "\"}', fecha_ultima_mod='" . date("Y-m-d H:i:s") . "' WHERE id_concepto='" . $_POST["id_concepto"] . "' LIMIT 1;";
	$res = ejecutarSQL($query_query);
	if ($res[0] == 0) {// no hay error
		echo 'ok';
	} else {
		echo 'Error al crear la orden médica';
	}
} else {
	echo "Error en variables";
}
?>
