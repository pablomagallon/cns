<?php session_start ();
include_once('lib/misFunciones.php');
$servicios = listaServicios();
//$medicos = listaMedicos();
$datos_cama = getDatosCama($_GET['id_cama']);
$datos_piso = getPiso($datos_cama['id_piso']);

function getOptionDiagnosticos() {
    global $hostname_bdissste;
    global $database_bdisssteC;
    global $username_bdisssteC;
    global $password_bdisssteC;
    $bdissste = mysql_pconnect($hostname_bdissste, $username_bdisssteC, $password_bdisssteC) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($database_bdisssteC, $bdissste);
    $query_query = "SELECT * FROM cie_10_simef ORDER BY Clave ASC, Decripcion ASC";
    $query = mysql_query($query_query, $bdissste) or die(mysql_error());
    $row_query = mysql_fetch_assoc($query);
    $totalRows_query = mysql_num_rows($query);
    $ret = '';
    if ($totalRows_query > 0) {
        do {
			$ret .= '<option value="' . $row_query['Clave'] . ' - ' . $row_query['Decripcion'] . '">' . $row_query['Clave'] . ' - ' . $row_query['Decripcion'] . '</option>';
        } while ($row_query = mysql_fetch_assoc($query));
    }
    @mysql_free_result($query);
    @mysql_close($dbissste);
    return $ret;

}

//$optionDiagnosticos = getOptionDiagnosticos();

?>
<form id="formaCita" method="POST" action="javascript: validarAltaPaciente('<?php echo $datos_cama['id_piso'] ?>','<?php echo $_GET['id_cama'] ?>');">
<input name="id_derecho" type="hidden" id="id_derecho" value="" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ventana">
  <tr>
    <td colspan="4" class="tituloVentana">INGRESAR PACIENTE A <?php echo $datos_piso['nombre'] ?> - <?php echo $datos_cama['descripcion'] ?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">CEDULA: </td>
    <td align="left" colspan="3"><input name="cedula" type="text" id="cedula" maxlength="13" readonly="readonly" />
     <input name="seleccionar" type="button" class="botones" id="seleccionar" onClick="javascript:  ocultarDiv('divAgregarDH'); mostrarDiv('buscar'); getElementById('cedulaBuscar').focus(); document.getElementById('buscar').style.height = '150px';
