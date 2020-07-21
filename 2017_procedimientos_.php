<?php require_once('Connections/bdissste.php'); ?>

<?php session_start ();
function getOptionDiagnosticos($texto) {
    global $hostname_bdissste;
    global $database_bdisssteR;
    global $username_bdisssteR;
    global $password_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM laboratorio_catalogo WHERE clave LIKE '%" . $texto . "%' OR descripcion LIKE '%" . $texto . "%' ORDER BY clave ASC, descripcion ASC";
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $bdissste);
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
			   $ret[] = array('data' => $row_query['clave'], 'value' => $row_query['clave'] . ' - ' . preg_replace("[\n|\r|\n\r|\t|\"]", ' ', $row_query['descripcion']));
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