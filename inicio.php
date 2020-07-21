<?php
include_once('lib/misFunciones.php');
@session_start ();

$pisos = getPisos();
$Npisos = count($pisos);
$temp = "<table width=\"100%\" cellspaccing=\"0\" cellpadding=\"0\">";

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

function getClaseBoton($id_cama, $id_derecho, $fecha) {
    global $hostname_bdissste;
    global $username_bdissste;
    global $password_bdissste;
    global $database_bdissste;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdissste, $password_bdissste) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdissste, $bdissste);
    $query_query = "SELECT * FROM ordenes WHERE id_cama='" . $id_cama . "' AND id_derecho='" . $id_derecho . "' AND fecha='" . $fecha . "' AND status='1'";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = '';
    if ($totalRows_query > 0) {
		$query_query2 = "SELECT * FROM ordenes_conceptos WHERE id_orden='" . $row_query['id_orden'] . "'";
		$query2 = mysql_query($query_query2, $bdissste) or die(mysql_error());
		$row_query2 = mysql_fetch_assoc($query2);
		$totalRows_query2 = mysql_num_rows($query2);
		$contador = 0;
        if ($totalRows_query2 > 0) {
            do {
                if ($row_query2["valores"] != '') $contador++;
            } while ($row_query2 = mysql_fetch_assoc($query2));
        }
        if ($contador == $totalRows_query2) $ret = 'success';
        if ($contador < $totalRows_query2) $ret = 'warning';
        if ($contador == 0) $ret = 'danger';
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;

}

