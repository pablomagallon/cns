<?php

include 'Connections/bdissste.php';
include 'lib/misFunciones.php';
$estado = $_GET['estado'];
/*$sql = "select id_unidad,nombre,unidad from vgf where Estado='$estado' and tiene_poblacion_adscrita=1 order by clinica,unidad ASC";

$umf = "<option value='-1'></option>";
if (mysql_errno() == 0) {
    if (mysql_num_rows($query) > 0) {
        while ($row = mysql_fetch_array($query)) {
			if($row['unidad']==0)
			$clase="clinica";
			else
			$clase="umf";
            $umf.="<option value='" . $row['id_unidad'] . "' class='$clase'>" . htmlentities($row['nombre']) . "</option>";
        }
    } else {
        $umf = 'No hay Unidades Medicas encontradas';
    }
} else {*/
    $sql = "select id_unidad,nombre from vgf where Estado='$estado' order by clinica ASC";
    $umfs = ConsultaMultipleR($sql);
    $umf = "<option value='-1'></option>";
    if (count($umfs) > 0) {
        foreach ($umfs as $key=>$row) {
            $umf.="<option value='" . $row['id_unidad'] . "'>" . htmlentities($row['nombre']) . "</option>";
        }
    } else {
        $umf = '<option value="-1">No hay Unidades Medicas encontradas</option>';
    }
//}
echo $umf;
mysql_close($link);
?>
