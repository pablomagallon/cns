<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include_once('lib/misFunciones.php');
session_start ();

$camas = getCamasVaciasXpiso($_GET['id_piso']);
$tCamas = count($camas);
$temp = "";
for($i=0; $i<$tCamas; $i++) {
	$temp.= "<option value=\"" . $camas[$i]['id_cama'] . "\">" . $camas[$i]['descripcion'] . "</option>";
}

$out = "<select name=\"cama\" id=\"cama\"><option value=\"0\"> </option>" . $temp . "
    </select>";

print($out);
?>