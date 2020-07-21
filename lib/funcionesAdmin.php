<?php require_once('../Connections/bdissste.php'); ?>
<?php @session_start ();
$statusCitas = array("DISPONIBLE","CITA PENDIENTE","CITA CUBIERTA","DE VACACIONES","EN CONGRESO","DIA INHABIL","LICENCIA MEDICA","BAJA TEMPORAL","OTRO","ELIMINADA");
$statusDerecho = array("ACTIVO","INACTIVO","OTRO");
$statusUsuario = array("ACTIVO","INACTIVO");
$tipoCita = array("PRIMERA VEZ","SUBSECUENTE","PROCEDIMIENTO");
$tipoCitaAbr = array("PRV","SUB","PRO");
$titulos = array("DR.","DRA.");
$tipoUsuario = array("ADMINISTRADOR","CAPTURISTA PISO","CAPTURISTA URGENCIAS","VISOR","REPORTES","MEDICO","","","ENFERMERA(O)","CAPTURISTA TODO");
$tipo_cedulas = array("10","20","30","31","32","40","41","50","51","60","61","70","71","80","81","90","91","92","99");
$tipoPiso = array("URGENCIAS","PISO");

$menu[0] = "<ul id=\"menu\" class=\"MenuBarHorizontal\">
        <li><a class=\"MenuBarItemSubmenu\" href=\"#\">Administraci&oacute;n</a>
            <ul>
              <li><a href=\"pisos.php\" class=\"MenuBarHorizontal\">Pisos</a>
                </li>
              <li><a href=\"camas.php\" class=\"MenuBarHorizontal\">Camas</a>
                </li>
			  <li><a href=\"usuarios.php\" class=\"MenuBarHorizontal\">Usuarios</a>
                </li>
            </ul>
        </li>
        <li><a class=\"MenuBarItemSubmenu\" href=\"#\">Reportes</a>
			<ul>
				<li><a href=\"reporte_cita_mas_lejana.php\" class=\"MenuBarHorizontal\">Citas mas Lejanas</a>
                </li>
				<li><a href=\"reporte_promedio_de_citas.php\" class=\"MenuBarHorizontal\">Reporte de Promedio de Citas</a>
                </li>
				<li><a href=\"reporte_ocupacion_de_consultorios.php\" class=\"MenuBarHorizontal\">Reporte de Ocupacion de Consultorios</a>
                </li>
				<li><a href=\"reporte_promedio_citas.php\" class=\"MenuBarHorizontal\">Reporte Promedio de Citas Otorgadas</a>
                </li>
				<li><a href=\"reporte_lista_derechohabientes.php\" class=\"MenuBarHorizontal\">Reporte Lista de Derechohabientes</a>
                </li>
			</ul>
		</li>
        <li><a href=\"#\">Extras</a>            </li>
        <li><a href=\"logout.php\">Salir</a></li>
      </ul>
"; 
$menu[3] = "<ul id=\"menu\" class=\"MenuBarHorizontal\">
        <li><a class=\"MenuBarItemSubmenu\" href=\"#\">Reportes</a>
			<ul>
				<li><a href=\"reportes_ficha_para_archivo.php\" class=\"MenuBarHorizontal\">Ficha para Archivo</a>
                </li>
				<li><a href=\"reportes_ficha_para_archivo_extemporaneas.php\" class=\"MenuBarHorizontal\">Ficha para Archivo (Citas Extempor&aacute;neas)</a>
                </li>
			</ul>
		</li>
        <li><a href=\"logout.php\">Salir</a></li>
      </ul>
";
$menu[4] = "<ul id=\"menu\" class=\"MenuBarHorizontal\">
        <li><a class=\"MenuBarItemSubmenu\" href=\"#\">Reportes</a>
			<ul>
				<li><a href=\"reporte_cita_mas_lejana.php\" class=\"MenuBarHorizontal\">Citas mas Lejanas</a>
                </li>
				<li><a href=\"reporte_promedio_de_citas.php\" class=\"MenuBarHorizontal\">Reporte de Promedio de Citas</a>
                </li>
				<li><a href=\"reporte_ocupacion_de_consultorios.php\" class=\"MenuBarHorizontal\">Reporte de Ocupacion de Consultorios</a>
                </li>
				<li><a href=\"reporte_promedio_citas.php\" class=\"MenuBarHorizontal\">Reporte Promedio de Citas Otorgadas</a>
                </li>
				<li><a href=\"reporte_lista_derechohabientes.php\" class=\"MenuBarHorizontal\">Reporte Lista de Derechohabientes</a>
                </li>
			</ul>
		</li>
        <li><a href=\"logout.php\">Salir</a></li>
      </ul>
