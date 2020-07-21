<?php session_start ();
include_once('lib/misFunciones.php');
function getOptionDiagnosticos($texto, $tipo) {
    global $hostname_bdissste;
    global $database_bdisssteR;
    global $username_bdisssteR;
    global $password_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $id_familia = '';

//    $database_bdisssteC = 'sistema_agenducha';
//    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
//    mysql_select_db($database_bdisssteC, $bdissste);
    $query_query = "SELECT * FROM   laboratorio_catalogo WHERE (extra1 LIKE '%" . $texto . "%' OR descripcion LIKE '%" . $texto . "%') ORDER BY extra1 ASC, descripcion ASC";
    $query_paquete = "SELECT * FROM  grupo_estudios";
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $bdissste);

    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $queryPaquete = mysql_query($query_paquete, $bdissste) or die(mysql_error());

    $row_paquete = mysql_fetch_assoc($queryPaquete);
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    $clavesGrupo = array();
    if ($totalRows_query > 0) {
        do {
            $query_estudios = "SELECT * FROM  estudio_x_grupo WHERE id_grupo='".$row_paquete['id_grupo']."'";
            $queryEstudios = mysql_query($query_estudios, $bdissste) or die(mysql_error());
            $row_estudio = mysql_fetch_assoc($queryEstudios);
            do{
                $query_laboratorio = "SELECT * FROM laboratorio_catalogo WHERE id_estudio='".$row_estudio['id_estudio']."'";
                $queryLaboratorio = mysql_query($query_laboratorio, $bdissste) or die(mysql_error());
                $row_laboratorio = mysql_fetch_assoc($queryLaboratorio);
                do{
                    $clavesGrupo[$row_paquete['id_grupo']][] = $row_laboratorio['clave'];
                }while($row_laboratorio = mysql_fetch_assoc($queryLaboratorio));

            }while($row_estudio = mysql_fetch_assoc($queryEstudios));
            $ret[] = array('data' => $clavesGrupo[$row_paquete['id_grupo']], 'value' => "GRUPO: " . $row_paquete['nombre_grupo']);
        } while ($row_paquete = mysql_fetch_assoc($queryPaquete));

        do {
			$ret[] = array('data' => $row_query['clave'], 'value' => $row_query['clave'] . ' - ' . $row_query['descripcion']);
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;

}

$optionDiagnosticos = getOptionDiagnosticos($_GET['query'], '');
$optionDiagnosticos = array('query' => 'Unit', 'suggestions' => $optionDiagnosticos);

echo json_encode($optionDiagnosticos);
?>