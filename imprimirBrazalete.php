<?php
error_reporting(E_ALL^E_NOTICE);
include_once('lib/misFunciones.php');

$brazalete = '';
$titulo = '';
if ((isset($_GET['id_cama'])) && (isset($_GET['id_piso']))) {
	$datos = getDatosPacienteEnCama2014($_GET['id_cama']);
	$piso = getPiso($_GET['id_piso']);
	$cama = getDatosCama($_GET['id_cama']);
	$edad = calculaedad ($datos['fecha_nacimiento']);
	$edad2 = calculaedad2 ($datos['fecha_nacimiento']);
	$aGS = array ('Ap' => 'A+','An' => 'A-','Bp' => 'B+','Bn' => 'B-','ABp' => 'AB+','ABn' => 'AB-','Op' => 'O+','On' => 'O-');
	$brazalete .= '<div style="width:75%; border: dashed 2px #EEE; height:84pt; padding-top:2pt; padding-left: 60pt;">';
	$brazalete .= '<div style="float:left; width:90px;"><img src="fotosIngresos/issste.jpg" /></div>';
	$brazalete .= '<div style="float:left;"><div class="id"><img src="barcode/barcode.php?code=' . $datos['id_derecho'] . '&tam=1" alt="barcode" /></div><div';
	$brazalete .= '<div style="float:left; width:600px; margin-left:40px;">
						<p class="nombreP">' . ponerAcentos($datos['ap_p'] . ' ' . $datos['ap_m'] . ' ' . $datos['nombres']) . '</p>
						<p class="ingreso2"><span>FN:</span> ' .$edad.' CD: ' . $datos['cedula'] .'/'. $datos['cedula_tipo'] .' GS: ' .$aGS[$datos['dh_extras']['g_sangre']]. '</p>
						<p class="ingreso"><span>INGRESO: </span>' . formatoDia($datos['fecha_ingreso'], 'fecha') . ' ' . formatoHora($datos['hora_ingreso']) . ' &nbsp;&nbsp;&nbsp;<span>EDAD: ' .$edad2.'</p>
						<p class="ingreso"><span>ALERGIAS: <span> ' . ponerAcentos($datos['dh_extras']['alergias_med']) .  '</p>
					</div>';
	$brazalete .= '</div>';
	$titulo .= $datos['cedula'] . '/' . $datos['cedula_tipo'] . ' - ' . ponerAcentos($datos['ap_p'] . ' ' . $datos['ap_m'] . ' ' . $datos['nombres']);
} else {
	echo 'error en la variable cama';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Brazalete: <?php echo $titulo ?></title>
        <style type="text/css">
            @import url("lib/impresion.css") print;
            @import url("lib/reportes.css") screen;
        </style>
		<style>
@font-face
{
font-family: Code39AzaleaFont;
src: url('Code39Azalea/Code39Azalea.eot') format('embedded-opentype'), /* IE9 Compat Modes */
   url('Code39Azalea/Code39Azalea.woff') format('woff'), /* Modern Browsers */
   url('Code39Azalea/Code39Azalea.ttf') format('truetype'), /* Safari, Android, iOS */
   url('Code39Azalea/Code39Azalea.svg#Code39Azalea') format('svg'); /* Legacy iOS */
font-weight: normal;
font-style: normal;
}

		p { margin:5px; padding: 0px; }
			.id {			
				font-size: 27pt;
				margin-left:-5px;
				float: left;
				position: absolute;
				margin-top:0px;
			}

			.cedula {
				-webkit-transform: rotate(-90deg);
				-moz-transform: rotate(-90deg);
				-ms-transform: rotate(-90deg);
				-o-transform: rotate(-90deg);
				transform: rotate(-90deg);
				-webkit-transform-origin: 40% 40%;
				-moz-transform-origin: 40% 40%;
				-ms-transform-origin: 40% 40%;
				-o-transform-origin: 40% 40%;
				transform-origin: 40% 40%;
				
				font-size: 7pt;
				margin-top:35pt;
				margin-left:13px;
				float: left;
				font-weight:bold;
				position: absolute;
			}
			.edad {
				-webkit-transform: rotate(-90deg);
				-moz-transform: rotate(-90deg);
				-ms-transform: rotate(-90deg);
				-o-transform: rotate(-90deg);
				transform: rotate(-90deg);
				-webkit-transform-origin: 50% 50%;
				-moz-transform-origin: 50% 50%;
				-ms-transform-origin: 50% 50%;
				-o-transform-origin: 50% 50%;
				transform-origin: 50% 50%;
				
				font-size: 7pt;
				margin-top:40pt;
				margin-left:25px;
				float: left;
				font-weight:bold;
				position: absolute;
			}
			
			.nombreP {
				padding-bottom:4px;
				font-size:18pt;
				font-weight:bold;
				text-decoration:underline;
			}
			
			.ingreso {
				padding-bottom:2px;
				font-size:10pt;
			}
			
			.ingreso span {
				font-weight:bold;
			}
			.ingreso2 {
				font-weight:bold;
				padding-bottom:2px;
				font-size:12pt;
			}
			
			.alergias {
				padding-bottom:2px;
				font-size:8pt;
			}

			.dx {
				padding-bottom:2px;
				font-size:7pt;
			}
			
        </style>
	</head>

<body>
<?php
	echo $brazalete;
?>
</body></html>