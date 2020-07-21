<?php
session_start ();
include_once('lib/misFunciones.php');


function getOrdenMedicamentos($id_cama, $id_derecho, $fecha, $tipo) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM ordenes WHERE id_cama='" . $id_cama . "' AND id_derecho='" . $id_derecho . "' AND fecha<='" . $fecha . "' AND status='1' ORDER BY fecha DESC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    $fecha = '';
    if ($totalRows_query > 0) {
      do {
        if ($fecha == '') $fecha = $row_query["fecha"];
        if ($fecha == $row_query["fecha"]) {
          $sqlTipo = " AND tipo='" . $tipo . "'";
          if (($tipo == "0")) $sqlTipo = " AND (tipo='0' OR tipo='1' OR tipo='2')";
          $query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "'" . $sqlTipo;
          $query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
          $row_query2 = mysql_fetch_assoc($query2);
          $totalRows_query2 = mysql_num_rows($query2);
          $ret2 = array();
          if ($totalRows_query2 > 0) {
              do {
                $ret[] = array("id_orden" => $row_query["id_orden"], "id_cama" => $row_query["id_cama"], "id_derecho" => $row_query["id_derecho"], "id_medico" => $row_query["id_medico"], "id_servicio" => $row_query["id_servicio"], "fecha" => $row_query["fecha"], "fecha_agrego" => $row_query["fecha_agrego"], "fecha_modifico" => $row_query["fecha_modifico"], "status" => $row_query["status"], "extra" => $row_query["extra"], "id_usuario" => $row_query["id_usuario"], "id_concepto" => $row_query2["id_concepto"], "id_campos" => $row_query2["id_campos"], "campos" => $row_query2["campos"]);
              } while ($row_query2 = mysql_fetch_assoc($query2));
          }
        }
        $fecha = $row_query["fecha"];
      } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}



function getHistorial($id_movimiento) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_en_piso_observaciones WHERE id_movimiento='" . $id_movimiento . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = "";
    if ($totalRows_query > 0) {
		do {
			$ret .= formatoDia($row_query['fecha'], 'fecha') . ' ' . formatoHora($row_query['hora']) . '<small>';
			if (trim($row_query['pendientes']) != '') $ret .= ', Pendientes: ' . $row_query['pendientes'];
			if (trim($row_query['observaciones']) != '') $ret .= ', Observaciones: ' . $row_query['observaciones'];
			if (trim($row_query['interconsultas']) != '') $ret .= ', Interconsultas: ' . $row_query['interconsultas'];
			if (trim($row_query['diagnostico']) != '') $ret .= ', Diagn&oacute;stico: ' . $row_query['diagnostico'];
			$ret .= '</small><br />';
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return strtolower($ret);
}

function getDatosPacienteEnCama2014_2($id_cama) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_en_piso WHERE id_cama='" . $id_cama . "' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    $ret = "";
	$tmpHistorial = '';
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
        $tmpHistorial = getHistorial($row_query['id_movimiento']);
        $ret = array(
            'id_movimiento' => $row_query['id_movimiento'],
            'id_cama' => $row_query['id_cama'],
            'id_derecho' => $row_query['id_derecho'],
            'id_medico' => $row_query['id_medico'],
            'id_servicio' => $row_query['id_servicio'],
            'fecha_ingreso' => $row_query['fecha_ingreso'],
            'hora_ingreso' => $row_query['hora_ingreso'],
            'procedencia' => $row_query['procedencia'],
            'observaciones' => $row_query['observaciones'],
            'extra' => $row_query['extra1'],
            'cedula' => $datosPaciente['cedula'],
            'cedula_tipo' => $datosPaciente['cedula_tipo'],
            'ap_p' => $datosPaciente['ap_p'],
            'ap_m' => $datosPaciente['ap_m'],
            'nombres' => $datosPaciente['nombres'],
            'telefono' => $datosPaciente['telefono'],
            'direccion' => $datosPaciente['direccion'],
            'estado' => $datosPaciente['estado'],
            'medico_cedula' => $datosMedico['cedula'],
            'medico_cedula_tipo' => $datosMedico['cedula_tipo'],
            'medico_titulo' => $datosMedico['titulo'],
            'medico_ap_p' => $datosMedico['ap_p'],
            'medico_ap_m' => $datosMedico['ap_m'],
            'medico_nombres' => $datosMedico['nombres'],
			 'historial' => $tmpHistorial,
            'servicio_nombre' => $datosServicio
        );
    }
    return $ret;
}


$datos = getDatosPacienteEnCama2014_2($_GET['id_cama']);
$datos_cama = getDatosCama($_GET['id_cama']);
$datos_piso = getPiso($datos_cama['id_piso']);
$servicios = listaServicios();

$orden = getOrdenMedicamentos($_GET['id_cama'], $_GET["id_derecho"], $_GET["fecha"], $_GET["tipo"]);
if (count($orden) == 0) {
  print("0");
  exit;
} else {
  $out = '<table class="table table-striped">';
  $out .= '<tr><th>Tipo</th><th>Orden</th><th>Indicaciones</th><th></th></tr>';
  foreach ($orden as $key => $datos) {
    $obj = json_decode($datos["campos"]);
    if (($_GET["tipo"] == "0") || ($_GET["tipo"] == "6")) // alimentos y auxiliares
      $out .= '<tr><td>' . $obj->tipo . '</td><td><small>' . $obj->descripcion . '</small></td><td><small>' . $obj->indicaciones . '</small></td><td><input type="checkbox" class="anterioresConceptos" value="' . $datos["id_concepto"] . '" Dcantidad="" Dtipo="' . $obj->tipo . '" Dperiodo="" Dvia="" Dconcepto="' . $obj->descripcion . '" Did="' . $datos["id_campos"] . '" Dindicaciones="' . $obj->indicaciones . '" /></td></tr>';
    else
      $out .= '<tr><td>' . $obj->tipo . '</td><td><small>' . $obj->concepto . '</small></td><td><small>' . $obj->indicaciones . '</small></td><td><input type="checkbox" class="anterioresConceptos" value="' . $datos["id_concepto"] . '" Dcantidad="' . $obj->cantidad . '" Dtipo="' . $obj->tipo . '" Dperiodo="' . $obj->periodo . '" Dvia="' . $obj->via . '" Dconcepto="' . $obj->concepto . '" Did="' . $datos["id_campos"] . '" Dindicaciones="' . $obj->indicaciones . '" /></td></tr>';
  }
  $out .= '</table>';
  print($out);
}


?>