"; 

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

//  --------  FUNCIONES DE CONSULTORIOS ------------------------

function getConsultorios() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM consultorios WHERE st='1' ORDER BY nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_consultorio' => $row_query['id_consultorio'],
						'nombre' => $row_query['nombre']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
//	mysql_close($dbissste);
	return $ret;
}

function getConsultorioXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM consultorios WHERE id_consultorio='" . $id . "' AND st='1' ORDER BY nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_consultorio' => $row_query['id_consultorio'],
						'nombre' => $row_query['nombre']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

//  --------  FUNCIONES DE CONSULTORIOS ------------------------
//  --------  FUNCIONES DE SERVICIOS ------------------------
function getServicios() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM servicios WHERE st='1' ORDER BY clave ASC, nombre ASC";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_servicio' => $row_query['id_servicio'],
						'clave' => $row_query['clave'],
						'nombre' => $row_query['nombre'],
						'st' => $row_query['st']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getServicioXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM servicios WHERE id_servicio='" . $id . "' AND st='1' ORDER BY clave ASC, nombre ASC";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_servicio' => $row_query['id_servicio'],
						'clave' => $row_query['clave'],
						'nombre' => $row_query['nombre'],
						'st' => $row_query['st']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

//  --------  FUNCIONES DE SERVICIOS ------------------------
//  --------  FUNCIONES DE USUARIOS ------------------------

function getUsuarios() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM usuarios WHERE st='1' ORDER BY nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_usuario' => $row_query['id_usuario'],
						'login' => $row_query['login'],
						'pass' => $row_query['pass'],
						'nombre' => $row_query['nombre'],
						'tipo_usuario' => $row_query['tipo_usuario'],
						'status' => $row_query['status'],
						'st' => $row_query['st']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getUsuarioXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM usuarios WHERE id_usuario='" . $id . "' AND st='1' ORDER BY nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_usuario' => $row_query['id_usuario'],
						'login' => $row_query['login'],
						'pass' => $row_query['pass'],
						'nombre' => $row_query['nombre'],
						'tipo_usuario' => $row_query['tipo_usuario'],
						'id_consultorio' => $row_query['id_consultorio'],
						'id_servicio' => $row_query['id_servicio'],
						'status' => $row_query['status']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

//  --------  FUNCIONES DE USUARIOS ------------------------
//  --------  FUNCIONES DE MEDICOS ------------------------

