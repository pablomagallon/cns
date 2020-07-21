<?php require_once('../Connections/bdissste.php'); ?>
<?php
session_start ();
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$usuario_hacerLogin = "-1";
if (isset($_POST['usuario'])) {
  $usuario_hacerLogin = $_POST['usuario'];
}
$password_hacerLogin = "-1";
if (isset($_POST['pass'])) {
  $password_hacerLogin = $_POST['pass'];
}
$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_bdissste, $bdissste);
$query_hacerLogin = sprintf("SELECT * FROM usuarios WHERE login = %s and pass = %s and status = '0'", GetSQLValueString($usuario_hacerLogin, "text"),GetSQLValueString($password_hacerLogin, "text"));
$hacerLogin = mysql_query($query_hacerLogin, $bdissste) or die(mysql_error());
$row_hacerLogin = mysql_fetch_assoc($hacerLogin);
$totalRows_hacerLogin = mysql_num_rows($hacerLogin);


mysql_free_result($hacerLogin);
mysql_close($dbissste);
if ($totalRows_hacerLogin == 1) {
	mysql_select_db($database_bdissste, $bdissste);
	$query_sesion = "UPDATE usuarios SET sesionId='" . session_id() . "' WHERE id_usuario='" . $row_hacerLogin['id_usuario'] . "' LIMIT 1";
	$sesion = mysql_query($query_sesion, $bdissste) or die(mysql_error());
	$_SESSION['idUsuario'] = $row_hacerLogin['id_usuario'];
	$_SESSION['tipoUsuario'] = $row_hacerLogin['tipo_usuario'];
//	$_SESSION['IdCon'] = $row_hacerLogin['id_consultorio'];  POR SI SE RESTRINGE EL ACCESO A USUARIOS X SERVICIO O CONSULTORIO
//	$_SESSION['idServ'] = $row_hacerLogin['id_servicio'];
	switch($row_hacerLogin['tipo_usuario']) {
		case '0':$out = "<script language=\"javascript\" type=\"text/javascript\">location.replace('menu.php');</script>";  //administrador
				break;
		case '1':$out = "<script  language=\"javascript\" type=\"text/javascript\">alert('No esta autorizado(a) para ingresar a esta sección'); location.replace('index.php');</script>";  //capturista
				break;
		case '2':$out = "<script  language=\"javascript\" type=\"text/javascript\">alert('No esta autorizado(a) para ingresar a esta sección'); location.replace('index.php');</script>";  //capturista especial
				break;
		case '3':$out = "<script language=\"javascript\" type=\"text/javascript\">location.replace('menu.php');</script>";  //administrador
				break;
		case '4':$out = "<script language=\"javascript\" type=\"text/javascript\">location.replace('menu.php');</script>";  //administrador
				break;
	}
} else {
	$out = "<script  language=\"javascript\" type=\"text/javascript\">alert('Nombre de usuario o contraseña incorrecta'); location.replace('index.php');</script>";
}
echo $out;
?>