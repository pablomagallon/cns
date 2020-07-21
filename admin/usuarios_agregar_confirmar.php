<?php
session_start ();
require_once("../lib/funcionesAdmin.php");


if ($_SESSION['idUsuario'] == "-1" ) {
	echo "<script  language=\"javascript\" type=\"text/javascript\">location.replace('index.php');</script>";
} else {
	if ((isset($_POST['nombre'])) && (isset($_POST['usuario']))) {
		$duplica = existeDuplica("SELECT * FROM usuarios WHERE (nombre='" . $_POST['nombre'] . "' OR login='" . $_POST['usuario'] . "') AND st='1'");
		if(!$duplica) {
			$st = '0';
			if ($_POST["tipo_usuario"] == "8") $st = $_POST["piso"];
			$query = "INSERT INTO usuarios VALUES(NULL,'" . $_POST['usuario'] . "','" . $_POST['contra'] . "','" . $_POST['nombre'] . "','" . $_POST['tipo_usuario'] . "','" . $st . "','0','0','1')";
			$res = ejecutarSQL($query);
			if ($res[0] == 0) {// no hay error
				$out = "ok";
			} else { // hay error en el mysql
				echo "<script  language=\"javascript\" type=\"text/javascript\">alert('Error en bd al tratar de agregar el usuario'); history.back();</script>";
			}
		} else {
	echo "<script  language=\"javascript\" type=\"text/javascript\">alert('Actualmente existe en la base de datos un usuario llamado " . $_POST['nombre'] . " o con nombre de usuario " . $_POST['usuario'] . ". Por favor introduzca un nombre o nombre de usuario diferente'); history.back();</script>";
		}
	} else {
	echo "<script  language=\"javascript\" type=\"text/javascript\">alert('No existe la variable nombre del usuario'); history.back();</script>";
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
            <td>Agregar Usuario</td>
          </tr>
		  <tr><td align="center"><br>
		      <span class="error">El usuario "<b><?php echo $_POST['nombre']; ?></b>" se agregó correctamente</span><br>
		  <br>
		      <input name="continuar" id="continuar" type="button" value="Continuar" class="botones" onclick="javascript: location.replace('usuarios.php');" />
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