" value="Buscar Paciente"></td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">NOMBRE:</td>
    <td align="left" colspan="3"><input name="ap_p" type="text" id="ap_p" size="20" maxlength="20" readonly="readonly" onkeyup="this.value = this.value.toUpperCase();" />
      <input name="ap_m" type="text" id="ap_m" size="20" maxlength="20" readonly="readonly" onkeyup="this.value = this.value.toUpperCase();" />
      <input name="nombre" type="text" id="nombre" size="20" maxlength="20" readonly="readonly" onkeyup="this.value = this.value.toUpperCase();" /></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">SERVICIO:</td>
    <td align="left" colspan="3"><select name="servicio" id="servicio" onchange="javascript:opcionesMedicosReceta(this);"><?php echo $servicios; ?>
    </select></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">MEDICO:</td>
    <td class="textosParaInputs" align="left" colspan="3"><div id="medicos" style="float:left; margin-right:15px;"><select name="medico" id="medico" style="width:250px;"><option value="0"> </option></select></div>GRUPO SANGUINEO: 
    <select name="grupo_sanguineo" id="grupo_sanguineo">
    	<option value="" selected="selected"></option>
    	<option value="Ap">A+</option>
    	<option value="An">A-</option>
    	<option value="Bp">B+</option>
    	<option value="Bn">B-</option>
    	<option value="ABp">AB+</option>
    	<option value="ABn">AB-</option>
    	<option value="Op">O+</option>
    	<option value="On">O-</option>
    </select>
    </td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">SERVICIO ORIGEN:</td>
    <td align="left" colspan="3"><select name="estado" id="estado"><option value="0"> </option><option value="urgencias">Urgencias</option><option value="terapias">Terapias</option><option value="admision">Admisi&oacute;n Continua</option><option value="consulta">Consulta Externa</option><option value="otro">Otro</option></select>
    &nbsp;&nbsp;&nbsp;<span class="textosParaInputs">FECHA DE INGRESO: </span>
    <input name="fecha" type="text" id="fecha" maxlength="10" value="<?php echo date('d/m/Y') ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right"></td>
    <td align="left"></td>
    <td colspan="2" rowspan="2" align="center">CAPTURAR FOTO
    
        <div class="contenedor" style="display:none;" id="contenedor_camara">
            <video id="camara" autoplay controls></video>
        </div>
        <div class="contenedor" id="contenedor_foto">
            <canvas id="foto" width="320" height="240" ></canvas>
        </div>    
        <div id='botonera'>
            <input id='botonIniciar' type='button' value = 'Iniciar'></input>
            <input id='botonDetener' type='button' value = 'Detener' disabled="disabled"></input>
            <input id='botonFoto' type='button' value = 'Tomar Foto' disabled="disabled"></input>
            <input id='botonOtraFoto' type='button' value = 'Volver a Tomar Foto' disabled="disabled"></input>
        </div>
    
    </td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right">ALERGIAS:</td>
    <td align="left"><textarea name="alergias" cols="40" rows="8" id="alergias"></textarea></td>
    </tr>
  <tr>
    <td class="textosParaInputs" align="right">DIAGNOSTICO INGRESO:</td>
    <td align="left" colspan="3">
        <input type="hidden" name="diagnostico_alta" id="diagnostico_alta" value="" />
        <input type="text" name="combobox" id="combobox" />
    </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
  <input type="button" name="regresar" id="regresar" value="Regresar" class="botones"  onclick="javascript: infoPiso('<?php echo $datos_cama['id_piso'] ?>');" />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" name="agregar" id="agregar" value="Ingresar Paciente" class="botones" disabled="disabled" />
  <br /><br /><div id="enviando">&nbsp;</div></td>
  </tr>
</table>
</form>

<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
        <div id="buscar" style=" display:none; height:150px; margin-top:10px;">
          <table width="700" border="0" cellspacing="0" cellpadding="0" class="ventana">
            <tr>
              <td colspan="2" class="tituloVentana">BUSCAR DERECHOHABIENTE</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="textosParaInputs" align="right" width="191">TIPO DE BUSQUEDA: </td>
              <td align="left"><select name="tipo_busqueda" id="tipo_busqueda" onchange="javascript: buscarPor();">
                <option value="cedula" selected="selected">C&eacute;dula</option>
                <option value="nombre">Nombre</option>
              </select>
              </td>
            </tr>
            <tr>
            <td colspan="2">
            	<div id="buscarPorCedula">
                <form id="selDH" method="POST" action="javascript: buscarDH(document.getElementById('cedulaBuscar').value);">
                <table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" class="textosParaInputs" align="right">CEDULA: </td>
                  <td align="left"><input type="text" name="cedulaBuscar" id="cedulaBuscar" maxlength="10"  onkeyup="this.value = this.value.toUpperCase();"/>
                    <input name="buscar" type="submit" class="botones" id="buscar" value="Buscar..." /></td>
                </tr>
                <tr>
                  <td height="25" class="textosParaInputs" align="right">DERECHOHABIENTE: </td>
                  <td align="left"><div id="derechohabientes">Ingrese la c&eacute;dula del derechohabiente y haga click en Buscar...</div>
                  </td>
                </tr>
            
                <tr>
                  <td colspan="2" align="center"><input name="cerrar" type="button" class="botones" id="cerrar" onclick="javascript: ocultarDiv('buscar');" value="Cerrar" />&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="seleccionarDH" type="button" class="botones" id="seleccionarDH" onclick="javascript: cargarDatosDH2014();" value="Seleccionar" /><br /><br /></td>
                  </tr>
            
                <tr>
                  <td colspan="2" align="center"></td>
                </tr>
              </table>
              </form>
              </div>

                <div id="buscarPorNombre" style="display:none;">
                <form id="selDHN" method="POST" action="javascript: buscarDHN(document.getElementById('ap_pB').value,document.getElementById('ap_mB').value,document.getElementById('nombreB').value);">
                <table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" class="textosParaInputs" align="right">APELLIDO PATERNO: </td>
                  <td align="left"><input type="text" name="ap_pB" id="ap_pB" maxlength="25" onkeyup="this.value = this.value.toUpperCase();" /></td>
                  <td height="25" class="textosParaInputs" align="right">APELLIDO MATERNO: </td>
                  <td align="left"><input type="text" name="ap_mB" id="ap_mB" maxlength="25" onkeyup="this.value = this.value.toUpperCase();" /></td>
                </tr>
                <tr>
                  <td height="25" class="textosParaInputs" align="right">NOMBRE: </td>
                  <td align="left" colspan="3"><input type="text" name="nombreB" id="nombreB" maxlength="25" onkeyup="this.value = this.value.toUpperCase();" />
                    <input name="buscarN" type="submit" class="botones" id="buscarN" value="Buscar..." /></td>
                </tr>
                <tr>
                  <td height="25" class="textosParaInputs" align="right">DERECHOHABIENTE: </td>
                  <td align="left" colspan="3"><div id="derechohabientes2">Ingrese los datos del derechohabiente y haga click en Buscar...</div>
                  </td>
                </tr>
            
                <tr>
                  <td colspan="4" align="center"><input name="cerrar" type="button" class="botones" id="cerrar" onclick="javascript: ocultarDiv('buscar');" value="Cerrar" />&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="seleccionarDH" type="button" class="botones" id="seleccionarDH" onclick="javascript: cargarDatosDH2014();" value="Seleccionar" /><br /><br /></td>
                  </tr>
            
                <tr>
                  <td colspan="4" align="center"></td>
                </tr>
              </table>
              </form>
              </div>
          </td>
          </tr>
          </table>
        </div>
	</td>
