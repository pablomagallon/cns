<?php
include_once('lib/misFunciones.php');
@session_start ();

$medicos = getMedicosXServicio($_GET['idServicio']);
$tMedicos = count($medicos);
$temp = "";
for($i=0; $i<$tMedicos; $i++) {
	$temp.= "<option value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['titulo'] . " " . $medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']). "</option>";
}

$out = "<select name=\"medico_mod\" id=\"medico_mod\" style=\"width:250px;\"><option value=\"0\"> </option>" . $temp . "
    </select>";

print($out);
?>