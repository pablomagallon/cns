<?php session_start ();
include_once('lib/misFunciones.php');

$hoy = date('d-m-Y');

$pisosBD = getPisos();
$cPisos = count($pisosBD);
$pisos = "";
for ($i=0; $i<$cPisos; $i++) {
	$pisos.= "<option value=\"" . $pisosBD[$i]['id_piso'] . "\">" . $pisosBD[$i]['nombre'] . "</option>"; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="datechooser" name="datechooser" method="POST" onsubmit="return validarReporte('reporte_historial_r.php');" action="#">
  <table width="400" border="0" cellspacing="0" cellpadding="0" class="ventana">
    <tr>
      <td class="tituloVentana" height="23">HISTORIAL DE EGRESOS</td>
    </tr>
    <tr>
      <td align="left" valign="top"><br />Reporte por: 
        <table width="200">
          <tr>
            <td><label>
              <input type="radio" name="RadioGroup1" value="unidad" id="RadioGroup1_0" checked="checked" />
              Unidad</label></td>
          </tr>
          <tr>
            <td><label>
              <input type="radio" name="RadioGroup1" value="piso" id="RadioGroup1_1" />
              Piso:</label><div id="pisos">
              	<select id="piso" name="piso" onfocus="javascript: document.getElementById('RadioGroup1_1').checked = 'checked'">
              		<?php echo $pisos ?>
              	</select>
              </div></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
    	<td><br />Fecha:<br /><div id="padre"  style="position:relative">de <INPUT type="text" name="date1" id="date1" onfocus="doShow('datechooser1','datechooser','date1')" value="<?php echo $hoy ?>"><div enabled='false' id="datechooser1"></div><br />&nbsp;&nbsp;a <INPUT type="text" name="date2" id="date2" onfocus="doShow('datechooser2','datechooser','date2')" value="<?php echo $hoy ?>"><div enabled='false' id="datechooser2"></div>
    	</div><br /><p align="center">
    	  <input type="button" name="regresar" id="regresar" value="Regresar" class="botones"  onclick="javascript: reportes();" />
    	  &nbsp;&nbsp;&nbsp;
<input name="boton" type="submit" value="Generar Reporte" class="botones" id="boton"  /></p>
    	<br />
    	</td>
    </tr>
  </table>
</form>
</body>
</html>
