<?php
session_start ();
require_once("../lib/funcionesAdmin.php");


if ($_SESSION['idUsuario'] == "-1" ) {
	echo "<script  language=\"javascript\" type=\"text/javascript\">location.replace('index.php');</script>";
} else {
	if ((isset($_POST['nombre'])) && (isset($_POST['tipo']))) {
		$duplica = existeDuplica("SELECT * FROM pisos WHERE nombre='" . $_POST['nombre'] . "' AND id_piso<>'" . $_POST['id_piso'] . "'");
		if(!$duplica) {
			$query = "UPDATE pisos SET nombre='" . $_POST['nombre'] . "', tipo='" . $_POST['tipo'] . "' WHERE id_piso='" . $_POST['id_piso'] . "' LIMIT 1";
			$res = ejecutarSQL($query);
			if ($res[0] == 0) {// no hay error
				$out = "ok";
			} else { // hay error en el mysql
				echo "<script  language=\"javascript\" type=\"text/javascript\">alert('Error en bd al tratar de modificar el piso'); history.back();</script>";
			}
		} else {
	echo "<script  language=\"javascript\" type=\"text/javascript\">alert('Actualmente existe en la base de datos un piso llamado " . $_POST['nombre'] . ". Por favor introduzca un nombre diferente'); history.back();</script>";
		}
	} else {
	echo "<script  language=\"javascript\" type=\"text/javascript\">alert('No existe la variable nombre'); history.back();</script>";
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
    	<form action="consultorios_agregar_confirmar.php" onsubmit="MM_validateForm('nombre','','R');return document.MM_returnValue" method="post" name="forma">
    	<table class="ventana">
          <tr class="tituloVentana">
            <td>Modificar Piso</td>
          </tr>
		  <tr><td align="center"><br>
		      <span class="error">El piso "<b><?php echo $_POST['nombre']; ?></b>" se modific&oacute; correctamente</span><br>
		  <br>
		      <input name="continuar" id="continuar" type="button" value="Continuar" class="botones" onclick="javascript: location.replace('pisos.php');" />
		      &nbsp;&nbsp;</td></tr>
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