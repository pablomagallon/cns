<?php
error_reporting(E_ALL^E_NOTICE);
include_once('../farmaciat2/lib/misFunciones.php');
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set("America/Mexico_City");
$meses = array();
$meses[1] = "Enero"; 
$meses[2] = "Febrero"; 
$meses[3] = "Marzo"; 
$meses[4] = "Abril"; 
$meses[5] = "Mayo"; 
$meses[6] = "Junio"; 
$meses[7] = "Julio"; 
$meses[8] = "Agosto"; 
$meses[9] = "Septiembre"; 
$meses[10] = "Octubre"; 
$meses[11] = "Noviembre"; 
$meses[12] = "Diciembre"; 

function getCitasDetalleXid($id_orden, $fecha_hora) {
    global $hostname_bdissste;
    global $username_bdisssteF;
    global $password_bdisssteF;
    global $database_bdisssteF;
    $ret = array();
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteF, $password_bdisssteF) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteF, $bdissste);
	mysql_query("SET CHARACTER SET utf8"); 
	mysql_query("SET NAMES utf8"); 
    $query_query = "SELECT * FROM citas_detalle_laboratorio WHERE id_cita='" . $id_orden . "' AND fecha_agrego='" . $fecha_hora . "' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $totalRows_query = mysql_num_rows($query);
    if ($totalRows_query == 1) {
        $ret = mysql_fetch_assoc($query);
 	}
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function detallesCatalogo($estudios){
    $explode = explode(",", $estudios);
    $ret = array();

    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    mysql_query("SET CHARACTER SET utf8"); 
    mysql_query("SET NAMES utf8"); 

    foreach($explode as $indice => $valor){
        $query_query = "SELECT * FROM laboratorio_catalogo WHERE clave='" . $valor . "'";
        $query = mysql_query($query_query, $bdissste) or die(mysql_error());
        do {
            if(!empty($row_query)){
               $ret[] = array('clave' => $row_query['clave'], 'descripcion' => $row_query['descripcion']);
           }
        } while ($row_query = mysql_fetch_assoc($query));
    }

    return $ret;
}

function tablaEstudios($catalogo){
    $mostrar = '<table width="100%">';
    $actual= 0;
        foreach($catalogo as $indice => $valor){
            $actual++;
            if(($actual == 1) || ($actual == 5) || ($actual == 9) || ($actual == 13) || ($actual == 17) || ($actual == 21) || ($actual == 25) || ($actual == 29)){ $mostrar .= '<tr>'; }
                $mostrar .= '<td style="font-size:10px; width:50px;">'.$valor['descripcion'].'</td>';
                $mostrar .= '<td style="width:50px; text-align:left;"><img src="../farmaciat2/barcode/barcode.php?code='.$valor['clave'].'&tam=1" width="100%" style="max-width:60px;" /></td>';
            if(($actual == 4) || ($actual == 8) || ($actual == 12) || ($actual == 16) || ($actual == 20) || ($actual == 24) || ($actual == 28) || ($actual == 32)){ $mostrar .= '</tr>'; }
        }
    $mostrar .= '</table>';

    return $mostrar;
}

if (isset($_GET["id_orden"])) {
    $laboratorio = getCitasDetalleXid($_GET["id_orden"], $_GET["fecha"]);
    if (count($laboratorio) > 0) {
        $catalogo = detallesCatalogo($laboratorio['nombre_estudio']);
        $id_cita = getCitaXid($laboratorio['id_cita']);
        $derecho = getDatosDerecho($id_cita["id_derecho"]);
        $id_servicio = regresarIdServicio($_SESSION["idDr"]);
        $servicio = getServicioXid($id_servicio);
        $medico = getMedicoXid($_SESSION["idDr"]);
        $datosUsuario = getUsuarioXid($_SESSION['idUsuario']);
    } else {
        print("No existe la licencia M&eacute;dica");
    }
} else {
    print("Error en variable id licencia");
}

$ordinario = '()';
$urgente = '()';

if($laboratorio['caracter'] == 'OR') $ordinario = '(X)';
if($laboratorio['caracter'] == 'UR') $urgente = '(X)';

$tipoEstudio = '';
switch($laboratorio['tipo_estudio']){
    case '0':
        $tipoEstudio = 'RADIOLOGIA';
        break;
    case '1':
        $tipoEstudio = 'LABORATORIO';
        break;
}

$explodeDiagnostico = explode("-", $laboratorio['diagnostico']);
?>

