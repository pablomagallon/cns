<?php
session_start ();
include_once('lib/misFunciones.php');
	$direccion = $_REQUEST['direccionAgregar'];
    $tel = $_REQUEST['telefonoAgregar'];
    $edo = $_REQUEST['estadoAgregar'];
    $mun = $_REQUEST['municipioAgregar'];
    $cel = $_REQUEST['cel'];
    $cp = $_REQUEST['cp'];
    $colonia = $_REQUEST['col'];
    $umf = $_REQUEST['Unidad'];
    $email=$_REQUEST['emailAgregar'];
    $sexo=$_REQUEST['sexo'];
    $ced = $_REQUEST['cedulaAgregar'];
$tpo_ced = $_REQUEST['cedulaTipoAgregar'];
$app = quitarAcentos($_REQUEST['ap_pAgregar']);
$apm = quitarAcentos($_REQUEST['ap_mAgregar']);
$nombre = quitarAcentos($_REQUEST['nombreAgregar']);
$fecNac = $_REQUEST['fecha_nacAgregar'];

    if($sexo=="M")
        $sexo=0;
    else
        $sexo=1;
    $sql = "INSERT INTO derechohabientes VALUES(        NULL,'$ced','$tpo_ced','$app','$apm','$nombre','$fecNac','$tel','$direccion,$colonia','$cp','$edo','$mun',1,'','" . $_SESSION['idUsuario'] . "',1,$umf,'$email','$cel',$sexo);"; 
$res = ejecutarSQLR($sql);
//	print($query_query);


if ($res[0] == 0) {// no hay error
	$dh = getDH("WHERE cedula='". $ced . "' AND cedula_tipo='" . $tpo_ced . "' AND ap_p='" . $app . "' AND ap_m='" . $apm . "' AND nombres='" . $nombre . "'","ORDER BY cedula");
	print($dh[0]['id_derecho']);

} else { // hay error en el mysql
	print("-1");
}

?>
