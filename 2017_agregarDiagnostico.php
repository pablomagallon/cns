<?php session_start ();
include_once('lib/misFunciones.php');


if ((isset($_GET["id_movimiento"])) && (isset($_GET["diagnostico"]))) {
    $query_query = "INSERT INTO pacientes_diagnosticos VALUES (NULL,'" .  $_GET["id_movimiento"] . "','" . $_SESSION['idUsuario'] . "','" . date("Ymd") . "','" . date("Hi") . "','" . $_GET["diagnostico"] . "','1', '');";
    $res = ejecutarSQL($query_query);
    echo "1";
} else echo 'Error en variables';
?>