<html>
<head>
    <style>
        body{
            font-family: arial,helvetica,sans-serif;
        }

        #todo{
            margin: auto;
            max-width: 990px;
            height: auto;
            border: 1px solid #000;
            padding: 10px;
        }

        p,div,h1,h2,h3,a,ol,li,ul{
            box-sizing: content-box;
            padding-top: 0px;
            margin: 0px;
        }

        section,header,footer{
            overflow: hidden;
            max-width: 100%;
        }

        header #encabezado{
            float: left;
            width: 100%;
        }

        header #encabezado #logo{
            float: left;
            width:80px;
        }

        header #encabezado #logo img{
            width: 100%;
        }

        header #encabezado #cuadro_info{
            float: left;
            margin-left: 20px;
            width: 400px;
            padding: 10px 10px 10px 10px;
            text-align: center;
        }

        header #encabezado #cuadro_info p{
            text-align: center;
            font-size: 13px;
        }

        header #encabezado #cuadro_info h3{
            font-size: 15px;
            margin-top: 10px;
        }

        header #barcode{
            float: right;
            margin-top: 10px;
        }

        section #fecha{
            float: right;
            width: 100%;
            text-align: right;
            font-size: 13px;
            text-transform: uppercase;
        }

        section #contenidoTotal{
            float: left;
            width: 100%;
            margin-top: 10px;
            font-size: 12px;
        }

        section #contenidoTotal .informacion{
            float: left;
            width: 100%;
            margin-bottom: 10px;
        }

        section #contenidoTotal .informacion strong{
            float: left;
        }

        section #contenidoTotal .informacion .tipoCaracter{
            float: left;
            margin-left: 5px;
        }

        section #firma{
            float: left;
            width: 100%;
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }

        section #firma #espacioFirma{
            width: 500px;
            border-top: 1px solid #000;
            text-align: center;
            margin: auto;
            padding-top: 10px;
        }

        table tr td{
            padding: 5px 0px 5px 0px;
            font-size: 11px;
        }
    </style>
</head>

<body onload="javascript: window.print();">
    <div id="todo">
        <header>
            <div id="encabezado">
                <div id="logo"><img src="../farmaciat2/diseno/logoEncabezado.JPG" /></div>
                <div id="cuadro_info">
                    <p><strong>"HOSPITAL REGIONAL DR. VALENTIN GOMEZ FARIAS"</strong></p>
                    <h3>SOLICITUD DE AUXILIAR DE DIAGNOSTICO</h3>
                </div>
                <div id="barcode"><img src="../farmaciat2/barcode/barcode.php?code=<?php echo "00000000".$laboratorio['id_cita_detalle_laboratorio'] ?>&tam=1" height="40"></div>
            </div>
        </header>
        <section>
            <div id="fecha">ZAPOPAN,JAL. A <?php echo date("d"); ?> DE <?php echo $meses[date("n")] ?> <?php echo date("Y") ?></div>
            <div id="contenidoTotal">
                <div class="informacion" style="float:left; width:60%;">
                    <strong>NOMBRE DEL PACIENTE: </strong> <div class="tipoCaracter"><?php echo $derecho['ap_p'] ?> <?php echo $derecho['ap_m'] ?> <?php echo $derecho['nombres'] ?></div>
                </div>
                <div class="informacion" style="float:left; width:40%; margin:0px;">
                    <strong>CEDULA: </strong>
                    <div style="float:left; margin-left: 10px; margin-right:10px;"><img src="../farmaciat2/barcode/barcode.php?code=<?php echo $derecho['cedula'] ?><?php echo $derecho['cedula_tipo'] ?><?php echo calculaedad($derecho['fecha_nacimiento']) ?>&tam=1" height="35"></div>
                </div>
                <div class="informacion">
                    <strong>NOMBRE DEL ESTUDIO:</strong> 
                    <?php echo tablaEstudios($catalogo) ?>
                </div> 
<!--
                <div class="informacion">
                    <strong>DIAGNOSTICO: </strong> <div class="tipoCaracter"><?php echo $laboratorio['diagnostico'] ?></div>
                    <div style="float:left; margin-left: 10px; margin-right:10px;"><img src="../farmaciat2/barcode/barcode.php?code=<?php echo $explodeDiagnostico[0] ?>&tam=1" height="35"></div>
                </div>
                <div class="informacion" style="float:left; width:50%;">
                    <strong>SERVICIO QUE SOLICITA EL ESTUDIO: </strong> <div class="tipoCaracter"><?php echo $servicio ?></div>
                </div>
                <div class="informacion" style="float:left; width:50%;">
                    <strong>CARACTER: </strong> 
                    <div class="tipoCaracter">ORDINARIO: <?php echo $ordinario ?></div>
                </div>
!-->
                <div class="informacion">
                    <strong>OBSERVACIONES: </strong> <div class="tipoCaracter"><?php echo $laboratorio['observaciones'] ?></div>
                </div>
            </div>
            <div id="firma">
                <strong>DR(@). <?php echo $datosUsuario['nombre'] ?></strong>
                <div id="espacioFirma">FIRMA Y SELLO DEL MEDICO</div>
            </div>
        </section>
    </div>
</body>
</html>