</tr>
</table>

<form id="agregarDH" method="POST" action="javascript: agregarDHenCitaForma();">
<table width="800" height="25" border="0" cellpadding="0" cellspacing="0" style="background: #FFF;">
<tr>
  <td>
       <div id="divAgregarDH" style="display:none; height:0px">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ventana">
            <tr>
              <td colspan="2" class="tituloVentana">AGREGAR DERECHOHABIENTE</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="25" class="textosParaInputs" align="right">CEDULA: </td>
              <td align="left"><input type="text" name="cedulaAgregar" id="cedulaAgregar" maxlength="10" /></td>
            </tr>
            <tr><td  align="right" class="textosParaInputs">SEXO</td><td><select name="sexo" id="sexo" onchange="ObtenerTpoDerXSexo(this.id,'cedulaTipoAgregar')">
              <option value="-1" selected="selected"></option>
              <option value="M">Mujer</option>
              <option value="H">Hombre</option>
              </select>
                        &nbsp;<span class="textosParaInputs">TIPO DE CEDULA</span>&nbsp;<select name="cedulaTipoAgregar" id="cedulaTipoAgregar" onfocus="ObtenerTpoDerXSexo('sexo', this.id);">
              </select></td>
            </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="center" colspan="4">NOMBRE DE DERECHOHABIENTE</td></tr>
    <tr height="25"><td class="textosParaInputs" align="right">APELLIDO PATERNO</td>
    <td align="left"><input name="ap_pAgregar" type="text" id="ap_pAgregar" size="20" maxlength="20" onkeyup="this.value = this.value.toUpperCase();" value="Apellido Paterno" onfocus="javascript:borrarReferencias(this);" /><span class="textosParaInputs">APELLIDO MATERNO</span>
      <input name="ap_mAgregar" type="text" id="ap_mAgregar" size="20" maxlength="20" onkeyup="this.value = this.value.toUpperCase();" value="Apellido Materno" onfocus="javascript:borrarReferencias(this);" /></td></tr>
      <td class="textosParaInputs" align="right">NOMBRES</td><td>
      <input name="nombreAgregar" type="text" id="nombreAgregar" size="20" maxlength="20" onkeyup="this.value = this.value.toUpperCase();" value="Nombre(s)" onfocus="javascript:borrarReferencias(this);" /></td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">TELEFONO:</td>
    <td align="left"><input name="telefonoAgregar" type="text" id="telefonoAgregar" size="20" maxlength="10" value="" /><span class="textosParaInputs"> F. NAC. </span><span style="position:relative">
        <label for="mes1">mes</label>
        <select name="mes1" id="mes1" tabindex="8" onchange="calendarios('1');">
          <option value="-1"></option>
          <option value="01">ene</option>
          <option value="02">feb</option>
          <option value="03">mar</option>
          <option value="04">abr</option>
          <option value="05">may</option>
          <option value="06">jun</option>
          <option value="07">jul</option>
          <option value="08">ago</option>
          <option value="09">sept</option>
          <option value="10">oct</option>
          <option value="11">nov</option>
          <option value="12">dic</option>
        </select>
        <label for="dia1">dia</label>
        <select name="dia1" id="dia1" tabindex="9">
          <option value="-1"></option>
          <option value="01">1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        <label for="anio1">año</label>
        <select name="anio1" id="anio1" tabindex="10">
        <?php
      $ini=date("Y");
      $fin=$ini-150;
      for($i=$ini;$i>$fin;$i--)
      {
        echo "<option value='$i'>$i</option>";
      }
    ?></select>
      </span>
    </td>
