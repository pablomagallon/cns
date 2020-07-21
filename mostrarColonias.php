<?php
include 'lib/misFunciones.php';
$municipio=  $_REQUEST['municipio'];
$cp=$_REQUEST['cp'];
$estado=$_REQUEST['estado'];
if($cp=="" || $cp=="-1"){
$sql="select colonia from codigo_postales where municipio like '%".$municipio."%' and estado like '%$estado%' order by colonia ASC";
}
 else {
$sql="select colonia from codigo_postales where cp like '%$cp%' order by colonia ASC";
}
$colonias=  ConsultaMultipleR($sql);
$ret="<option value='-1'></option>";
if(count($colonias)>0){
    foreach ($colonias as $key=>$row) {
        $ret.="<option value='".  ponerAcentos(quitarAcentos($row['colonia']))."'>".  ponerAcentos(quitarAcentos($row['colonia']))."</option>";
    }
}
    print $ret;
?>
