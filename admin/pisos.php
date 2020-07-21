<?php
session_start ();
require_once("../lib/funcionesAdmin.php");


if ($_SESSION['idUsuario'] == "-1" ) {
	echo "<script  language=\"javascript\" type=\"text/javascript\">location.replace('index.php');</script>";
} else {

	$datos = getPisos();
	$TDatos = count($datos);
	
	$out = "<table class=\"ventana\">
          <tr class=\"tituloVentana\">
            <td>Nombre</td>
            <td>Tipo</td>
            <td>Acci&oacute;n</td>
          </tr>";
	
	for ($i=0;$i<$TDatos;$i++) {
		$out.= "<tr><td>" . $datos[$i]['nombre'] . "</td><td>" . $tipoPiso[$datos[$i]['tipo']] . "</td><td><input name=\"mod" . $i . "\" id=\"mod" . $i . "\" type=\"button\" value=\"Modificar\" class=\"botones\" onClick=\"javascript: location.href= 'pisos_modificar.php?id_piso=" . $datos[$i]['id_piso'] . "'\" /> <input name=\"eli" . $i . "\" id=\"eli" . $i . "\" type=\"button\" value=\"Eliminar\" class=\"botones\" onClick=\"javascript: location.href= 'pisos_eliminar.php?id_piso=" . $datos[$i]['id_piso'] . "'\" /></td></tr>";
	}
	$out.= "<tr><td align=\"center\" colspan=\"3\"><br><br><input name=\"agregar\" id=\"agregar\" type=\"button\" value=\"Agregar Piso\" class=\"botones\" onClick=\"javascript: location.href= 'pisos_agregar.php'\" /></td></tr>";
	$out.= "</table>";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ISSSTE - Administración - Censo Hospitalario</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<style type="text/css">
        @import "../lib/misEstilos.css";
</style>
<script language="javascript" type="text/javascript" src="../lib/admin.js"></script>
</head>

<body>
<center>
<table class="tablaPrincipal" id="tablaPrincipal" width="800" height="600" cellpadding="0" cellspacing="0"><tr><td>
	<table class="encabezado" id="encabezado" width="800" height="101"><tr><td>
	  <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="2" width="104" height="101" align="center" valign="middle"><img src="../diseno/logoEncabezado.png" width="74" height="74" /></td>
          <td height="48" class="tituloEncabezado" valign="middle">Censo Hospitalario&nbsp;</td>
        </tr>
        <tr>
          <td class="subtituloEncabezado">Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado &nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
	</td></tr></table>
    </td></tr><tr><td>
    <table id="centro" class="centro" width="807" height="499">
    <tr><td width="799" height="15" align="center" valign="top" bgcolor="#CEE2F6"><?php echo $menu[$_SESSION['tipoUsuario']]; ?>
    </td>
    </tr>
    <tr><td align="center"><?php echo $out; ?>
     </td></tr></table>
</td></tr></table>

<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("menu", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</center>
</body>
</html>
<?php } ?>