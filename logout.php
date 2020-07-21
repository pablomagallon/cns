<?php
include_once('lib/misFunciones.php');

session_start ();
$query_query = "INSERT INTO logs values('','" . $_SESSION['idUsuario'] . "|salio del sistema " . date("H:i d/m/Y") . "','8')";
$res = ejecutarSQL($query_query);
$_SESSION['idUsuario'] = "-1";
$_SESSION['tipoUsuario'] = "-1";
$_SESSION['IdCon'] = "-1";
$_SESSION['idServ'] = "-1";
$_SESSION['idDr'] = "-1";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>logout</title>
</head>

<body>
</body>
</html>
