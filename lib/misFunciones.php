<?php require_once('Connections/bdissste.php'); ?>
<?php

@session_start();
date_default_timezone_set('America/Mexico_City');

$tipoPisos = array("URGENCIAS", "PISO", "OTRO");
$tipoCama = array("AISLADA", "CENSABLE", "CAMILLA");
$statusCama = array("DISPONIBLE", "OCUPADA");
$tipoLogs = array("ingreso al sistema", "agregar derechohabiente", "asignar paciente a cama", "borrar paciente de cama", "", "", "", "impresion de reporte", "salir del sistema");

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
    if ($mes[0] == "0")
        $mes = $mes[1];
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

function regresarIdMedico($idConsultorio, $idServicio) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
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

function formatoHora($hora) {
    return substr($hora, 0, 2) . ":" . substr($hora, 2, 2);
}

function quitarPuntosHora($hora) {
    return substr($hora, 0, 2) . substr($hora, 3, 2);
}

function getMedicosXServicioXConsultorio($idCon, $idSer) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $idMedico = regresarIdMedico($idConsultorio, $idServicio);
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT x.id_consultorio, x.id_servicio, x.id_medico, m.id_medico, m.titulo, m.nombres, m.ap_p, m.ap_m FROM servicios_x_consultorio x, medicos m WHERE x.id_consultorio='" . $idCon . "' AND x.id_servicio='" . $idSer . "' AND x.id_medico=m.id_medico AND m.st='1' ORDER BY m.ap_p ASC, m.ap_m ASC, m.nombres ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_medico' => $row_query['id_medico'],
                'titulo' => $row_query['titulo'],
                'ap_p' => $row_query['ap_p'],
                'ap_m' => $row_query['ap_m'],
                'nombres' => $row_query['nombres']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function opcionesMed($idCon, $idSer, $idMed) {
    $medicos = getMedicosXServicioXConsultorio($idCon, $idSer);
    $totalMedicos = count($medicos);
    $out = "";
    if ($totalMedicos > 0) {
        if ($idMed == "-1") { // que no se ha seleccionado ningun servicio, seleccionamos el primero de la base de datos 
            $seleccionado = false;
            for ($i = 0; $i < $totalMedicos; $i++) {
                if ($seleccionado == false) {
                    $out.= "<option selected value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
                    $seleccionado = true;
                    $_SESSION['idDr'] = $medicos[$i]['id_medico'];
                } else {
                    $out.= "<option value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
                }
            }
        } else { // seleccionamos de la base de datos el consultorio con idCon;
            for ($i = 0; $i < $totalMedicos; $i++) {
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

function getDH($where, $order) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM derechohabientes " . $where . " " . $order;
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
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
                'status' => $row_query['status']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function buscarDHxCedulaParaCita($cedula) {
    $dhs = getDH("WHERE cedula like '%" . $cedula . "%'", "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE CEDULA QUE CONTENGA " . strtoupper($cedula) . "</option>";
        $out2 = " <input name=\"agregarDH\" type=\"button\" value=\"Agregar Derechohabiente\" class=\"botones\" id=\"agregarDH\" onClick=\"javascript: agregarDHenCita();\" />";
    }
//	$out.= "<option value=\"fas\">" . $totalMedicos . "</option>";
    $out .= "</select>";
    return $out . $out2;
}

function buscarDHxNombreParaCita($ap_p, $ap_m, $nombre) {
    $temp = "";
    if (strlen($ap_p) > 0) {
        $temp .= "ap_p like '%" . $ap_p . "%'";
    }
    if (strlen($ap_m) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR ap_m like '%" . $ap_m . "%'";
        } else {
            $temp .= "ap_m like '%" . $ap_m . "%'";
        }
    }
    if (strlen($nombre) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR nombres like '%" . $nombre . "%'";
        } else {
            $temp .= "nombres like '%" . $nombre . "%'";
        }
    }
    $dhs = getDH("WHERE " . $temp, "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE PACIENTE CON DATOS PROPORCIONADOS</option>";
        $out2 = " <input name=\"agregarDH\" type=\"button\" value=\"Agregar Derechohabiente\" class=\"botones\" id=\"agregarDH\" onClick=\"javascript: agregarDHenCita();\" />";
    }
//	$out.= "<option value=\"fas\">" . $totalMedicos . "</option>";
    $out .= "</select>";
    return $out . $out2;
}

function buscarDHxCedulaParaBusqueda($cedula) {
    $dhs = getDH("WHERE cedula like '%" . $cedula . "%'", "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE CEDULA QUE CONTENGA " . strtoupper($cedula) . "</option>";
        $out2 = "";
    }
    $out .= "</select>";
    return $out . $out2;
}

function buscarDHxNombreParaBusqueda($ap_p, $ap_m, $nombre) {
    $temp = "";
    if (strlen($ap_p) > 0) {
        $temp .= "ap_p like '%" . $ap_p . "%'";
    }
    if (strlen($ap_m) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR ap_m like '%" . $ap_m . "%'";
        } else {
            $temp .= "ap_m like '%" . $ap_m . "%'";
        }
    }
    if (strlen($nombre) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR nombres like '%" . $nombre . "%'";
        } else {
            $temp .= "nombres like '%" . $nombre . "%'";
        }
    }
    $dhs = getDH("WHERE " . $temp, "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE PACIENTE CON DATOS PROPORCIONADOS</option>";
        $out2 = "";
    }
    $out .= "</select>";
    return $out . $out2;
}