for($i=0; $i<$Npisos; $i++) {
	if ($_SESSION['tipoUsuario'] == '8') { // enfermera
		if ($_SESSION["idPiso"] == $pisos[$i]["id_piso"]) {
			$tipoUsuario = $_SESSION['tipoUsuario'];
			$piso = getPiso($pisos[$i]["id_piso"]);
			$camas = getCamasXpiso($pisos[$i]["id_piso"]);

			$NCamas = count($camas);

			$temp = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";

			$dia = date("Ymd");
			$horaHoy = date("Hi");

			for($i=0; $i<$NCamas; $i++) {
				$botonesExtras = '';
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
					if ($tipoUsuario == "5") { // es usuario médico
						$boton .= "onclick=\"javascript: bajaPaciente('" . $camas[$i]['id_cama'] . "');\"";
					}
					if ($tipoUsuario == "8") { // es usuario enfermera
						$boton .= "onclick=\"javascript: bajaPaciente('" . $camas[$i]['id_cama'] . "');\"";
					}
					$datos = getDatosPacienteEnCama2014_2($camas[$i]['id_cama']);
					$historial = getHistorial($datos['id_movimiento']);
					$prealta = getPrealta($datos['id_movimiento']);
					$estiloPrealta = '';
					if(is_array($prealta)) {
						$estiloPrealta = getEstiloPrealta($prealta, $dia, $horaHoy);
					}

					//$botonesExtras .= '<a href="javascript: marcarPrealta(' . $camas[$i]['id_cama'] . ',' . $_SESSION["idPiso"] . ');" class="btn btn-m btn-primary">Prealta</a>';
					$claseBoton = getClaseBoton($camas[$i]['id_cama'], $datos['id_derecho'], $dia);
					switch ($_SESSION["tipoUsuario"]) {
					  case '5': //MEDICO
					    $botonesExtras = '<p align="center"><a class="btn btn-l btn-primary" href="javascript: getOrdenesMedicas_2017(' . $camas[$i]['id_cama'] . ',' . $datos['id_derecho'] . ',' . $dia . ');">Historial de Ordenes Médicas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-l btn-success" href="javascript: crearOrdenMedica_2017(' . $camas[$i]['id_cama'] . ',' . $datos['id_derecho'] . ',' . $dia . ');">Ingresar Orden Médica</a></p>';
					    break;
					  case '8': //ENFERMERA
					  	if ($claseBoton != '') $botonesExtras = '<a class="btn btn-l btn-' . $claseBoton . '" href="javascript: llenarOrdenMedica_2017(' . $camas[$i]['id_cama'] . ',' . $datos['id_derecho'] . ',' . $dia . ');">Orden Médica</a> &nbsp;&nbsp;&nbsp;';
					    break;
					}

					$infoPaciente = "<td valign=\"middle\" class=\"nombrePaciente\" width=\"450\">" . $botonesExtras . ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) . "<br>" . ponerAcentos($datos['servicio_nombre'] . " - " . $datos['medico_titulo'] . " " . $datos['medico_ap_p'] . " " . $datos['medico_ap_m'] . " " . $datos['medico_nombres']) . "</td><td valign=\"middle\" class=\"nombrePaciente\" width=\"90\"><b>INGRESO</b><br>" . formatoDia($datos['fecha_ingreso'],"fecha") . "<br>" . formatoHora($datos['hora_ingreso']) . " HRS.</td><td valign=\"middle\" class=\"nombrePaciente\" width=\"50\" align=\"center\">" . getDiasEstancia($datos['fecha_ingreso'], $datos['hora_ingreso'], $_SESSION["idPiso"]) . "</td><td align=\"center\"><img src=\"diseno/__camaBaja.png\"width=\"42\"></td>";
					
					$temp .= "<tr onmouseover=\"this.className='colorDiv1'; mostrarDiv('obs" . $i . "');\" onmouseout=\"this.className='colorDiv2'; ocultarDiv('obs" . $i . "');\" " . $boton . "><td class=\"cama\" width=\"80\"" . $estiloPrealta . ">" . $camas[$i]['descripcion'] . "<div id=\"obs" . $i . "\" style=\"position:absolute; margin-left:300px; margin-top:-40px; display:none;\">
					<table width=\"400\" class=\"ventanaConFondo\">
						<tr>
						  <td class=\"tituloVentana\" height=\"23\">OBSERVACIONES</td>
						</tr>
						<tr>
							<td class=\"nombrePaciente\"><small>DIAGNOSTICO: " . ponerAcentos($datos['observaciones']) . "<br />" . $historial . "
							</td>
						</tr>
					</table>
					</div></td>" . $infoPaciente . "
					</td>
					</tr>";
				} else if ($camas[$i]['status'] == "0") {
					if(($tipoUsuario == "2") && ($_GET['id_piso'] == "1")) {
						$boton .= "onclick=\"javascript: altaPaciente('" . $camas[$i]['id_cama'] . "');\"";
					}
					if(($tipoUsuario == "1") && ($_GET['id_piso'] != "1")) {
						$boton .= "onclick=\"javascript: altaPaciente('" . $camas[$i]['id_cama'] . "');\"";
					}
					if(($tipoUsuario == "9")) {
						$boton .= "onclick=\"javascript: altaPaciente('" . $camas[$i]['id_cama'] . "');\"";
					}
					if ($tipoUsuario == "5") { // es usuario médico, no puede asignar camas
						$boton .= "";
					}
					$infoPaciente = "<td valign=\"middle\" class=\"camaDisponible\" colspan=\"3\" width=\"590\">DISPONIBLE</td><td align=\"center\"><img src=\"diseno/__camaAlta.png\"width=\"42\"></td>";
					$temp .= "<tr onmouseover=\"this.className='colorDiv1'\" onmouseout=\"this.className='colorDiv2'\" " . $boton . "><td class=\"cama\" width=\"80\">" . $camas[$i]['descripcion'] . "</td>" . $infoPaciente . "
					</td>
					</tr>";
				}
			}
			$temp .= "</table>";
			$out= "<p align='center'><span class='label label-danger' style=\"padding: 10px 7px; font-weight: normal; font-size: 9px;\">ORDEN SIN ANTENDER / PREALTA > 24HRS.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='label label-warning' style=\"padding: 10px 7px; font-weight: normal; font-size: 9px;\">ORDEN PARCIALMENTE ATENDIDA / PREALTA 12 a 24HRS.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='label label-success' style=\"padding: 10px 7px; font-weight: normal; font-size: 9px;\">ORDEN COMPLETADA / PREALTA < 12HRS.</span><br><br>
</p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"780\"><tr><td align=\"center\">" ;
			$out.= "<table width=\"750\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"ventana\">
			        <tr>
			          <td class=\"tituloVentana\" height=\"23\">" . $piso['nombre'] . " - OCUPACION</td>
			        </tr>
			        <tr>
			          <td align=\"left\">" . $temp . "
					  </td>
			        </tr>
			      </table><br><input type=\"button\" name=\"regresar\" id=\"regresar\" value=\"Regresar\" class=\"botones\"  onclick=\"javascript: inicio('inicio.php');\" /><br><br>
				  </td></tr></table>";
			print($out);

/*

			$totalCamas = getNcamasXpiso($pisos[$i]['id_piso']);
			$totalCamillas = getNcamillasXpiso($pisos[$i]['id_piso']);
			$camillas = "";
			if($totalCamillas > 0) $camillas = $totalCamillas . " C y/o S";
			$totalCamasOcupadas = getNcamasOcupadasXpiso($pisos[$i]['id_piso']);
			$porcentaje = ($totalCamasOcupadas*100)/$totalCamas;
			$temp .= "<tr><td onmouseover=\"this.className='colorDiv1'\" onmouseout=\"this.className='colorDiv2'\" onclick=\"javascript: infoPiso('" . $pisos[$i]['id_piso'] . "');\">
			<dl class='dl'>
		    <dt class='dt'>" . $pisos[$i]['nombre'] . "</dt>
		    <dd class='dd'>
		        <div style=\"width:" . round($porcentaje) . "%;\"><table width=\"100%\" height=\"100%\"><tr><td><b>" . round($porcentaje) . "%</b></td></tr></table><strong>&nbsp;</strong></div>
		    </dd>
			</dl><div class=\"estadisticas\" style=\"position: relative; top:10px;\">&nbsp;&nbsp;&nbsp;" . $totalCamasOcupadas . " de " . $totalCamas . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $camillas . "</div>
			</td>
			</tr>";
*/			
		}
	} else { // cualquier usuario
		$totalCamas = getNcamasXpiso($pisos[$i]['id_piso']);
		$totalCamillas = getNcamillasXpiso($pisos[$i]['id_piso']);
		$camillas = "";
		if($totalCamillas > 0) $camillas = $totalCamillas . " C y/o S";
		$totalCamasOcupadas = getNcamasOcupadasXpiso($pisos[$i]['id_piso']);
		$porcentaje = ($totalCamasOcupadas*100)/$totalCamas;
		$temp .= "<tr><td onmouseover=\"this.className='colorDiv1'\" onmouseout=\"this.className='colorDiv2'\" onclick=\"javascript: infoPiso('" . $pisos[$i]['id_piso'] . "');\">
		<dl class='dl'>
	    <dt class='dt'>" . $pisos[$i]['nombre'] . "</dt>
	    <dd class='dd'>
	        <div style=\"width:" . round($porcentaje) . "%;\"><table width=\"100%\" height=\"100%\"><tr><td><b>" . round($porcentaje) . "%</b></td></tr></table><strong>&nbsp;</strong></div>
	    </dd>
		</dl><div class=\"estadisticas\" style=\"position: relative; top:10px;\">&nbsp;&nbsp;&nbsp;" . $totalCamasOcupadas . " de " . $totalCamas . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $camillas . "</div>
		</td>
		</tr>";
	}
}
$temp .= "</table>";

if ($_SESSION['tipoUsuario'] != '8') {
	$out = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"780\"><tr><td align=\"center\">" ;
	$out.= "<table width=\"550\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"ventana\">
	        <tr>
	          <td class=\"tituloVentana\" height=\"23\">OCUPACION HOSPITALARIA</td>
	        </tr>
	        <tr>
	          <td align=\"left\">" . $temp . "
			  </td>
	        </tr>
	      </table>
		  </td></tr></table>";
	print($out);
}
?>