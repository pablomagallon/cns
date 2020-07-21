<?php
include 'lib/misFunciones.php';
$municipio=$_REQUEST['municipio'];
$estado=$_REQUEST['estado'];
$colonia= quitarAcentos($_REQUEST['col']);

if($colonia=="" || $colonia=="-1"){
$sql="select cp from codigo_postales where estado like '%".$estado."%' and municipio like '%".$municipio."%' group by cp";
$ret="<option value='-1'> </option>";
}
else{
$sql="select cp from codigo_postales where estado like '%".$estado."%' and municipio like '%".$municipio."%' and colonia like '%$colonia%' group by cp";
$ret="";
}
$cp=  ConsultaMultipleR($sql);

if(count($cp)>0)
foreach ($cp as $key =>$row){
        $ret.="<option value='".$row['cp']."'>".$row['cp']."</option>";
    }
    print $ret;
?>
