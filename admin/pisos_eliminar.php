<?php
session_start ();
require_once("../lib/funcionesAdmin.php");


if ($_SESSION['idUsuario'] == "-1" ) {
	echo "<script  language=\"javascript\" type=\"text/javascript\">location.replace('index.php');</script>";
} else {
	if (isset($_GET['id_piso'])) {
		$res = getPisoXid($_GET['id_piso']);
		$nombre = $res['nombre'];
		$tipo = $tipoPiso[$res['tipo']];
	} else {
	echo "<script  language=\"javascript\" type=\"text/javascript\">alert('No existe la variable id del piso'); history.back();</script>";
	}

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
    <tr><td align="center">
    	<form action="pisos_eliminar_confirmar.php" onsubmit="MM_validateForm('nombre','','R');return document.MM_returnValue" method="post" name="forma">
        <input name="id_piso" type="hidden" id="id_piso" value="<?php echo $_GET['id_piso'] ?>" />
    	<table class="ventana">
          <tr class="tituloVentana">
            <td colspan="2">Eliminar Piso</td>
          </tr>
		  <tr>
		  <td>Nombre del Piso:</td>
		  <td><input name="nombre" type="text" size="40" maxlength="50" id="nombre" value="<?php echo $nombre ?>" readonly="readonly" /></td></tr>
		  <tr>
		    <td>Tipo de Piso:</td>
		    <td><input name="tipo" type="text" size="40" maxlength="50" id="tipo" value="<?php echo $tipo ?>" readonly="readonly" /></td>
		  </tr>
		  <tr><td align="center" colspan="2"><br>
		      <span class="tituloVentana">NOTA</span><span class="error">: Esta acci&oacute;n no se puede deshacer</span><br><br>
		      <input name="cancelar" id="cancelar" type="button" value="Cancelar" class="botones" onclick="javascript: history.back();" />
		      &nbsp;&nbsp;
		       <input name="eliminar" type="submit" class="botones" id="eliminar" onclick="" value="Eliminar Piso" />
          </td>
		  </tr>
        </table>
		</form>
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