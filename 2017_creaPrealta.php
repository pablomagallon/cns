<?php session_start ();
include_once('lib/misFunciones.php');


if (isset($_GET["id_movimiento"])) {
    $query_query = "INSERT INTO pacientes_prealtas VALUES (NULL,'" .  $_GET["id_movimiento"] . "','" . date("Ymd") . "','" . date("Hi") . "','1','" . $_SESSION['idUsuario'] . "','0', '');";
    $res = ejecutarSQL($query_query);
    echo "ok";
} else echo 'Error en variables';
?>