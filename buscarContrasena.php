<?php
include_once('lib/misFunciones.php');
@session_start ();

$pass = comprobarPassword($_GET['pass']);

if ($pass == 1) {
	echo "finefinefine";
} else {
	echo "noE";
}
?>