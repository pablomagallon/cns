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
  <table width="400" border="0" cellspacing="0" cellpadding="0" class="ventana">
    <tr>
      <td class="tituloVentana" height="23">REPORTES</td>
    </tr>
    <tr>
      <td align="left" valign="top">
                      <br /><br /><a href="javascript: reportesCargar('reporte_ocupacion.php');" class="linkReportes">- Reporte de Ocupaci&oacute;n</a>
      								<br /><br /><a href="javascript: reportesCargar('reporte_internados.php');" class="linkReportes">- Reporte de Ingresos</a>
      								<br /><br /><a href="javascript: reportesCargar('reporte_historial.php');" class="linkReportes">- Historial de Egresos</a><br />
                   <!--   <br /><br /><a href="javascript: reportesCargar('2017_reporte_medicamentos.php');" class="linkReportes">- Reporte de Medicamentos</a> !-->
                      <br /><br /><a href="javascript: reportesCargar('2017_reporte_concentrado.php');" class="linkReportes">- Reporte de Concentrado de Medicamentos</a>
                      <br /><br /><a href="javascript: reportesCargar('2017_reporte_prealtas.php');" class="linkReportes">- Reporte de Prealtas</a><br /><br />
      </td>
    </tr>
  </table>
  <p align="center"><a href="javascript:inicio('inicio.php');" title="Regresar"><img src="diseno/flechaIzq.png" alt="Regresar" border="0" /></a></p>
</body>
</html>
