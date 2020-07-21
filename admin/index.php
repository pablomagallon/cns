<?php
session_start ();
$_SESSION['adminVar'] = "-1";
$_SESSION['idUsuario'] = "-1";
$_SESSION['tipoUsuario'] = "-1";
$_SESSION['IdCon'] = "-1";
$_SESSION['idServ'] = "-1";
$_SESSION['idDr'] = "-1";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ISSSTE - Administración - Censo Hospitalario</title>
<style type="text/css">
        @import "../lib/misEstilos.css";
</style>
<script language="javascript" type="text/javascript" src="../lib/admin.js"></script>
<script language="javascript" type="text/javascript">

function verificarLogin() {   
  	var usuario = document.getElementById('usuario').value;
	var pass = document.getElementById('pass').value;
	var correcto = true;
  	if (usuario.length < 6) { alert('Introduce un Nombre de Usuario Correcto'); correcto = false; }
  	if ((pass.length < 6) && (correcto == true)) { alert('Introduce una Contraseña Correcta'); correcto = false; }
	if (correcto == true) regresar = true; else regresar = false;
	return regresar;

}   
</script>
</head>

<body bgcolor="#EEEEEE">
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
    <table id="centro" class="centro" width="800" height="499">
    <tr><td valign="top"><div id="seleccion">&nbsp;</div>
    </td></tr>
    <tr><td align="center">
      <table width="800">
      <tr>
      <td align="center">
	  <form id="login" method="POST" action="login.php" onSubmit="javascript: verificarLogin();">
      <table width="400" border="0" cellspacing="0" cellpadding="0" class="ventana">
        <tr>
          <td class="tituloVentana" height="23">INGRESAR AL SISTEMA</td>
        </tr>
        <tr>
          <td align="center"><br />

        <span class="textosParaInputs">NOMBRE DE USUARIO:</span><br /><input id="usuario" name="usuario" type="text" maxlength="12" />
        <br /><br />   
        <span class="textosParaInputs">CONTRASEÑA:</span><br /><input id="pass" name="pass" type="password" maxlength="12"/>
        <br /><br />   


  <input name="entrar" type="submit" value="Ingresar" class="botones"  />
  <br /><br /><span id="estado" class="error">&nbsp;</span>
		  </td>
        </tr>
      </table>
      </form>
      </td></tr></table>
    </td></tr></table>
</td></tr></table>

</center>
</body>
</html>
