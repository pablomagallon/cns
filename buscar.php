<?php session_start ();
include_once('lib/misFunciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
        <div id="buscar" style="height:150px; margin-top:10px;">
          <table width="700" border="0" cellspacing="0" cellpadding="0" class="ventana">
            <tr>
              <td colspan="2" class="tituloVentana">BUSCAR PACIENTE</td>
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
                <form id="selDH" method="POST" action="javascript: buscarDHbusqueda(document.getElementById('cedulaBuscar').value);">
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
                  <td colspan="2" align="center">
                    <input name="seleccionarDH" type="button" class="botones" id="seleccionarDH" onclick="javascript: verCamaDH();" value="Buscar Paciente..." /><br /><br /></td>
                  </tr>
            
                <tr>
                  <td colspan="2" align="center"></td>
                </tr>
              </table>
              </form>
              </div>

                <div id="buscarPorNombre" style="display:none;">
                <form id="selDHN" method="POST" action="javascript: buscarDHNbusqueda(document.getElementById('ap_pB').value,document.getElementById('ap_mB').value,document.getElementById('nombreB').value);">
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
                  <td colspan="4" align="center">
                    <input name="seleccionarDH" type="button" class="botones" id="seleccionarDH" onclick="javascript: verCamaDH();" value="Seleccionar" /><br /><br /></td>
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
<div id="camas" style="display:none;">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr><td>
		</td></tr>
	</table>
</div>
  <p align="center"><a href="javascript:inicio('inicio.php');" title="Regresar"><img src="diseno/flechaIzq.png" alt="Regresar" border="0" /></a></p>
</body>
</html>
