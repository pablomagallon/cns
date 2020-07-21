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
<title>logout</title>
</head>

<body>
<script language="javascript" type="text/javascript">
	location.replace('index.php');
</script>
</body>
</html>