function ejecutarSQL($query_query) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query = mysql_query($query_query, $bdissste); //or die(mysql_error());
    $error[0] = mysql_errno();
    $error[1] = mysql_error();
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $error;
}

function ejecutarSQLR($query_query) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query = mysql_query($query_query, $bdissste); //or die(mysql_error());
    $error[0] = mysql_errno();
    $error[1] = mysql_error();
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $error;
}

function ejecutarSQLF($query_query) {
    global $hostname_bdissste;
    global $username_bdisssteF;
    global $password_bdisssteF;
    global $database_bdisssteF;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteF, $password_bdisssteF) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteF, $bdissste);
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
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $totalRows_query = mysql_num_rows($query);
    if ($totalRows_query > 0) {
        $ret = true;
    } else {
        $ret = false;
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
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM usuarios WHERE id_usuario='" . $id . "' AND st='1' ORDER BY nombre";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    if ($totalRows_query > 0) {
        $ret = array(
            'id_usuario' => $row_query['id_usuario'],
            'login' => $row_query['login'],
            'pass' => $row_query['pass'],
            'nombre' => $row_query['nombre'],
            'tipo_usuario' => $row_query['tipo_usuario'],
//            'id_consultorio' => $row_query['id_consultorio'],
//            'id_servicio' => $row_query['id_servicio'],
            'status' => $row_query['status']
        );
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getServicioXid($id) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM servicios WHERE id_servicio='" . $id . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    if ($totalRows_query > 0) {
        $ret = $row_query['nombre'];
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function compararFechas($hoy, $otra) {
    $hoyMK = mktime(0, 0, 0, substr($hoy, 4, 2), substr($hoy, 6, 2), substr($hoy, 0, 4));
    $otraMK = mktime(0, 0, 0, substr($otra, 4, 2), substr($otra, 6, 2), substr($otra, 0, 4));
    if ($otraMK >= $hoyMK)
        return true; else
        return false;
}

function quitarAcentos($Text) {
    $cadena = "";
    $temp = "";
    $total = strlen($Text);
    for ($j = 0; $j < $total; $j++) {
        $cara = $Text[$j];
        if ($cara == "&") {
            $temp = substr($Text, $j, 8);
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
            switch ($cara) {
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
    $cadena = "";
    $temp = "";
    $total = strlen($Text);
    for ($j = 0; $j < $total; $j++) {
        $cara = $Text[$j];
        if ($cara == "(") {
            $temp = substr($Text, $j, 4);
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

function tipoDH($municipio) {
    $ret = "X";
    if (($municipio == "Guadalajara") || ($municipio == "Tlajomulco de Z(/u)(/n)iga") || ($municipio == "Tonal(/a)") || ($municipio == "Zapopan") || ($municipio == "Tlaquepaque"))
        $ret = "&nbsp;";
    return $ret;
}

function queSexoTipoCedula($tipoCedula) {
    $ret = "";
    if (($tipoCedula == "10") || ($tipoCedula == "40") || ($tipoCedula == "41") || ($tipoCedula == "50") || ($tipoCedula == "51") || ($tipoCedula == "70") || ($tipoCedula == "71") || ($tipoCedula == "90") || ($tipoCedula == "92"))
        $ret = "M"; else
        $ret = "F";
    return $ret;
}

// ---------------------------------------------------------------------------------------------  N U E V A S    F U N C I O N E S  -------------
function getDatosDerecho($id_derecho) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM derechohabientes WHERE id_derecho='" . $id_derecho . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    if ($totalRows_query > 0) {
        $ret = array(
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
        $ret = array(
            'cedula' => "-1",
            'cedula_tipo' => "-1",
            'ap_p' => "-1",
            'ap_m' => "-1",
            'nombres' => "-1",
            'telefono' => "-1",
            'fecha_nacimiento' => "-1",
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

function getMedicoXid($id) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM medicos WHERE id_medico='" . $id . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        $ret = array(
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

function formatoDia($fecha, $paraDonde) {
    $dia = substr($fecha, 6, 2);
    $mes = substr($fecha, 4, 2);
    $ano = substr($fecha, 0, 4);
    $diaSem = date("N", mktime(0, 0, 0, $mes, $dia, $ano));
    if ($paraDonde == 'tituloCitasXdia') {
        $fechaO = diaSemana($diaSem) . " " . $dia . " DE " . strtoupper(tituloMes($mes)) . " DE " . $ano;
    }
    if ($paraDonde == 'imprimirCita') {
        $fechaO = $dia . "-" . $mes . "-" . $ano;
    }
    if ($paraDonde == 'fecha') {
        $fechaO = $dia . "-" . $mes . "-" . $ano;
    }
    if ($paraDonde == 'fechaI') {
        $fechaO = $dia . "/" . $mes . "/" . $ano;
    }
    return $fechaO;
}

function getServicios() {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT* FROM servicios ORDER BY nombre";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_servicio' => $row_query['id_servicio'],
                'clave' => $row_query['clave'],
                'nombre' => $row_query['nombre']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getMedicos() {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT* FROM medicos ORDER BY ap_p ASC, ap_m ASC, nombres ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_medico' => $row_query['id_medico'],
                'titulo' => $row_query['titulo'],
                'ap_p' => $row_query['ap_p'],
                'ap_m' => $row_query['ap_m'],
                'nombres' => $row_query['nombres']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getPisos() {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pisos ORDER BY nombre DESC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_piso' => $row_query['id_piso'],
                'nombre' => $row_query['nombre'],
                'tipo' => $row_query['tipo'],
                'extra' => $row_query['extra']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getPiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pisos WHERE id_piso='" . $id_piso . "'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = "";
    if ($totalRows_query > 0) {
        $ret = array(
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

function getNcamillasXpiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='" . $id_piso . "' AND tipo!='1'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $ret = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getNcamasXpiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='" . $id_piso . "' AND tipo='1'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $ret = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getNcamasOcupadasXpiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='" . $id_piso . "' AND status='1' AND tipo='1'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $ret = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getCamasXpiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='" . $id_piso . "' ORDER BY tipo ASC, descripcion ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_cama' => $row_query['id_cama'],
                'id_piso' => $row_query['id_piso'],
                'descripcion' => $row_query['descripcion'],
                'tipo' => $row_query['tipo'],
                'status' => $row_query['status'],
                'extra' => $row_query['extra']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getCamasVaciasXpiso($id_piso) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='" . $id_piso . "' AND status='0' ORDER BY tipo ASC, descripcion ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_cama' => $row_query['id_cama'],
                'id_piso' => $row_query['id_piso'],
                'descripcion' => $row_query['descripcion'],
                'tipo' => $row_query['tipo'],
                'status' => $row_query['status'],
                'extra' => $row_query['extra']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getCamillasVacias() {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_piso='1' AND tipo='2' AND status='0' ORDER BY descripcion ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_cama' => $row_query['id_cama'],
                'id_piso' => $row_query['id_piso'],
                'descripcion' => $row_query['descripcion'],
                'tipo' => $row_query['tipo'],
                'status' => $row_query['status'],
                'extra' => $row_query['extra']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getDatosCama($id_cama) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM camas WHERE id_cama='" . $id_cama . "' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    $ret = "";
    if ($totalRows_query > 0) {
        $ret = array(
            'id_cama' => $row_query['id_cama'],
            'id_piso' => $row_query['id_piso'],
            'descripcion' => $row_query['descripcion'],
            'tipo' => $row_query['tipo'],
            'status' => $row_query['status'],
            'extra' => $row_query['extra']
        );
    }
    return $ret;
}

function getDatosPacienteEnCama($id_cama) {
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
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
        $ret = array(
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
            'servicio_nombre' => $datosServicio
        );
    }
    return $ret;
}

function diferenciaFechas($hoy, $ingreso) {
    $hoyMK = mktime(0, 0, 0, substr($hoy, 4, 2), substr($hoy, 6, 2), substr($hoy, 0, 4));
    $ingresoMK = mktime(0, 0, 0, substr($ingreso, 4, 2), substr($ingreso, 6, 2), substr($ingreso, 0, 4));
    $segundos_diferencia = $hoyMK - $ingresoMK;
    $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
    $dias_diferencia = abs($dias_diferencia);
    $dias_diferencia = floor($dias_diferencia);
    return $dias_diferencia;
}

function diferenciaHoras($hoy, $ingreso, $hHoy, $hIngreso) {
    $hoyMK = mktime(substr($hHoy, 0, 2), substr($hHoy, 2, 2), 0, substr($hoy, 4, 2), substr($hoy, 6, 2), substr($hoy, 0, 4));
    $ingresoMK = mktime(substr($hIngreso, 0, 2), substr($hIngreso, 2, 2), 0, substr($ingreso, 4, 2), substr($ingreso, 6, 2), substr($ingreso, 0, 4));
    $segundos_diferencia = $hoyMK - $ingresoMK;
    $horas_diferencia = $segundos_diferencia / (60 * 60);
    $horas_diferencia = abs($horas_diferencia);
    $horas_diferencia = floor($horas_diferencia);
    return $horas_diferencia;
}

function getDiasEstancia($fecha_ing, $hora_ing, $id_piso) {
    if ($id_piso == "1") {
        $hoy = date("Ymd");
        $horaHoy = date("Hi");
        $horas = diferenciaHoras($hoy, $fecha_ing, $horaHoy, $hora_ing);
        $ret = "";
//		echo $horas;
        if ($horas <= 12) {
            $ret = "<b>HORAS</b><br><span class=\"horaVerde\">" . $horas . "</span>";
        } else if ($horas > 12 && $horas <= 24) {
            $ret = "<b>HORAS</b><br><span class=\"horaAmarrillo\">" . $horas . "</span>";
        } else if ($horas > 24 && $horas <= 48) {
            $ret = "<b>HORAS</b><br><span class=\"horaNaranja\">" . $horas . "</span>";
        } else if ($horas > 48) {
            $ret = "<b>HORAS</b><br><span class=\"horaRojo\">" . $horas . "</span>";
        }
    } else {
        
            $hoy = date("Ymd");
            $dias = diferenciaFechas($hoy, $fecha_ing);
        $ret = "";
        if ($dias > 5)
            $ret = "<b>DIAS</b><br><span class=\"horaRojo\">" . $dias . "</span>";
        else
            $ret = "<b>DIAS</b><br>" . $dias;
    }
    return $ret;
}
function getDiasEstancia1($fecha_ing, $hora_ing, $id_piso, $fechaEgreso,$horaEgreso) {
    if ($id_piso == "1") {
        if($fechaEgreso=="" && $horaEgreso==""){
        $hoy = date("Ymd");
        $horaHoy = date("Hi");
        $horas = diferenciaHoras($hoy, $fecha_ing, $horaHoy, $hora_ing);
        }
        else
            $horas = diferenciaHoras($fechaEgreso, $fecha_ing, $horaEgreso, $hora_ing);
        $ret = "";
//		echo $horas;
        if ($horas <= 12) {
            $ret = "<b>HORAS</b><br><span class=\"horaVerde\">" . $horas . "</span>";
        } else if ($horas > 12 && $horas <= 24) {
            $ret = "<b>HORAS</b><br><span class=\"horaAmarrillo\">" . $horas . "</span>";
        } else if ($horas > 24 && $horas <= 48) {
            $ret = "<b>HORAS</b><br><span class=\"horaNaranja\">" . $horas . "</span>";
        } else if ($horas > 48) {
            $ret = "<b>HORAS</b><br><span class=\"horaRojo\">" . $horas . "</span>";
        }
    } else {
        if ($fechaEgreso == "") {
            $hoy = date("Ymd");
            $dias = diferenciaFechas($hoy, $fecha_ing);
        }
        else
            $dias = diferenciaFechas($fechaEgreso, $fecha_ing);
        $ret = "";
        if ($dias > 5)
            $ret = "<b>DIAS</b><br><span class=\"horaRojo\">" . $dias . "</span>";
        else
            $ret = "<b>DIAS</b><br>" . $dias;
    }
    return $ret;
}

function listaServicios() {
    $servicios = getServicios();
    $totalServicios = count($servicios);
    $out = "";
    $out.= "<option selected value=\"0\"> </option>";
    if ($totalServicios > 0) {
        for ($i = 0; $i < $totalServicios; $i++) {
            $out.= "<option value=\"" . $servicios[$i]['id_servicio'] . "\">" . ponerAcentos($servicios[$i]['nombre']) . "</option>";
        }
    }
    return $out;
}

function listaMedicos() {
    $medicos = getMedicos();
    $totalMedicos = count($medicos);
    $out = "";
    $out.= "<option selected value=\"0\"> </option>";
    if ($totalMedicos > 0) {
        for ($i = 0; $i < $totalMedicos; $i++) {
            $out.= "<option value=\"" . $medicos[$i]['id_medico'] . "\">" . ponerAcentos($medicos[$i]['ap_p'] . " " . $medicos[$i]['ap_m'] . " " . $medicos[$i]['nombres']) . "</option>";
        }
    }
    return $out;
}

function listaMedicamentos() {
    $medicamentos = getMedicamentos();
    $totalMedicamentos = count($medicamentos);
    $out = "";
    $out.= "<option selected value=\"0\"> </option>";
    if ($totalMedicamentos > 0) {
        for ($i = 0; $i < $totalMedicamentos; $i++) {
            $out.= "<option value=\"" . $medicamentos[$i]['id_medicamento'] . "\">" . ponerAcentos($medicamentos[$i]['descripcion']) . "</option>";
        }
    }
    return $out;
}

function formatoFechaBD($fecha) {
    $dia = substr($fecha, 0, 2);
    $mes = substr($fecha, 3, 2);
    $ano = substr($fecha, 6, 4);
    $fechaO = $ano . $mes . $dia;
    return $fechaO;
}

function getMedicosXServicio($idSer) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
//	$idMedico =  regresarIdMedico($idConsultorio,$idServicio);
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT x.id_consultorio, x.id_servicio, x.id_medico, m.id_medico, m.titulo, m.nombres, m.ap_p, m.ap_m FROM servicios_x_consultorio x, medicos m WHERE x.id_servicio='" . $idSer . "' AND x.id_medico=m.id_medico AND m.st='1' ORDER BY m.ap_p ASC, m.ap_m ASC, m.nombres ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $ret[] = array(
                'id_medico' => $row_query['id_medico'],
                'titulo' => $row_query['titulo'],
                'ap_p' => $row_query['ap_p'],
                'ap_m' => $row_query['ap_m'],
                'nombres' => $row_query['nombres']
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function comprobarPassword($pass) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM usuarios WHERE pass='" . $pass . "' AND st='1' AND tipo_usuario='0' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $totalRows_query;
}

function getDatosHistorialPacienteEnCama($id_cama) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_historial WHERE id_cama='" . $id_cama . "' ORDER BY fecha_ingreso ASC, hora_ingreso ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $datosPaciente = getDatosDerecho($row_query['id_derecho']);
            $datosMedico = getMedicoXid($row_query['id_medico']);
            $datosServicio = getServicioXid($row_query['id_servicio']);
            $ret[] = array(
                'id_cama' => $row_query['id_cama'],
                'id_derecho' => $row_query['id_derecho'],
                'id_medico' => $row_query['id_medico'],
                'id_servicio' => $row_query['id_servicio'],
                'fecha_ingreso' => $row_query['fecha_ingreso'],
                'hora_ingreso' => $row_query['hora_ingreso'],
                'fecha_egreso' => $row_query['fecha_egreso'],
                'hora_egreso' => $row_query['hora_egreso'],
                'procedencia' => $row_query['procedencia'],
                'observaciones_ingreso' => $row_query['observaciones_ingreso'],
                'observaciones_egreso' => $row_query['observaciones_egreso'],
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
                'servicio_nombre' => $datosServicio
            );
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function getDatosPacienteXbusqueda($id_derecho) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_en_piso WHERE id_derecho='" . $id_derecho . "' LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    $ret = "";
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
        $ret = array(
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
            'servicio_nombre' => $datosServicio
        );
    }
    return $ret;
}

function getDatosHistorialPacienteXid($id_derecho) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_historial WHERE id_derecho='" . $id_derecho . "' ORDER BY fecha_ingreso ASC, hora_ingreso ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = array();
    if ($totalRows_query > 0) {
        do {
            $datosPaciente = getDatosDerecho($row_query['id_derecho']);
            $datosMedico = getMedicoXid($row_query['id_medico']);
            $datosServicio = getServicioXid($row_query['id_servicio']);
            $ret[] = array_merge($row_query, $datosPaciente, $datosMedico, (array)getServicioXid($row_query['id_servicio']));
            /* $ret[]=array(
              'id_cama' => $row_query['id_cama'],
              'id_derecho' => $row_query['id_derecho'],
              'id_medico' => $row_query['id_medico'],
              'id_servicio' => $row_query['id_servicio'],
              'fecha_ingreso' => $row_query['fecha_ingreso'],
              'hora_ingreso' => $row_query['hora_ingreso'],
              'fecha_egreso' => $row_query['fecha_egreso'],
              'hora_egreso' => $row_query['hora_egreso'],
              'procedencia' => $row_query['procedencia'],
              'observaciones_ingreso' => $row_query['observaciones_ingreso'],
              'observaciones_egreso' => $row_query['observaciones_egreso'],
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
              'servicio_nombre' => $datosServicio
              ); */
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

// funciones 2014
function extrasDH($id_derecho, $grupo_sanguineo, $alergias, $contacto, $contacto_tel, $foto, $id_usuario, $extraA, $extraB, $extraC, $extraD, $extraE, $extraF, $extraG, $extraH) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM derechohabientes_extras WHERE id_derecho='" . $id_derecho . "' LIMIT 1;";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
	if (mysql_num_rows($query) == 1) { // ya existe registro
		$query_query2 = "UPDATE derechohabientes_extras SET g_sangre='" . $grupo_sanguineo . "', alergias_med='" . $alergias . "', contacto='" . $contacto . "', contacto_tel='" . $contacto_tel . "', foto='" . $foto . "', id_usuario='" . $id_usuario . "', extraA='" . $extraA . "', extraB='" . $extraB . "', extraC='" . $extraC . "', extraD='" . $extraD . "', extraE='" . $extraE . "', extraF='" . $extraF . "', extraG='" . $extraG . "', extraH='" . $extraH . "' WHERE id_derecho='" . $id_derecho . "' LIMIT 1;";
		$query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
	} else {
		$query_query2 = "INSERT INTO derechohabientes_extras VALUES('" . $id_derecho . "', '" . $grupo_sanguineo . "', '" . $alergias . "', '" . $contacto . "', '" . $contacto_tel . "', '" . $foto . "', '" . $extraA . "', '" . $extraB . "', '" . $extraC . "', '" . $extraD . "', '" . $extraE . "', '" . $extraF . "', '" . $extraG . "', '" . $extraH . "', '" . $id_usuario . "');";
		$query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
	}
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return '';
}

function getExtrasDH($id_derecho) {
    global $hostname_bdissste;
    global $username_bdisssteR;
    global $password_bdisssteR;
    global $database_bdisssteR;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteR, $password_bdisssteR) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteR, $bdissste);
    $query_query = "SELECT * FROM derechohabientes_extras WHERE id_derecho='" . $id_derecho . "' LIMIT 1;";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
	$ret = array(
		'id_derecho' => '',
		'g_sangre' => '',
		'alergias_med' => '',
		'contacto' => '',
		'contacto_tel' => '',
		'foto' => '',
		'id_usuario' => '',
		'extraA' => '',
		'extraB' => '',
		'extraC' => '',
		'extraD' => '',
		'extraE' => '',
		'extraF' => '',
		'extraG' => '',
		'extraH' => ''
	);
    if ($totalRows_query > 0) {
            $ret = array(
                'id_derecho' => $row_query['id_derecho'],
                'g_sangre' => $row_query['g_sangre'],
                'alergias_med' => $row_query['alergias_med'],
                'contacto' => $row_query['contacto'],
                'contacto_tel' => $row_query['contacto_tel'],
                'foto' => $row_query['foto'],
                'id_usuario' => $row_query['id_usuario'],
                'extraA' => $row_query['extraA'],
                'extraB' => $row_query['extraB'],
                'extraC' => $row_query['extraC'],
                'extraD' => $row_query['extraD'],
                'extraE' => $row_query['extraE'],
                'extraF' => $row_query['extraF'],
                'extraG' => $row_query['extraG'],
                'extraH' => $row_query['extraH']
            );
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;
}

function buscarDHxCedulaParaCita2014($cedula) {
    $dhs = getDH("WHERE cedula like '%" . $cedula . "%'", "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
		    $dhsExtras = getExtrasDH($dhs[$i]['id_derecho']);
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "|" . $dhsExtras['g_sangre'] . "|" . $dhsExtras['alergias_med'] . "|" . $dhsExtras['contacto'] . "|" . $dhsExtras['contacto_tel'] . "|" . $dhsExtras['foto'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE CEDULA QUE CONTENGA " . strtoupper($cedula) . "</option>";
        $out2 = " <input name=\"agregarDH\" type=\"button\" value=\"Agregar Derechohabiente\" class=\"botones\" id=\"agregarDH\" onClick=\"javascript: agregarDHenCita();\" />";
    }
//	$out.= "<option value=\"fas\">" . $totalMedicos . "</option>";
    $out .= "</select>";
    return $out . $out2;
}

function buscarDHxNombreParaCita2014($ap_p, $ap_m, $nombre) {
    $temp = "";
    if (strlen($ap_p) > 0) {
        $temp .= "ap_p like '%" . $ap_p . "%'";
    }
    if (strlen($ap_m) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR ap_m like '%" . $ap_m . "%'";
        } else {
            $temp .= "ap_m like '%" . $ap_m . "%'";
        }
    }
    if (strlen($nombre) > 0) {
        if (strlen($temp) > 0) {
            $temp .= " OR nombres like '%" . $nombre . "%'";
        } else {
            $temp .= "nombres like '%" . $nombre . "%'";
        }
    }
    $dhs = getDH("WHERE " . $temp, "ORDER BY cedula_tipo");
    $totaldhs = count($dhs);
    $out = "<select name=\"dh\" id=\"dh\">";
    $out2 = "";
    if ($totaldhs > 0) {
        for ($i = 0; $i < $totaldhs; $i++) {
		    $dhsExtras = getExtrasDH($dhs[$i]['id_derecho']);
            $out.= "<option value=\"" . $dhs[$i]['id_derecho'] . "|" . $dhs[$i]['cedula'] . "|" . $dhs[$i]['cedula_tipo'] . "|" . ponerAcentos($dhs[$i]['ap_p']) . "|" . ponerAcentos($dhs[$i]['ap_m']) . "|" . ponerAcentos($dhs[$i]['nombres']) . "|" . ponerAcentos($dhs[$i]['telefono']) . "|" . ponerAcentos($dhs[$i]['direccion']) . "|" . $dhs[$i]['estado'] . "|" . $dhs[$i]['municipio'] . "|" . $dhs[$i]['fecha_nacimiento'] . "|" . $dhsExtras['g_sangre'] . "|" . $dhsExtras['alergias_med'] . "|" . $dhsExtras['contacto'] . "|" . $dhsExtras['contacto_tel'] . "|" . $dhsExtras['foto'] . "\">" . $dhs[$i]['cedula'] . "/" . $dhs[$i]['cedula_tipo'] . " " . ponerAcentos($dhs[$i]['ap_p']) . " " . ponerAcentos($dhs[$i]['ap_m']) . " " . ponerAcentos($dhs[$i]['nombres']) . "</option>";
        }
    } else {
        $out .= "<option value=\"-1\">NO EXISTE PACIENTE CON DATOS PROPORCIONADOS</option>";
        $out2 = " <input name=\"agregarDH\" type=\"button\" value=\"Agregar Derechohabiente\" class=\"botones\" id=\"agregarDH\" onClick=\"javascript: agregarDHenCita();\" />";
    }
//	$out.= "<option value=\"fas\">" . $totalMedicos . "</option>";
    $out .= "</select>";
    return $out . $out2;
}

function getDatosPacienteEnCama2014($id_cama) {
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
    if ($totalRows_query > 0) {
        $datosPaciente = getDatosDerecho($row_query['id_derecho']);
        $datosMedico = getMedicoXid($row_query['id_medico']);
        $datosServicio = getServicioXid($row_query['id_servicio']);
        $ret = array(
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
            'fecha_nacimiento' => $datosPaciente['fecha_nacimiento'],
            'medico_cedula' => $datosMedico['cedula'],
            'medico_cedula_tipo' => $datosMedico['cedula_tipo'],
            'medico_titulo' => $datosMedico['titulo'],
            'medico_ap_p' => $datosMedico['ap_p'],
            'medico_ap_m' => $datosMedico['ap_m'],
            'medico_nombres' => $datosMedico['nombres'],
            'servicio_nombre' => $datosServicio,
			  'dh_extras' => getExtrasDH($row_query['id_derecho'])
        );
    }
    return $ret;
}

function calculaedad($fechanacimiento){
    list($dia,$mes,$ano) = explode("/",$fechanacimiento);
    return $fechanacimiento;
}

function calculaedad2($fechanacimiento){
    list($dia,$mes,$ano) = explode("/",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}
function getPrealta($id_movimiento) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM pacientes_prealtas WHERE id_movimiento='" . $id_movimiento . "' AND status='1' ORDER BY fecha DESC, hora DESC LIMIT 1";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $row_query;

}

function getEstiloPrealta($prealta, $hoy, $horaHoy) {
    $fecha_ing = $prealta["fecha"];
    $hora_ing = $prealta["hora"];
    $horas = diferenciaHoras($hoy, $fecha_ing, $horaHoy, $hora_ing);
    $ret = " style=\"color: #DC534C;\"";
    if ($horas <= 24) {
        $ret = " style=\"color: #F3AE45;\"";
    }
    if ($horas <= 12) {
        $ret = " style=\"color: #58B958;\"";
    }
    return $ret;
}


?>