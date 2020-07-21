<?php session_start ();
include_once('lib/misFunciones.php');
function getOptionDiagnosticos($texto) {
    global $hostname_bdissste;
    global $database_bdisssteF;
    global $username_bdisssteF;
    global $password_bdisssteF;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteF, $password_bdisssteF) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteF, $bdissste);
    $query_query = "SELECT m.id_medicamento AS id_m, m.descripcion, m.presentacion, m.unidad, c.se_convierte, c.factor_conversion, c.unidad_conversion FROM medicamentos m LEFT JOIN medicamentos_censo c ON (m.id_medicamento=c.id_medicamento) WHERE m.id_medicamento LIKE '%" . $texto . "%' OR m.descripcion LIKE '%" . $texto . "%' ORDER BY m.id_medicamento ASC, m.descripcion ASC";
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $bdissste);
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            if (isset($row_query["se_convierte"])) {
                if ($row_query["se_convierte"] == 's') {
                   $ret[] = array('data' => $row_query['id_m'], 'value' => $row_query['id_m'] . ' - ' . preg_replace("[\n|\r|\n\r|\t|\"]", ' ', $row_query['descripcion'] . '|' . $row_query["factor_conversion"] . '|' . $row_query["unidad_conversion"] ));
                } else {
                   $ret[] = array('data' => $row_query['id_m'], 'value' => $row_query['id_m'] . ' - ' . preg_replace("[\n|\r|\n\r|\t|\"]", ' ', $row_query['descripcion'] . '|' . $row_query["presentacion"] . '|' . $row_query["unidad"] ));
                }                
            } else {
                $ret[] = array('data' => $row_query['id_m'], 'value' => $row_query['id_m'] . ' - ' . preg_replace("[\n|\r|\n\r|\t|\"]", ' ', $row_query['descripcion'] . '|' . $row_query["presentacion"] . '|' . $row_query["unidad"] ));
            }
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;

}

$optionDiagnosticos = getOptionDiagnosticos($_GET['query']);
$optionDiagnosticos = array('query' => 'Unit', 'suggestions' => $optionDiagnosticos);

echo json_encode($optionDiagnosticos);
?>