function getMedicos() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM medicos WHERE st='1' ORDER BY ap_p ASC, ap_m ASC, nombres ASC";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_medico' => $row_query['id_medico'],
						'cedula' => $row_query['cedula'],
						'cedula_tipo' => $row_query['cedula_tipo'],
						'titulo' => $row_query['titulo'],
						'ap_p' => $row_query['ap_p'],
						'ap_m' => $row_query['ap_m'],
						'nombres' => $row_query['nombres'],
						'turno' => $row_query['turno'],
						'telefono' => $row_query['telefono'],
						'direccion' => $row_query['direccion'],
						'tipo_medico' => $row_query['tipo_medico'],
						'id_servicio1' => $row_query['id_servicio1'],
						'id_servicio2' => $row_query['id_servicio2'],
						'hora_entrada' => $row_query['hora_entrada'],
						'hora_salida' => $row_query['hora_salida'],
						'intervalo_citas0' => $row_query['intervalo_citas0'],
						'intervalo_citas1' => $row_query['intervalo_citas1'],
						'intervalo_citas2' => $row_query['intervalo_citas2'],
						'observaciones' => $row_query['observaciones'],
						'st' => $row_query['st']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getMedicoXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM medicos WHERE id_medico='" . $id . "' AND st='1'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_medico' => $row_query['id_medico'],
						'cedula' => $row_query['cedula'],
						'cedula_tipo' => $row_query['cedula_tipo'],
						'n_empleado' => $row_query['n_empleado'],
						'ced_pro' => $row_query['cedula_profesional'],
						'titulo' => $row_query['titulo'],
						'ap_p' => $row_query['ap_p'],
						'ap_m' => $row_query['ap_m'],
						'nombres' => $row_query['nombres'],
						'turno' => $row_query['turno'],
						'telefono' => $row_query['telefono'],
						'direccion' => $row_query['direccion'],
						'tipo_medico' => $row_query['tipo_medico'],
						'id_servicio1' => $row_query['id_servicio1'],
						'id_servicio2' => $row_query['id_servicio2'],
						'hora_entrada' => $row_query['hora_entrada'],
						'hora_salida' => $row_query['hora_salida'],
						'intervalo_citas0' => $row_query['intervalo_citas0'],
						'intervalo_citas1' => $row_query['intervalo_citas1'],
						'intervalo_citas2' => $row_query['intervalo_citas2'],
						'observaciones' => $row_query['observaciones'],
						'st' => $row_query['st']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getMedicoXCedEmp($cedula, $n_empleado) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT id_medico FROM medicos WHERE cedula='" . $cedula . "' AND n_empleado='" . $n_empleado . "' AND st='1'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret= "";
	if ($totalRows_query>0){
		$ret = $row_query['id_medico'];
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getHorariosXmedico($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM horarios WHERE id_medico='" . $id . "' ORDER BY id_horario";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_horario' => $row_query['id_horario'],
						'id_consultorio' => $row_query['id_consultorio'],
						'id_servicio' => $row_query['id_servicio'],
						'dia' => $row_query['dia'],
						'hora_inicio' => $row_query['hora_inicio'],
						'hora_fin' => $row_query['hora_fin'],
						'tipo_cita' => $row_query['tipo_cita']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getCitasXHorario($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM citas WHERE id_horario='" . $id . "' ORDER BY id_cita";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_cita' => $row_query['id_cita'],
						'id_horario' => $row_query['id_horario'],
						'id_derecho' => $row_query['id_derecho'],
						'fecha_cita' => $row_query['fecha_cita'],
						'status' => $row_query['status'],
						'observaciones' => $row_query['observaciones'],
						'id_usuario' => $row_query['id_usuario']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getCitaDatos($id_cita) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM citas WHERE id_cita='" . $id_cita . "' LIMIT 1";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
		$ret=array(
					'id_cita' => $row_query['id_cita'],
					'id_horario' => $row_query['id_horario'],
					'id_derecho' => $row_query['id_derecho'],
					'fecha_cita' => $row_query['fecha_cita'],
					'status' => $row_query['status'],
					'observaciones' => $row_query['observaciones'],
					'id_usuario' => $row_query['id_usuario']
				);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getServiciosXmedico($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM servicios_x_consultorio WHERE id_medico='" . $id . "' ORDER BY id_servicio";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_consultorio' => $row_query['id_consultorio'],
						'id_servicio' => $row_query['id_servicio'],
						'extra1' => $row_query['extra1']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getHorarioParaModificar($query_query) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
		$ret=array(
					'id_horario' => $row_query['id_horario'],
					'id_consultorio' => $row_query['id_consultorio'],
					'id_servicio' => $row_query['id_servicio'],
					'dia' => $row_query['dia'],
					'hora_inicio' => $row_query['hora_inicio'],
					'hora_fin' => $row_query['hora_fin'],
					'tipo_cita' => $row_query['tipo_cita']
				);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function compararFechas($hoy, $otra) {
	$hoyMK = mktime(0, 0, 0, substr($hoy,4,2), substr($hoy,6,2), substr($hoy,0,4));
	$otraMK = mktime(0, 0, 0, substr($otra,4,2), substr($otra,6,2), substr($otra,0,4));
	if ($otraMK >= $hoyMK) return true; else return false;
}

function getCitasAreprogramar($id_consultorio, $id_servicio, $id_medico, $hoy) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM horarios WHERE id_consultorio='" . $id_consultorio . "' AND id_servicio='" . $id_servicio . "' AND id_medico='" . $id_medico . "' ORDER BY id_horario";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$query_query2 = "SELECT * FROM citas WHERE id_horario='" . $row_query['id_horario'] . "' AND status='1' ORDER BY id_cita";
			$query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
			$row_query2 = mysql_fetch_assoc($query2);
			$totalRows_query2 = mysql_num_rows($query2);
			if ($totalRows_query2>0){
				do{
					$esFutura = compararFechas($hoy, $row_query2['fecha_cita']);
					if ($esFutura) {
						$ret[]=array(
									'id_cita' => $row_query2['id_cita'],
									'id_horario' => $row_query2['id_horario'],
									'id_derecho' => $row_query2['id_derecho'],
									'fecha_cita' => $row_query2['fecha_cita'],
									'status' => $row_query2['status'],
									'observaciones' => $row_query2['observaciones'],
									'id_usuario' => $row_query2['id_usuario'],
									'extra1' => $row_query2['extra1']
								);
					}
				}while($row_query2 = mysql_fetch_assoc($query2));
			}
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

//  --------  FUNCIONES DE MEDICOS ------------------------
//  --------  FUNCIONES DE DERECHOHABIENTES ------------------------

function getDerechohabientes() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM derechohabientes WHERE st='1' ORDER BY cedula ASC, cedula_tipo ASC, ap_p ASC, ap_m ASC, nombres ASC";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_derecho' => $row_query['id_derecho'],
						'cedula' => $row_query['cedula'],
						'cedula_tipo' => $row_query['cedula_tipo'],
						'ap_p' => $row_query['ap_p'],
						'ap_m' => $row_query['ap_m'],
						'nombres' => $row_query['nombres'],
						'fecha_nacimiento' => $row_query['fecha_nacimiento'],
						'telefono' => $row_query['telefono'],
						'direccion' => $row_query['direccion'],
						'estado' => $row_query['estado'],
						'municipio' => $row_query['municipio'],
						'status' => $row_query['status'],
						'st' => $row_query['st']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getDerechohabienteXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM derechohabientes WHERE id_derecho='" . $id . "' AND st='1'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
					'id_derecho' => $row_query['id_derecho'],
					'cedula' => $row_query['cedula'],
					'cedula_tipo' => $row_query['cedula_tipo'],
					'ap_p' => $row_query['ap_p'],
					'ap_m' => $row_query['ap_m'],
					'nombres' => $row_query['nombres'],
					'fecha_nacimiento' => $row_query['fecha_nacimiento'],
					'telefono' => $row_query['telefono'],
					'direccion' => $row_query['direccion'],
					'estado' => $row_query['estado'],
					'municipio' => $row_query['municipio'],
					'status' => $row_query['status'],
					'st' => $row_query['st']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getCitasXdh($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM citas WHERE id_derecho='" . $id . "' ORDER BY id_cita";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_cita' => $row_query['id_cita'],
						'id_horario' => $row_query['id_horario'],
						'id_derecho' => $row_query['id_derecho'],
						'fecha_cita' => $row_query['fecha_cita'],
						'status' => $row_query['status'],
						'observaciones' => $row_query['observaciones'],
						'id_usuario' => $row_query['id_usuario']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getDerechohabientesOrdenados($orden) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM derechohabientes WHERE st='1' ORDER BY " . $orden;
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_derecho' => $row_query['id_derecho'],
						'cedula' => $row_query['cedula'],
						'cedula_tipo' => $row_query['cedula_tipo'],
						'ap_p' => $row_query['ap_p'],
						'ap_m' => $row_query['ap_m'],
						'nombres' => $row_query['nombres'],
						'fecha_nacimiento' => $row_query['fecha_nacimiento'],
						'telefono' => $row_query['telefono'],
						'direccion' => $row_query['direccion'],
						'estado' => $row_query['estado'],
						'municipio' => $row_query['municipio'],
						'status' => $row_query['status'],
						'st' => $row_query['st']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}
//  --------  FUNCIONES DE DERECHOHABIENTES ------------------------


function ejecutarSQL($query_query) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query = mysql_query($query_query, $bdissste); //or die(mysql_error());
	$error[0] = mysql_errno();
	$error[1] = mysql_error();
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $error;
}

function existeDuplica($query_query) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
		$ret = true;
	} else {
		$ret = false;
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function formatoHora($hora) {
	return substr($hora,0,2) . ":" . substr($hora,2,2);
}

function quitarPuntosHora($hora) {
	return substr($hora,0,2) . substr($hora,3,2);
}

function diaSemana($dia_num) {
	switch ($dia_num) {
		case 0: return "DOMINGO";
				break;
		case 1: return "LUNES";
				break;
		case 2: return "MARTES";
				break;
		case 3: return "MIERCOLES";
				break;
		case 4: return "JUEVES";
				break;
		case 5: return "VIERNES";
				break;
		case 6: return "SABADO";
				break;
	}
}

function quitarAcentos($Text)  
{  
	$cadena=""; 
	$temp = "";
	$total = strlen($Text);
	for ($j=0;$j<$total;$j++)  
	{  
		$cara=$Text[$j];
		if ($cara == "&") {
			$temp = substr($Text,$j,8);
			switch ($temp) {
				case "&aacute;": $cadena .= "(/a)";
				$j = $j + 7;
				break;
				case "&Aacute;": $cadena .= "(/A)";
				$j = $j + 7;
				break;
				case "&eacute;": $cadena .= "(/e)";
				$j = $j + 7;
				break;
				case "&Eacute;": $cadena .= "(/E)";
				$j = $j + 7;
				break;
				case "&iacute;": $cadena .= "(/i)";
				$j = $j + 7;
				break;
				case "&iacute;": $cadena .= "(/I)";
				$j = $j + 7;
				break;
				case "&oacute;": $cadena .= "(/o)";
				$j = $j + 7;
				break;
				case "&Oacute;": $cadena .= "(/O)";
				$j = $j + 7;
				break;
				case "&uacute;": $cadena .= "(/u)";
				$j = $j + 7;
				break;
				case "&uacute;": $cadena .= "(/U)";
				$j = $j + 7;
				break;
				case "&ntilde;": $cadena .= "(/n)";
				$j = $j + 7;
				break;
				case "&Ntilde;": $cadena .= "(/N)";
				$j = $j + 7;
				break;
				default:  
				$cadena.=$Text[$j];  
				break;  
			}
		} else {
			switch($cara)  
			{  
				case "·": $cadena.="(/a)";  
				break;  
				case "È": $cadena.="(/e)";  
				break;  
				case "Ì": $cadena.="(/i)";  
				break;  
				case "Û": $cadena.="(/o)";  
				break;  
				case "˙": $cadena.="(/u)";  
				break;  
				case "¡": $cadena.="(/A)";  
				break;  
				case "…": $cadena.="(/E)";  
				break;  
				case "Õ": $cadena.="(/I)";  
				break;  
				case "”": $cadena.="(/O)";  
				break;  
				case "⁄": $cadena.="(/U)";  
				break;  
				case "Ò": $cadena.="(/n)";  
				break;  
				case "—": $cadena.="(/N)";  
				break;  
				default:  
				$cadena.=$Text[$j];  
				break;  
			}  
		}
	}  
	return $cadena;  
}  

function ponerAcentos($Text) {
	$cadena=""; 
	$temp = "";
	$total = strlen($Text);
	for ($j=0;$j<$total;$j++)  
	{  
		$cara=$Text[$j];
		if ($cara == "(") {
			$temp = substr($Text,$j,4);
			switch ($temp) {
				case "(/a)": $cadena .= "&aacute;";
				$j = $j + 3;
				break;
				case "(/A)": $cadena .= "&Aacute;";
				$j = $j + 3;
				break;
				case "(/e)": $cadena .= "&eacute;";
				$j = $j + 3;
				break;
				case "(/E)": $cadena .= "&Eacute;";
				$j = $j + 3;
				break;
				case "(/i)": $cadena .= "&iacute;";
				$j = $j + 3;
				break;
				case "(/I)": $cadena .= "&Iacute;";
				$j = $j + 3;
				break;
				case "(/o)": $cadena .= "&oacute;";
				$j = $j + 3;
				break;
				case "(/O)": $cadena .= "&Oacute;";
				$j = $j + 3;
				break;
				case "(/u)": $cadena .= "&uacute;";
				$j = $j + 3;
				break;
				case "(/U)": $cadena .= "&Uacute;";
				$j = $j + 3;
				break;
				case "(/n)": $cadena .= "&ntilde;";
				$j = $j + 3;
				break;
				case "(/N)": $cadena .= "&Ntilde;";
				$j = $j + 3;
				break;
				default:  
				$cadena.=$Text[$j];  
				break;  
			}
		} else {
			$cadena.=$Text[$j];  
		}
	}  
	return $cadena;
}


function opcionesCon($idCon) {
	$consultorios = getConsultorios();
	$totalConsultorios = count($consultorios);
	$out = "";
	if ($totalConsultorios > 0) {
		if ($idCon == "-1") { // que no se ha seleccionado ningun consultorio, seleccionamos el primero de la base de datos 
			$seleccionado = false;
			for($i=0; $i<$totalConsultorios; $i++) {
				if ($seleccionado == false) {
					$out.= "<option selected value=\"" . $consultorios[$i]['id_consultorio'] . "\">" . ponerAcentos($consultorios[$i]['nombre']) . "</option>";
					$seleccionado = true;
					$_SESSION['IdCon'] = $consultorios[$i]['id_consultorio'];
				} else {
					$out.= "<option value=\"" . $consultorios[$i]['id_consultorio'] . "\">" . ponerAcentos($consultorios[$i]['nombre']) . "</option>";
				}
			}
		} else { // seleccionamos de la base de datos el consultorio con idCon;
			for($i=0; $i<$totalConsultorios; $i++) {
				if ($idCon == $consultorios[$i]['id_consultorio']) {
					$out.= "<option selected value=\"" . $consultorios[$i]['id_consultorio'] . "\">" . ponerAcentos($consultorios[$i]['nombre']) . "</option>";
					$_SESSION['IdCon'] = $consultorios[$i]['id_consultorio'];
				} else {
					$out.= "<option value=\"" . $consultorios[$i]['id_consultorio'] . "\">" . ponerAcentos($consultorios[$i]['nombre']) . "</option>";
				}
			}
		}
	} else {
		$out = "<option value=\"-1\">NO EXISTEN CONSULTORIOS</option>";
	}
	return $out;
}

function opcionesSer($idCon,$idSer) {
	$servicios = getServiciosXConsultorio($idCon);
	$totalServicios = count($servicios);
	$out = "";
	if ($totalServicios > 0) {
		if ($idSer == "-1") { // que no se ha seleccionado ningun servicio, seleccionamos el primero de la base de datos 
			$seleccionado = false;
			for($i=0; $i<$totalServicios; $i++) {
				if ($seleccionado == false) {
					$out.= "<option selected value=\"" . $servicios[$i]['id_servicio'] . "\">" . ponerAcentos($servicios[$i]['nombre']) . "</option>";
					$seleccionado = true;
					$_SESSION['idServ'] = $servicios[$i]['id_servicio'];
				} else {
					$out.= "<option value=\"" . $servicios[$i]['id_servicio'] . "\">" . ponerAcentos($servicios[$i]['nombre']) . "</option>";
				}
			}
		} else { // seleccionamos de la base de datos el consultorio con idCon;
			for($i=0; $i<$totalServicios; $i++) {
				if ($idSer == $servicios[$i]['id_servicio']) {
					$out.= "<option selected value=\"" . $servicios[$i]['id_servicio'] . "\">" . ponerAcentos($servicios[$i]['nombre']) . "</option>";
					$_SESSION['idServ'] = $servicios[$i]['id_servicio'];
				} else {
					$out.= "<option value=\"" . $servicios[$i]['id_servicio'] . "\">" . ponerAcentos($servicios[$i]['nombre']) . "</option>";
				}
			}
		}
	} else {
		$out = "<option value=\"-1\">NO EXISTEN SERVICIOS</option>";
	}
	return $out;
}

function opcionesMed($idCon,$idSer,$idMed) {
	$medicos = getMedicosXServicioXConsultorio($idCon, $idSer);
	$totalMedicos = count($medicos);
	$out = "";
	if ($totalMedicos > 0) {
		if ($idMed == "-1") { // que no se ha seleccionado ningun servicio, seleccionamos el primero de la base de datos 
			$seleccionado = false;
			for($i=0; $i<$totalMedicos; $i++) {
				if ($seleccionado == false) {
					$out.= "<option selected value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
					$seleccionado = true;
					$_SESSION['idDr'] = $medicos[$i]['id_medico'];
				} else {
					$out.= "<option value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
				}
			}
		} else { // seleccionamos de la base de datos el consultorio con idCon;
			for($i=0; $i<$totalMedicos; $i++) {
				if ($idMed == $medicos[$i]['id_medico']) {
					$out.= "<option selected value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
					$_SESSION['idDr'] = $medicos[$i]['id_medico'];
				} else {
					$out.= "<option value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
				}
			}
		}
	} else {
		$out = "<option value=\"-1\">NO EXISTEN MEDICOS</option>";
	}
	return $out;
}

function getServiciosXConsultorio($idCon) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$idMedico =  regresarIdMedico($idConsultorio,$idServicio);
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT DISTINCT x.id_servicio, s.id_servicio, s.nombre, s.clave FROM servicios_x_consultorio x, servicios s WHERE x.id_consultorio='" . $idCon . "' AND x.id_servicio=s.id_servicio ORDER BY s.nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_servicio' => $row_query['id_servicio'],
						'clave' => $row_query['clave'],
						'nombre' => $row_query['nombre']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getMedicosXServicioXConsultorio($idCon, $idSer) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$idMedico =  regresarIdMedico($idConsultorio,$idServicio);
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT x.id_consultorio, x.id_servicio, x.id_medico, m.id_medico, m.titulo, m.nombres, m.ap_p, m.ap_m FROM servicios_x_consultorio x, medicos m WHERE x.id_consultorio='" . $idCon . "' AND x.id_servicio='" . $idSer . "' AND x.id_medico=m.id_medico AND m.st='1' ORDER BY m.ap_p ASC, m.ap_m ASC, m.nombres ASC";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_medico' => $row_query['id_medico'],
						'titulo' => $row_query['titulo'],
						'ap_p' => $row_query['ap_p'],
						'ap_m' => $row_query['ap_m'],
						'nombres' => $row_query['nombres']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function  regresarIdMedico($idConsultorio,$idServicio) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT id_medico FROM servicios_x_consultorio WHERE id_consultorio='" . $idConsultorio . "' and id_servicio='" . $idServicio . "'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$idMedico = $row_query['id_medico'];
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $idMedico;
}

function tituloDia($dia_num) {
	switch ($dia_num) {
		case 0: return "<abbr title=\"Domingo\">Domingo</abbr>";
				break;
		case 1: return "<abbr title=\"Lunes\">Lunes</abbr>";
				break;
		case 2: return "<abbr title=\"Martes\">Martes</abbr>";
				break;
		case 3: return "<abbr title=\"Miercoles\">Mi&eacute;rcoles</abbr>";
				break;
		case 4: return "<abbr title=\"Jueves\">Jueves</abbr>";
				break;
		case 5: return "<abbr title=\"Viernes\">Viernes</abbr>";
				break;
		case 6: return "<abbr title=\"Sabado\">S&aacute;bado</abbr>";
				break;
	}
}

function tituloMes($mes) {
	$meses = array(12);
	if ($mes[0] == "0") $mes = $mes[1];
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
	return $meses[$mes];
}

function recuperarCantidadCitas($tipoCitas,$fechaCitas,$idUsuario,$idConsultorio,$idServicio,$idMedico) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
//	$idMedico =  regresarIdMedico($idConsultorio,$idServicio);
	$idCita = idTipoCita($tipoCitas);
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$temp = mktime(0, 0, 0, substr($fechaCitas,4,2), substr($fechaCitas,6,2), substr($fechaCitas,0,4));
	$queDia = date("N", $temp);
	$query_query = "SELECT * FROM horarios WHERE id_medico='" . $idMedico . "' and id_servicio='" . $idServicio . "'and id_consultorio='" . $idConsultorio . "' and tipo_cita='" . $idCita . "' and dia='" . diaSemana($queDia) . "'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query2 = mysql_num_rows($query);

	$cuantas = 0;
	if ($totalRows_query2>0){
		do{
			$query_query2 = "SELECT * FROM citas WHERE id_horario='" . $row_query['id_horario'] . "' and fecha_cita='" . $fechaCitas . "'";
			$query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
			$cuantas+= mysql_num_rows($query2);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_free_result($query2);
	@mysql_close($dbissste);
	if ($totalRows_query2 == 0) {
		$clase="conteoCitasRojo";
	} else {
		$porcentaje = round(($cuantas / $totalRows_query2)*100);
		if (($porcentaje >= 0) && ($porcentaje <=50)) $clase="conteoCitasVerde";
		if (($porcentaje >= 51) && ($porcentaje <=98)) $clase="conteoCitasAmbar";
		if (($porcentaje >= 99) && ($porcentaje <=100)) $clase="conteoCitasRojo";
	}
	return '<span class="' . $clase . '">' . $cuantas . '/' . $totalRows_query2 . ' ' . $tipoCitas . '</span><br>';
}

function idTipoCita ($tipoCita) {
	if($tipoCita == "PRV") return 0;
	if($tipoCita == "SUB") return 1;
	if($tipoCita == "PRO") return 2;	
}

function formatoDia($fecha, $paraDonde) {
	$dia = substr($fecha,6,2);
	$mes = substr($fecha,4,2);
	$ano = substr($fecha,0,4);
	$diaSem = date("N", mktime(0, 0, 0, $mes , $dia , $ano));
	if ($paraDonde == 'tituloCitasXdia') {
		$fechaO = diaSemana($diaSem) . " " . $dia . " DE " . strtoupper(tituloMes($mes)) . " DE " . $ano;
	}
	if ($paraDonde == 'imprimirCita') {
		$fechaO = $dia . "-" . $mes . "-" . $ano;
	}
	if ($paraDonde == 'citasAreprogramar') {
		$fechaO = $dia . "-" . $mes . "-" . $ano;
	}
	return $fechaO;
}

function getDatosDerecho($id_derecho) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM derechohabientes WHERE id_derecho='" . $id_derecho . "'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
		$ret=array(
					'cedula' => $row_query['cedula'],
					'cedula_tipo' => $row_query['cedula_tipo'],
					'ap_p' => $row_query['ap_p'],
					'ap_m' => $row_query['ap_m'],
					'nombres' => $row_query['nombres'],
					'fecha_nacimiento' => $row_query['fecha_nacimiento'],
					'telefono' => $row_query['telefono'],
					'direccion' => $row_query['direccion'],
					'estado' => $row_query['estado'],
					'municipio' => $row_query['municipio'],
					'status' => $row_query['status']
				);
	} else {
		$ret=array(
					'cedula' => "-1",
					'cedula_tipo' => "-1",
					'ap_p' => "-1",
					'ap_m' => "-1",
					'nombres' => "-1",
					'fecha_nacimiento' => "-1",
					'telefono' => "-1",
					'direccion' => "-1",
					'estado' => "-1",
					'municipio' => "-1",
					'status' => "-1"
				);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function diferencia_horas($hora1,$hora2){
    $separar[1]=explode(':',$hora1);
    $separar[2]=explode(':',$hora2);
	$timestamp1 = mktime($separar[1][0], $separar[1][1], 0, 0, 0, 0);
	$timestamp2 = mktime($separar[2][0], $separar[2][1], 0, 0, 0, 0);
	$resta = $timestamp1 - $timestamp2;
	return number_format((($resta)/60)/60,1);
}

function getPisos() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM pisos ORDER BY nombre";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_piso' => $row_query['id_piso'],
						'nombre' => $row_query['nombre'],
						'tipo' => $row_query['tipo'],
						'extra' => $row_query['extra']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getPisoXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM pisos WHERE id_piso='" . $id . "'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_piso' => $row_query['id_piso'],
						'nombre' => $row_query['nombre'],
						'tipo' => $row_query['tipo'],
						'extra' => $row_query['extra']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getCamas() {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM camas WHERE tipo='1' ORDER BY descripcion";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	$ret = array();
	if ($totalRows_query>0){
		do{
			$ret[]=array(
						'id_cama' => $row_query['id_cama'],
						'id_piso' => $row_query['id_piso'],
						'nombre' => $row_query['descripcion'],
						'tipo' => $row_query['tipo'],
						'status' => $row_query['status'],
						'extra' => $row_query['extra']
					);
		}while($row_query = mysql_fetch_assoc($query));
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

function getCamaXid($id) {
	global $hostname_bdissste;
	global $username_bdissste;
	global $password_bdissste;
	global $database_bdissste;
	$bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_bdissste, $bdissste);
	$query_query = "SELECT * FROM camas WHERE id_cama='" . $id . "'";
	$query = mysql_query($query_query, $bdissste) or die(mysql_error());
	$row_query = mysql_fetch_assoc($query);
	$totalRows_query = mysql_num_rows($query);
	if ($totalRows_query>0){
			$ret=array(
						'id_cama' => $row_query['id_cama'],
						'id_piso' => $row_query['id_piso'],
						'nombre' => $row_query['descripcion'],
						'tipo' => $row_query['tipo'],
						'status' => $row_query['status'],
						'extra' => $row_query['extra']
					);
	}
	@mysql_free_result($query);
	@mysql_close($dbissste);
	return $ret;
}

?>