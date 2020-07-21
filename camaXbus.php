<?php 
error_reporting(NULL);
include_once('lib/misFunciones.php');

	$datos = getDatosPacienteXbusqueda($_GET['id_derecho']);
	$out = "";
	$out.= "<br><table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
		<tr>
			<th colspan=\"13\" class=\"tituloVentana\">
				Actualmente en:
			</th>
		</tr>";
	if ($datos != "") {
		$camas = getDatosCama($datos['id_cama']);
                $boton = "onclick=\"javascript: bajaPaciente('" . $camas['id_cama'] . "');\"";
		$infoPaciente = "<td valign=\"middle\" class=\"nombrePaciente\" width=\"450\">" . ponerAcentos($datos['ap_p'] . " " . $datos['ap_m'] . " " . $datos['nombres']) . "<br>" . ponerAcentos($datos['servicio_nombre'] . " - " . $datos['medico_titulo'] . " " . $datos['medico_ap_p'] . " " . $datos['medico_ap_m'] . " " . $datos['medico_nombres']) . "</td><td valign=\"middle\" class=\"nombrePaciente\" width=\"90\"><b>INGRESO</b><br>" . formatoDia($datos['fecha_ingreso'],"fecha") . "<br>" . formatoHora($datos['hora_ingreso']) . " HRS.</td><td valign=\"middle\" class=\"nombrePaciente\" width=\"50\" align=\"center\">" . getDiasEstancia($datos['fecha_ingreso'], $datos['hora_ingreso'], $camas['id_piso']) . "</td>";
		
		$out .= "<tr onmouseover=\"this.className='colorDiv1'; mostrarDiv('obs0');\" onmouseout=\"this.className='colorDiv2'; ocultarDiv('obs0');\" " . $boton . "><td class=\"cama\" width=\"80\">" . $camas['descripcion'] . "<div id=\"obs0\" style=\"position:absolute; margin-left:300px; margin-top:-40px; display:none;\">
		<table width=\"400\" class=\"ventanaConFondo\">
			<tr>
			  <td class=\"tituloVentana\" height=\"23\">OBSERVACIONES</td>
			</tr>
			<tr>
				<td class=\"nombrePaciente\">" . ponerAcentos($datos['observaciones']) . "
				</td>
			</tr>
		</table>
		</div></td>" . $infoPaciente . "
		</td>
		</tr>";
	
	} else {
	$out .= "
				<tr>
					<td align=\"center\">
						No existe derechohabiente hospitalizado con la cedula introducida
					</td>
				  </tr>	";
	}

	$out.= "</table>";
	
	$temp = "";
	$historial = getDatosHistorialPacienteXid($_GET['id_derecho']);	
	$nHistorial = count($historial);
	for($i=0; $i<$nHistorial; $i++) {
		$cama = getDatosCama($historial[$i]['id_cama']);
                if(count($cama)>0)
		$piso = getPiso($cama['id_piso']);
		$paciente = getDatosDerecho($historial[$i]['id_derecho']);
                $nombre=$paciente['ap_p']." ".$paciente['ap_m']." ".$paciente['nombres'];
		$nombreM = $historial[$i]['ap_p'] . " " . $historial[$i]['ap_m'] . " " . $historial[$i]['nombres'];
		$nDias = getDiasEstancia1($historial[$i]['fecha_ingreso'], $historial[$i]['hora_ingreso'], $cama['id_piso'],$historial[$i]['fecha_egreso'],$historial[$i]['hora_egreso']); 
		$temp .= "<tr height=\"30\">
			<td align=\"left\" class=\"nombrePaciente\">" . $piso['nombre'] . "<br>" . $cama['descripcion'] . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . $paciente['cedula'] . "/" . $paciente['cedula_tipo'] . "<br>" . ponerAcentos($nombre) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos($historial[$i]['estado']) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos($historial[$i]['procedencia']) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . formatoDia($historial[$i]['fecha_ingreso'],"fecha") . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . formatoHora($historial[$i]['hora_ingreso']) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . formatoDia($historial[$i]['fecha_egreso'],"fecha") . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . formatoHora($historial[$i]['hora_egreso']) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . $nDias . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos($nombreM) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos(getServicioXid($historial[$i]['id_servicio1'])) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos($historial[$i]['extra1']) . "</td>
			<td align=\"left\" class=\"nombrePaciente\">" . ponerAcentos($historial[$i]['observaciones_ingreso']) . "<br>" . ponerAcentos($historial[$i]['observaciones_egreso']) . "</td>
		  </tr>";
	}
	
$out .= "<br><table width=\"100%\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\">
		<tr>
			<th colspan=\"13\" class=\"tituloVentana\">
				Historial
			</th>
		</tr>
	  <tr>
		<td width=\"10\" align=\"center\" class=\"nombrePaciente\">Piso y cama</td>
		<td width=\"100\" align=\"center\" class=\"nombrePaciente\">Paciente</td>
		<td width=\"50\" align=\"center\" class=\"nombrePaciente\">Estado</td>
		<td width=\"50\" align=\"center\" class=\"nombrePaciente\">Servicio Origen</td>
		<td width=\"15\" align=\"center\" class=\"nombrePaciente\">Fecha Ingreso</td>
		<td width=\"10\" align=\"center\" class=\"nombrePaciente\">Hora Ingreso</td>
		<td width=\"15\" align=\"center\" class=\"nombrePaciente\">Fecha Egreso</td>
		<td width=\"10\" align=\"center\" class=\"nombrePaciente\">Hora Egreso</td>
		<td width=\"30\" align=\"center\" class=\"nombrePaciente\">Dias Estancia</td>
		<td width=\"100\" align=\"center\" class=\"nombrePaciente\">M&eacute;dico</td>
		<td width=\"50\" align=\"center\" class=\"nombrePaciente\">Servicio</td>
		<td width=\"100\" align=\"center\" class=\"nombrePaciente\">Tipo Salida</td>
		<td width=\"100\" align=\"center\" class=\"nombrePaciente\">Observaciones</td>
		</tr>" . $temp . "
	</table>";


	print($out);
?>
