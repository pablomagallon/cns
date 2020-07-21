<?php
error_reporting(E_ALL^E_NOTICE);
include_once('lib/misFunciones.php');
//session_start ();
$tipoUsuario = $_SESSION['tipoUsuario'];

//$_GET['id_piso'] = 26;
$piso = getPiso($_GET['id_piso']);
$camas = getCamasXpiso($_GET['id_piso']);

$NCamas = count($camas);
$temp = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";

for($i=0; $i<$NCamas; $i++) {
	$infoPaciente = "";
	$boton = "";
	if ($camas[$i]['status'] == "1") {
		if(($tipoUsuario == "2") && ($_GET['id_piso'] == "1")) { // urgencias
			$boton .= "onclick=\"javascript: bajaPaciente('" . $camas[$i]['id_cama'] . "');\"";
		}
		if(($tipoUsuario == "1") && ($_GET['id_piso'] != "1")) { // pisos
			$boton .= "onclick=\"javascript: bajaPaciente('" . $camas[$i]['id_cama'] . "');\"";
		}		
		if(($tipoUsuario == "9")) { // pisos y urgencias
			$boton .= "onclick=\"javascript: bajaPaciente('" . $camas[$i]['id_cama'] . "');\"";
		}		
		$datos = getDatosPacienteEnCama($camas[$i]['id_cama']);
		$infoPaciente = "<td valign=\"middle\" class=\"nombrePaciente\" width=\"450\">" . ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) . "<br>" . ponerAcentos($datos['servicio_nombre'] . " - " . $datos['medico_titulo'] . " " . $datos['medico_ap_p'] . " " . $datos['medico_ap_m'] . " " . $datos['medico_nombres']) . "</td><td valign=\"middle\" class=\"nombrePaciente\" width=\"90\"><b>INGRESO</b><br>" . formatoDia($datos['fecha_ingreso'],"fecha") . "<br>" . formatoHora($datos['hora_ingreso']) . " HRS.</td>";
		
		$temp .= "<tr><td class=\"cama\" width=\"80\">" . $camas[$i]['descripcion'] . "
		</td>" . $infoPaciente . "
		</td>
		</tr>
		<tr>
			<td colspan=\"3\">
				<table width=\"100%\" class=\"ventanaConFondo\">
					<tr>
						<td class=\"tituloVentana\">" . ponerAcentos($datos['observaciones']) . "
						</td>
					</tr>
				</table>
			</td>
		</tr>";
	}
}
$temp .= "</table>";
$out = "";

$listaCamillas = "<option value=\"0\"> </option>";
$camillasVacias = getCamillasVacias();
$tCamillasVacias = count($camillasVacias);
for ($i=0; $i<$tCamillasVacias; $i++) {
	$listaCamillas .= "<option value=\"" . $camillasVacias[$i]['id_cama'] . "\">" . $camillasVacias[$i]['descripcion'] . "</option>";
}

$out.= "<br><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"780\"><tr><td align=\"center\">" ;
$out.= "<table width=\"750\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"ventana\">
        <tr>
          <td class=\"tituloVentana2\" height=\"23\">" . $piso['nombre'] . " - OCUPACION</td>
        </tr>
        <tr>
          <td align=\"left\">" . $temp . "
		  </td>
        </tr>
      </table>
	  </td></tr></table>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ISSSTE - Censo Hospitalario</title>

<link rel="stylesheet" href="lib/pantalla.css" type="text/css">

<META HTTP-EQUIV="REFRESH" CONTENT="5; URL=<?php echo $_SERVER['PHP_SELF'] . '?id_piso=' .$_GET["id_piso"]; ?>"/>
</head>

<body bgcolor="#FFFFFF">
<center>
<?php
	print($out);

?>
</center>
</body>
</html>