<?php session_start ();
include_once('lib/misFunciones.php');
function getOptionDiagnosticos($texto) {
    global $hostname_bdissste;
    global $database_bdisssteC;
    global $username_bdisssteC;
    global $password_bdisssteC;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteC, $password_bdisssteC) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteC, $bdissste);
    $query_query = "SELECT * FROM cie_10_simef WHERE Clave LIKE '%" . $texto . "%' OR Decripcion LIKE '%" . $texto . "%' ORDER BY Clave ASC, Decripcion ASC";
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $bdissste);
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
			   $ret[] = array('data' => $row_query['Clave'], 'value' => $row_query['Clave'] . ' - ' . $row_query['Decripcion']);
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