</td>
  </tr>
  <tr>
    <td height="25" class="textosParaInputs" align="right">DIRECCION:</td>
    <td align="left"><input name="direccionAgregar" type="text" id="direccionAgregar" size="64" maxlength="50" onkeyup="this.value = this.value.toUpperCase();" /></td>
  </tr>
 <tr>
    <td height="25" class="textosParaInputs" align="right">ESTADO:</td>
    <td align="left"><select name="estadoAgregar" id="estadoAgregar" tabindex="14" onchange="javascript: cargarMunicipios(this.value,'municipioAgregar');">
      <script type="text/javascript">
                cargarEstados('estadoAgregar');
            </script>
    </select>
      <span class="textosParaInputs">MUNICIPIO: </span>
      <select name="municipioAgregar" id="municipioAgregar" tabindex="15" onchange="vaciarSelect('col');vaciarSelect('cp');obtenerCodigoPostal('estadoAgregar',this.id,'col');cargarColonias('col','cp', 'municipioAgregar','estadoAgregar');">
      </select></td>
  </tr>
  <tr>
    <td class="textosParaInputs" align="right"> COLONIA</td>
    <td><select name="col" id="col" tabindex="16" onchange="obtenerCodigoPostal('estadoAgregar','municipioAgregar',this.id);">
    </select>
      <span class="textosParaInputs">CODIGO POSTAL</span>
      <select name="cp" id="cp" tabindex="17" onchange="cargarColonias('col',this.id, 'municipioAgregar','estadoAgregar')"  value="0" >
      </select></td>
      </tr>
  <tr>
    <td><span class="textosParaInputs">UNIDAD MEDICA DE ADSCRIPCIÓN:</span></td>
    <td align="left"><select name="Unidad" id="Unidad" tabindex="18">
    </select></td>
    </tr>
    <tr>
      <td class="textosParaInputs" align="right">CURP:</td>
      <td align="left"><input name="curpAgregar" type="text" id="curpAgregar" size="30" tabindex="12" />
    </tr>
    <tr>
      <td class="textosParaInputs" align="right">E-MAIL:</td>
      <td align="left"><input name="emailAgregar" type="text" id="emailAgregar" size="30" tabindex="12" />
      <span class="textosParaInputs">CELULAR</span>
      <input type="text" name="cel" value="" maxlength="10" size="10" id="cel" tabindex="13" /></td>
    </tr>
        
            <tr>
              <td class="textosParaInputs" align="right">&nbsp;</td>
              <td align="left">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" align="center"><div id="divBotones_EstadoAgregarDH"></div>
                </td>
              </tr>
        
            <tr>
              <td colspan="2" align="center"></td>
            </tr>
          </table>
        </div>
  </td>
</tr>
</table>


</form>