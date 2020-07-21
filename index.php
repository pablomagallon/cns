<?php
session_start ();
$_SESSION['idUsuario'] = "-1";
$_SESSION['tipoUsuario'] = "-1";
$_SESSION['IdCon'] = "-1";
$_SESSION['idServ'] = "-1";
$_SESSION['idDr'] = "-1";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ISSSTE - Censo Hospitalario</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" type="text/css">
<link rel="stylesheet" type="text/css"  href="css/smart-forms.css">
<link rel="stylesheet" type="text/css"  href="css/smart-addons.css">
<link rel="stylesheet" type="text/css"  href="css/font-awesome.min.css">
<link href="lib/misEstilos.css" rel="stylesheet" type="text/css" />
<link href="lib/impresion.css" media="print" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lib/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="lib/arreglos.js"></script>
  <script type="text/javascript" src="js/smartforms-modal.min.js"></script>     
  <script type="text/javascript" src="js/jquery-ui-custom-smart.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-timepicker.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/additional-methods.min.js"></script>
  <script type="text/javascript" src="js/autoNumeric2.min.js"></script>
    

    <!--[if lte IE 9]>
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
    <![endif]-->    
    
    <!--[if lte IE 8]>
        <link type="text/css" rel="stylesheet" href="css/smart-forms-ie8.css">
    <![endif]-->
   <script type="text/javascript" src="lib/arreglos2014.js"></script>
    <script type="text/javascript" src="lib/jquery.autocomplete.js"></script>
  <script type="text/javascript" src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
  <script>
//Nos aseguramos que estén definidas
//algunas funciones básicas
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia ||
function() {
    alert('Su navegador no soporta navigator.getUserMedia().');
};

//Este objeto guardará algunos datos sobre la cámara
window.datosVideo = {
    'StreamVideo': null,
    'url': null
}



  	$(document).ready(function(e) {
		obtenerLogin();    
	});
 

window.actualizarIndicacionesOrden = function(id_concepto, indice) {
  $("#indice_indicacion").val(indice);
  $("#llenar_indicaciones_actualizar").val(window.ordenObj[indice].indicaciones);
  $("#modal_actualizar_indicaciones").modal("show");
}

function actualizar_indicaciones() {
  var indice = $("#indice_indicacion").val();
  window.ordenObj[indice].indicaciones = $("#llenar_indicaciones_actualizar").val();
  refrescaTablaOrden();
  $("#modal_actualizar_indicaciones").modal("hide");
}

  </script>
    <style>
  
#camara, #foto{
    width: 320px;
    min-height: 240px;
    border: 1px solid #008000;
}

#combobox { width: 650px; }
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; width: 650px; font-size: 10px; font-family: arial; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }

  </style>

</head>

<body bgcolor="#EEEEEE">
<center>
<script language="javascript" type="text/javascript">
	document.write("<script type='text/javascript' src='lib/arreglos.js'></script"+">");
</script>
  <table class="tablaPrincipal" id="tablaPrincipal" width="800" height="600" cellpadding="0" cellspacing="0"><tr><td>
	<table class="encabezado" id="encabezado" width="800" height="101"><tr><td>
	  <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="2" width="104" height="101" align="center" valign="middle"><img src="diseno/logoEncabezado.png" width="74" height="74" /></td>
          <td height="48" class="tituloEncabezado" valign="middle">Censo Hospitalario&nbsp;</td>
        </tr>
        <tr>
          <td class="subtituloEncabezado">Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado &nbsp;&nbsp;&nbsp;</td>
        </tr>
      </table>
	</td></tr></table>
    
    <table id="centro" class="centro" width="800" height="499">
    <tr><td align="center" valign="top">
      <table width="800">
      	<tr><td><div id="menu" style="display:none">
        			<table border="0" width="100%" class="tablaPrincipal"><tr>
                    	<td width="150"><a href="javascript: inicio('inicio.php');" title="Inicio" class="botones_menu"><img src="diseno/_medHome.gif" width="40" height="40" border="0" /><br>Inicio</a></td>
                    	<td width="100">&nbsp;</td>
                    	<td width="250"><a href="javascript: buscar();" title="Buscar Paciente" class="botones_menu"><img src="diseno/buscar.png" width="40" height="40" border="0" /><br>Buscar Paciente</a></td>
                    	<td width="100" align="center"><a href="javascript: reportes();" title="Reportes" class="botones_menu"><img src="diseno/printer.png" width="40" height="40" border="0" /><br>Reportes</a></td>
                        <td width="100"><a href="javascript:ayuda();" title="Ayuda" class="botones_menu"><img src="diseno/ayuda.png" width="40" height="40" border="0" /><br>Ayuda</a></td>
                        <td width="100" align="right"><a href="javascript:logout();" title="Salir" class="botones_menu"><img src="diseno/logout.png" width="40" height="40" border="0" /><br>Salir</a></td>
                    </tr></table><div id="nombre_usuario"></div>
              	</div>
        </td></tr>
        <tr><td align="center"><br />
		      	<div id="contenido">
      			</div>
      	</td></tr>
      </table>
    </td></tr></table>
</td></tr></table>
</center>

    <div id="modal_llenar_orden" class="smartforms-modal" role="alert">
        <div class="smartforms-modal-container">
            <div class="smartforms-modal-header">
                <h3>Orden Médica</h3>
                <a href="#" class="smartforms-modal-close">&times;</a>            
            </div><!-- .smartforms-modal-header -->
            <div class="smartforms-modal-body">
                <div class="smart-wrap">
                    <div class="smart-forms smart-container wrap-full">
                        <div class="form-body">
                            <form method="post" action="" id="llenar_orden_form">
                                <input type="hidden" id="llenar_orden_id_concepto" name="llenar_orden_id_concepto" value="0" />
                                <div class="frm-row">
                                    <div class="section colm colm6">Tipo
                                      <label class="field" id="llenar_orden_tipo"></label>
                                    </div><!-- end section -->
                                    <div class="section colm colm6">fecha y hora de creación
                                      <label class="field" id="llenar_orden_fechahora"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Orden
                                      <label class="field" id="llenar_orden_descripcion"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Indicaciones
                                      <label class="field" id="llenar_orden_indicaciones"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm3">Hora de aplicación
                                      <label class="field prepend-icon">
                                          <input type="text" name="llenar_orden_hora" id="llenar_orden_hora" class="gui-input" placeholder="" data-rule-required="true" data-msg-required="Selecciona hora">
                                          <span class="field-icon"><i class="fa fa-clock-o"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                    <div class="section colm colm9">Observaciones
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="llenar_orden_observaciones" name="llenar_orden_observaciones" placeholder="Observaciones"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="submit" class="btn btn-success" id="btnGuardarAplicacion"> Guardar </button>
                                </div><!-- end .form-footer section -->                                                          
                            </form>                                                                                   
                        </div><!-- end .form-body section -->
                    </div><!-- end .smart-forms section -->
                </div><!-- end .smart-wrap section -->            
            </div><!-- .smartforms-modal-body -->
        </div><!-- .smartforms-modal-container -->
    </div><!-- .smartforms-modal 1 -->

    <div id="modal_llenar_orden_cuidados" class="smartforms-modal" role="alert">
        <div class="smartforms-modal-container">
            <div class="smartforms-modal-header">
                <h3>Orden Médica</h3>
                <a href="#" class="smartforms-modal-close">&times;</a>            
            </div><!-- .smartforms-modal-header -->
            <div class="smartforms-modal-body">
                <div class="smart-wrap">
                    <div class="smart-forms smart-container wrap-full">
                        <div class="form-body">
                            <form method="post" action="" id="llenar_orden_form_cuidados">
                                <input type="hidden" id="llenar_orden_id_concepto_cuidados" name="llenar_orden_id_concepto_cuidados" value="0" />
                                <div class="frm-row">
                                    <div class="section colm colm6">Tipo
                                      <label class="field" id="llenar_orden_tipo_cuidados"></label>
                                    </div><!-- end section -->
                                    <div class="section colm colm6">fecha y hora de creación
                                      <label class="field" id="llenar_orden_fechahora_cuidados"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Orden
                                      <label class="field" id="llenar_orden_descripcion_cuidados"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm12">Indicaciones
                                      <label class="field" id="llenar_orden_indicaciones_cuidados"></label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="frm-row">
                                    <div class="section colm colm9">Observaciones
                                      <label class="field prepend-icon">
                                          <textarea class="gui-textarea" id="llenar_orden_observaciones_cuidados" name="llenar_orden_observaciones_cuidados" placeholder="Observaciones" data-rule-required="true" data-msg-required="ingresa observaciones"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                                      </label>
                                    </div><!-- end section -->
                                </div><!-- end .frm-row section -->
                                <div class="smartforms-modal-footer align-right">
                                    <button type="submit" class="btn btn-success" id="btnGuardarAplicacion_cuidados"> Guardar </button>
                                </div><!-- end .form-footer section -->                                                          
                            </form>                                                                                   
                        </div><!-- end .form-body section -->
                    </div><!-- end .smart-forms section -->
                </div><!-- end .smart-wrap section -->            
            </div><!-- .smartforms-modal-body -->
        </div><!-- .smartforms-modal-container -->
    </div><!-- .smartforms-modal 1 -->



      <div id="modal_anteriores" class="modal fade bs-example-modal-lg" tabindex="-1" role="alert">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 id="anteriores_title">Modal title</h4>
            </div>
            <div id="anteriores_body" class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="agregarAnteriores();">AGREGAR A LA ORDEN</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-alert -->
      </div><!-- /.modal -->

      <div id="modal_actualizar_indicaciones" class="modal fade bs-example-modal-lg" tabindex="-1" role="alert">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 id="anteriores_title">Actualizar indicaciones</h4>
            </div>
            <div id="modal_soluciones" class="smart-wrap">
              <div class="smart-forms">
              <div class="modal-body frm-row">
                <div class="frm-row">
                    <input type="hidden" id="indice_indicacion" name="indice_indicacion" value="" />
                    <div class="section colm colm12">Ingresa las indicaciones
                      <label class="field prepend-icon">
                          <textarea class="gui-textarea" id="llenar_indicaciones_actualizar" name="llenar_indicaciones_actualizar" placeholder="Indicaciones"></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                      </label>
                    </div><!-- end section -->
                </div><!-- end .frm-row section -->
              </div>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="actualizar_indicaciones();">ACTUALIZAR LAS INDICACIONES</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-alert -->
      </div><!-- /.modal -->

<script type="text/javascript">


    jQuery.validator.setDefaults({
            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",
            onkeyup: false,
            onclick: false,
            highlight: function(element, errorClass, validClass) {
                    $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
               if (element.is(":radio") || element.is(":checkbox")) {
                        element.closest('.option-group').after(error);
               } else {
                        error.insertAfter(element.parent());
               }
            }    
    });

    function eliminaTablaOrden(index) {
      window.ordenObj.splice(index, 1);
      refrescaTablaOrden();
    }

/*  
    function refrescaTablaPOrden() {
      $('#tabla_conceptosP tbody').html('');
      var cuantos = window.ordenObjP.length;
      for (i=0; i<cuantos; i++) {
        $('#tabla_conceptosP tbody').append('<tr><td>' + window.ordenObjP[i].tipo + '</td><td><small>' + window.ordenObjP[i].descripcion + '</small></td><td><small>' + window.ordenObjP[i].indicaciones + '</small></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
      }
    }
*/

    function llenarOrdenMedica(id_orden, id_concepto, fecha, tipo, descripcion, indicaciones, hora) {
      $("#modal_llenar_orden").addClass('smartforms-modal-visible');
      $("#llenar_orden_tipo").html('<b>'+tipo+'</b>');
      $("#llenar_orden_fechahora").html('<b>'+fecha + ' ' + hora+'</b>');
      $("#llenar_orden_descripcion").html(descripcion);
      $("#llenar_orden_indicaciones").html(indicaciones);
      $("#llenar_orden_id_concepto").val(id_concepto);
      $("#llenar_orden_hora").val('');
      $("#llenar_orden_observaciones").val('');
    }

    function llenarOrdenMedicaCuidados(id_orden, id_concepto, fecha, tipo, descripcion, indicaciones, hora) {
      $("#modal_llenar_orden_cuidados").addClass('smartforms-modal-visible');
      $("#llenar_orden_tipo_cuidados").html('<b>'+tipo+'</b>');
      $("#llenar_orden_fechahora_cuidados").html('<b>'+fecha + ' ' + hora+'</b>');
      $("#llenar_orden_descripcion_cuidados").html(descripcion);
      $("#llenar_orden_indicaciones_cuidados").html(indicaciones);
      $("#llenar_orden_id_concepto_cuidados").val(id_concepto);
      $("#llenar_orden_observaciones").val('');
    }

    function refrescaTablaOrden() {
      $('#tabla_conceptos tbody').html('');
      var cuantos = window.ordenObj.length;
      for (i=0; i<cuantos; i++) {
          $('#tabla_conceptos tbody').append('<tr><td>' + window.ordenObj[i].tipo + '</td><td><small>' + window.ordenObj[i].descripcion + '</small></td><td><small>' + window.ordenObj[i].indicaciones + '</small> <a href="javascript: void(0);" class="btn btn-warning btn-xs" onclick="window.actualizarIndicacionesOrden(' + window.ordenObj[i].id_concepto + ', ' + i + ')"><span class="fa fa-pencil"></span></a></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
      }
    }

    function guardaOrdenMedica() {
        var cuantos = window.ordenObj.length;
        if (cuantos == 0) {
          alert('Captura al menos un concepto');
        } else {
          $("#botonGuardaOrdenMedica").prop( "disabled", true );
          $.ajax({
            url: '2017_ingresarOrdenMedicaConfirmar.php',
            type: 'POST',
            dataType: 'html',
            data: { id_cama: $("#id_cama").val(), id_derecho: $("#id_derecho").val(), id_medico: $("#id_medico").val(), id_servicio: $("#id_servicio").val(), fecha: $("#fecha").val(), id_usuario: $("#id_usuario").val(), objeto: JSON.stringify(window.ordenObj) },
            beforeSend: function(){
            }
          })
          .done(function(datos) {
            if (datos == "ok") {
//              alert('Guardado Correctamente');
              window.open("2017_imprimir_orden.php?tipo=ultima&fecha="+$("#fecha").val()+"&id_cama="+$("#id_cama").val()+"&id_derecho="+$("#id_derecho").val()+"&id_medico="+$("#id_medico").val()+"&id_servicio="+$("#id_servicio").val()+"&id_usuario="+$("#id_usuario").val(),'_blank');
              bajaPaciente_2017($("#id_cama").val());
              $("#botonGuardaOrdenMedica").prop( "disabled", false );
            } else {
              alert(datos);
              $("#botonGuardaOrdenMedica").prop( "disabled", false );
            }
          })
          .fail(function( req, status, err) {
             alert( 'error ', err );
             $("#botonGuardaOrdenMedica").prop( "disabled", false );
          })
          .always(function() {
          });
        }
    }


    function refrescaTablaOrden() {
      $('#tabla_conceptos tbody').html('');
      var cuantos = window.ordenObj.length;
      for (i=0; i<cuantos; i++) {
          $('#tabla_conceptos tbody').append('<tr><td>' + window.ordenObj[i].tipo + '</td><td><small>' + window.ordenObj[i].descripcion + '</small></td><td><small>' + window.ordenObj[i].indicaciones + '</small> <a href="javascript: void(0);" class="btn btn-warning btn-xs" onclick="window.actualizarIndicacionesOrden(' + window.ordenObj[i].id_concepto + ', ' + i + ')"><span class="fa fa-pencil"></span></a></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
//        $('#tabla_conceptos tbody').append('<tr><td>' + window.ordenObj[i].tipo + '</td><td><small>' + window.ordenObj[i].descripcion + '</small></td><td><small>' + window.ordenObj[i].indicaciones + '</small></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
      }
    }

    function buscaOrdenObj(obj) {
      var cuantos = window.ordenObj.length;
      var dondeExiste = -1;
/*
      for (i=0; i<cuantos; i++) {
        if (window.ordenObj[i].tipo == obj.tipo) dondeExiste = i;
      }
*/
      if (dondeExiste == -1) window.ordenObj.push(obj); else window.ordenObj[dondeExiste] = obj;
    }

    function validar_alimentos() {
         var cuantos = 0;
         var cuantosD = 0;
         var cuantosC = 0;
         var cuantosE = 0;
         $('.chk_alimentos').each(function(index, val) {
            if (this.checked) {
              cuantos++;
              var aNombre = $(this).attr('name').split("_");
              if (aNombre[0] == "d") cuantosD++;
              if (aNombre[0] == "c") cuantosC++;
              if (aNombre[0] == "e") cuantosE++;
            }
          });
          var cuantosA = window.ordenObj.length;
          for (i=0; i<cuantosA; i++) {
            if (window.ordenObj[i].tipo == 'DESAYUNO') cuantosD++;
            if (window.ordenObj[i].tipo == 'COMIDA') cuantosC++;
            if (window.ordenObj[i].tipo == 'CENA') cuantosE++;
          }
         cuantosD = cuantosD + parseInt($("#aliD").val());
         cuantosC = cuantosC + parseInt($("#aliC").val());
         cuantosE = cuantosE + parseInt($("#aliE").val());
// validación para que solo acepte uno de cada tipo
         if (cuantos == 0) {
          alert("selecciona al menos una opción");
//         } else if (cuantosD > 1) {
//          alert("Solo es permitido un tipo de desayuno");
//         } else if (cuantosC > 1) {
//          alert("Solo es permitido un tipo de comida");
//         } else if (cuantosE > 1) {
//          alert("Solo es permitido un tipo de cena");
         } else {
           $('.chk_alimentos').each(function(index, val) {
            if (this.checked) {
              var aNombre = $(this).attr('name').split("_");
              var tipo = '';
              if (aNombre[0] == "d") tipo = 'DESAYUNO';
              if (aNombre[0] == "c") tipo = 'COMIDA';
              if (aNombre[0] == "e") tipo = 'CENA';
              var posicion = window.ordenObj.length;
              var obj = { posicion: posicion, tipo: tipo, id: $(this).attr('name'), descripcion: $(this).val(), indicaciones: $("#"+aNombre[0]+'Observaciones').val() };
              buscaOrdenObj(obj);
            }
           });
            refrescaTablaOrden();
            $(':checkbox').each(function(index, val) {
              this.checked = false;
            });
         }
    }

    function validar_cuidados() {
      if ($("#cuidados_texto").val() == '') {
        alert('Ingresa el cuidado');
      } else {
          var posicion = window.ordenObj.length;
          var obj = { posicion: posicion, tipo: 'CUIDADO', id: '0', descripcion: $("#cuidados_texto").val(), indicaciones: '' };
          window.ordenObj.push(obj);
          refrescaTablaOrden();
          $('#cuidados_texto').val('');
        }

    }

    function validar_soluciones() {
      var errores = '';
        if ($('#soluciones_sel').val() == '') errores += '- Selecciona una solución\n\r';
        if ($("#soluciones_cantidad").autoNumeric('get') == '') errores += '- Ingresa la cantidad\n\r';
        if ($('#soluciones_via').val() == '') errores += '- Selecciona la vía de administración\n\r';
        if ($("#soluciones_periodo").autoNumeric('get') == '') errores += '- Ingresa el periodo\n\r';
        if ($.trim($('#soluciones_texto').val()) == '') errores += '- Ingresa las indicaciones\n\r';
          if (errores != '') {
            alert(errores);
          } else {
            var posicion = window.ordenObj.length;
            var aTruncada = $("#soluciones_sol").val().split("contiene");
            if (aTruncada.length == 1) {
              aTruncada = $("#soluciones_sol").val().split("CONTIENE");
            }
            var descripcion = aTruncada[0] + ' &nbsp;&nbsp;&nbsp; <b>' + $("#soluciones_cantidad").autoNumeric('get') + ' cada ' + $("#soluciones_periodo").autoNumeric('get') + ' hrs. ' + $("#soluciones_via").val() + '</b> - presentación: ' + $("#presentacion_sol").html() + ' ' + $("#unidad_sol").html();
            var obj = { posicion: posicion, tipo: 'SOLUCION', cantidad: $("#soluciones_cantidad").autoNumeric('get'), periodo: $("#soluciones_periodo").autoNumeric('get'), via: $("#soluciones_via").val(), presentacion: $("#presentacion_sol").html(), unidad: $("#unidad_sol").html(), concepto: $("#soluciones_sol").val(), id: $("#soluciones_sel").val(), descripcion: descripcion, indicaciones: $("#soluciones_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $('#soluciones_sel').val('');
            $("#soluciones_cantidad").val('');
            $("#soluciones_periodo").val('');
            $("#soluciones_via").prop("selectedIndex", 0);
            $("#soluciones_sol").val('');
            $("#soluciones_texto").val('');            
            $("#soluciones_sol").focus();            
          } 
    }

    function validar_medicamentos() {
      var errores = '';
        if ($('#medicamentos_sel').val() == '') errores += '- Selecciona un medicamento\n\r';
        if ($("#medicamentos_cantidad").autoNumeric('get') == '') errores += '- Ingresa la cantidad\n\r';
        if ($('#medicamento_via').val() == '') errores += '- Selecciona la vía de administración\n\r';
        if ($("#medicamentos_periodo").autoNumeric('get') == '') errores += '- Ingresa el periodo\n\r';
        if ($.trim($('#medicamentos_texto').val()) == '') errores += '- Ingresa las indicaciones\n\r';
          if (errores != '') {
            alert(errores);
          } else {
            var posicion = window.ordenObj.length;
            var aTruncada = $("#medicamentos_med").val().split("contiene");
            if (aTruncada.length == 1) {
              aTruncada = $("#medicamentos_med").val().split("CONTIENE");
            }
            var descripcion = aTruncada[0] + ' &nbsp;&nbsp;&nbsp; <b>' + $("#medicamentos_cantidad").autoNumeric('get') + ' cada ' + $("#medicamentos_periodo").autoNumeric('get') + ' hrs. ' + $("#medicamento_via").val() + '</b> - presentación: ' + $("#presentacion_med").html() + ' ' + $("#unidad_med").html();
//            var descripcion = '<b>' + $("#medicamentos_cantidad").autoNumeric('get') + ' cada ' + $("#medicamentos_periodo").autoNumeric('get') + ' hrs. ' + $("#medicamento_via").val() + '</b> &nbsp;&nbsp;&nbsp; - presentación: ' + $("#presentacion_med").html() + ' ' + $("#unidad_med").html() + ' - ' + $("#medicamentos_med").val();
            var obj = { posicion: posicion, tipo: 'MEDICAMENTO', cantidad: $("#medicamentos_cantidad").autoNumeric('get'), periodo: $("#medicamentos_periodo").autoNumeric('get'), via: $("#medicamento_via").val(), presentacion: $("#presentacion_med").html(), unidad: $("#unidad_med").html(), concepto: $("#medicamentos_med").val(), id: $("#medicamentos_sel").val(), descripcion: descripcion, indicaciones: $("#medicamentos_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $('#medicamentos_sel').val('');
            $("#medicamentos_cantidad").val('');
            $("#medicamentos_periodo").val('');
            $("#medicamento_via").prop("selectedIndex", 0);
            $("#medicamentos_med").val('');
            $("#medicamentos_texto").val('');
            $("#medicamentos_med").focus();            
          }
    }

    function validar_procedimientos() {
      var errores = '';
        if ($('#procedimeintos_sel').val() == '') errores += '- Selecciona un procedimiento\n\r';
          if (errores != '') {
            alert(errores);
          } else {
            var posicion = window.ordenObj.length;
            var obj = { posicion: posicion, tipo: 'AUX. DIAGNOSTICO', id: $("#procedimeintos_sel").val(), descripcion: $("#procedimientos_pro").val(), indicaciones: $("#procedimientos_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $('#procedimeintos_sel').val('');
            $("#procedimientos_pro").val('');
            $("#procedimientos_texto").val('');
            $("#procedimientos_pro").focus();            
          }

    }

    function agregarAnteriores() {
          $(".anterioresConceptos").each(function() {
            if (this.checked) {
              var posicion = window.ordenObj.length;
              var tipo = this.getAttribute("Dtipo");
              var cantidad = this.getAttribute("Dcantidad");
              var periodo = this.getAttribute("Dperiodo");
              var via = this.getAttribute("Dvia");
              var concepto = this.getAttribute("Dconcepto");
              var id = this.getAttribute("Did");
              var indicaciones = this.getAttribute("Dindicaciones");
              var descripcion = '<b>' + cantidad + ' cada ' + periodo + ' hrs. ' + via + '</b> - ' + concepto;
              var id_concepto = this.value;
              if ((tipo == "DESAYUNO") || (tipo == "COMIDA") || (tipo == "CENA") || (tipo == "AUX. DIAGNOSTICO"))
                var obj = { posicion: posicion, tipo: tipo, id: id, descripcion: concepto, indicaciones: indicaciones, id_concepto: id_concepto };
              else
                var obj = { posicion: posicion, tipo: tipo, cantidad: cantidad, periodo: periodo, via: via, concepto: concepto, id: id, descripcion: descripcion, indicaciones: indicaciones, id_concepto: id_concepto };
              window.ordenObj.push(obj);
            }
          });
        refrescaTablaOrden();
        $("#modal_anteriores").modal("hide");
    }

    function toggle_div_diagnosticos() {
      $("#div_diagnosticos").toggle("fast");
    }

    function btn_agrega_diagnostico(id_movimiento, id_cama, id_derecho, fecha) {
      if ($.trim($("#diagnostico_adicional").val()) == '') {
        alert("selecciona un diagnóstico adicional");
        $("#comboboxDiag").focus();
      } else {
        var contenedor = document.getElementById('anteriores_body');
        var objeto= new AjaxGET();
        objeto.open("GET", "2017_agregarDiagnostico.php?id_movimiento="+id_movimiento+"&diagnostico="+$("#diagnostico_adicional").val(),true); // SOLUCIONES
        objeto.onreadystatechange=function()
        {
          if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
          {
            if (objeto.responseText == "1")
              crearOrdenMedica_2017(id_cama, id_derecho, fecha);
            else {
              alert(objeto.responseText);
            }
          }
          if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
          {
            contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
          }
        }
        objeto.send(null)           
      }
    }

    $(function() {


      $("#modal_anteriores").on("hidden.bs.modal", function (e) {
        if ($("#anteriores_title").html() == "Soluciones Anteriores") $("#soluciones_sol").focus();
        if ($("#anteriores_title").html() == "Medicamentos Anteriores") $("#medicamentos_med").focus();
      });
      
      function refrescaTablaOrden() {
        $('#tabla_conceptos tbody').html('');
        var cuantos = window.ordenObj.length;
        for (i=0; i<cuantos; i++) {
          $('#tabla_conceptos tbody').append('<tr><td>' + window.ordenObj[i].tipo + '</td><td><small>' + window.ordenObj[i].descripcion + '</small></td><td><small>' + window.ordenObj[i].indicaciones + '</small> <a href="javascript: void(0);" class="btn btn-warning btn-xs" onclick="window.actualizarIndicacionesOrden(' + window.ordenObj[i].id_concepto + ', ' + i + ')"><span class="fa fa-pencil"></span></a></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
//          $('#tabla_conceptos tbody').append('<tr><td>' + window.ordenObj[i].tipo + '</td><td><small>' + window.ordenObj[i].descripcion + '</small></td><td><small>' + window.ordenObj[i].indicaciones + '</small></td><td><a href="javascript: void(0);" class="btn btn-danger btn-xs" onclick="eliminaTablaOrden(' + i + ')"><span class="fa fa-close"></span></a></td></tr>');
        }
      }

      function buscaOrdenObj(obj) {
        var cuantos = window.ordenObj.length;
        var dondeExiste = -1;
        for (i=0; i<cuantos; i++) {
          if (window.ordenObj[i].tipo == obj.tipo) dondeExiste = i;
        }
        if (dondeExiste == -1) window.ordenObj.push(obj); else window.ordenObj[dondeExiste] = obj;
      }
      
      $('#llenar_orden_hora').timepicker({
        showButtonPanel: false,
        timeOnlyTitle: 'Selecciona',
        timeText: '',
        hourText: 'Hora',
        minuteText: 'Minuto',
        beforeShow: function(input, inst) {
            var newclass = 'smart-forms'; 
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass('smart-forms')){
              inst.dpDiv.wrap('<div class="'+newclass+'"></div>');
            }
        }         
      
      });

      $("#llenar_orden_form").validate({
        submitHandler: function(form) {
          var hora = $("#llenar_orden_hora").val();
          var patron=/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
          if (patron.test(hora)) {
            $("#btnGuardarAplicacion").prop( "disabled", true );
            $.ajax({
              url: '2017_llenarOrdenMedicaConfirmar.php',
              type: 'POST',
              dataType: 'html',
              data: { id_cama: $("#id_cama").val(), id_derecho: $("#id_derecho").val(), id_medico: $("#id_medico").val(), id_servicio: $("#id_servicio").val(), fecha: $("#fecha").val(), id_usuario: $("#id_usuario").val(), hora: $("#llenar_orden_hora").val(), observaciones: $("#llenar_orden_observaciones").val(), id_concepto: $("#llenar_orden_id_concepto").val() },
              beforeSend: function(){
              }
            })
            .done(function(datos) {
              if (datos == "ok") {
                alert('Guardado Correctamente');
                var contenedor = document.getElementById('contenido');
                var objeto= new AjaxGET();
                objeto.open("GET", "2017_llenarOrdenMedica.php?id_cama="+$("#id_cama").val()+"&id_derecho="+$("#id_derecho").val()+"&fecha="+$("#fecha").val(),true);
                objeto.onreadystatechange=function()
                {
                  if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
                  {
                    contenedor.innerHTML = objeto.responseText;
                  }
                  if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
                  {
                    contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
                  }
                }
                objeto.send(null)
                $("#btnGuardarAplicacion").prop( "disabled", false );
                $("#modal_llenar_orden").removeClass('smartforms-modal-visible');
              } else {
                alert(datos);
                $("#btnGuardarAplicacion").prop( "disabled", false );
              }
            })
            .fail(function( req, status, err) {
               alert( 'error ', err );
               $("#btnGuardarAplicacion").prop( "disabled", false );
            })
            .always(function() {
            });
          } else
            alert('Formato de hora incorrecto');
        }
      });

      $("#llenar_orden_form_cuidados").validate({
        submitHandler: function(form) {
          var hora = $("#llenar_orden_hora").val();
          var patron=/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
          if (patron.test(hora)) {
            $("#btnGuardarAplicacion").prop( "disabled", true );
            $.ajax({
              url: '2017_llenarOrdenMedicaConfirmar.php',
              type: 'POST',
              dataType: 'html',
              data: { id_cama: $("#id_cama").val(), id_derecho: $("#id_derecho").val(), id_medico: $("#id_medico").val(), id_servicio: $("#id_servicio").val(), fecha: $("#fecha").val(), id_usuario: $("#id_usuario").val(), hora: '00:00', observaciones: $("#llenar_orden_observaciones_cuidados").val(), id_concepto: $("#llenar_orden_id_concepto_cuidados").val() },
              beforeSend: function(){
              }
            })
            .done(function(datos) {
              if (datos == "ok") {
                alert('Guardado Correctamente');
                var contenedor = document.getElementById('contenido');
                var objeto= new AjaxGET();
                objeto.open("GET", "2017_llenarOrdenMedica.php?id_cama="+$("#id_cama").val()+"&id_derecho="+$("#id_derecho").val()+"&fecha="+$("#fecha").val(),true);
                objeto.onreadystatechange=function()
                {
                  if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
                  {
                    contenedor.innerHTML = objeto.responseText;
                  }
                  if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
                  {
                    contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
                  }
                }
                objeto.send(null)
                $("#btnGuardarAplicacion").prop( "disabled", false );
                $("#modal_llenar_orden").removeClass('smartforms-modal-visible');
              } else {
                alert(datos);
                $("#btnGuardarAplicacion").prop( "disabled", false );
              }
            })
            .fail(function( req, status, err) {
               alert( 'error ', err );
               $("#btnGuardarAplicacion").prop( "disabled", false );
            })
            .always(function() {
            });
          } else
            alert('Formato de hora incorrecto');
        }
      });

      $("#alimento_form").validate({
        submitHandler: function(form) {
/*          $.each(".chk_alimentos", function(index, val) {
             alert($(this).val());
          });

          if ($("#alimento_tipo1").val() != "Sin Especificar") {
            var posicion = window.ordenObj.length;
            var obj = { posicion: posicion, tipo: 'DESAYUNO', id: 'desayuno', descripcion: $("#alimento_tipo1").val(), indicaciones: '' };
            buscaOrdenObj(obj);
            refrescaTablaOrden();
          }
          if ($("#alimento_tipo2").val() != "Sin Especificar") {
            var posicion = window.ordenObj.length;
            var obj = { posicion: posicion, tipo: 'COMIDA', id: 'comida', descripcion: $("#alimento_tipo2").val(), indicaciones: '' };
            buscaOrdenObj(obj);
            refrescaTablaOrden();
          }
          if ($("#alimento_tipo3").val() != "Sin Especificar") {
            var posicion = window.ordenObj.length;
            var obj = { posicion: posicion, tipo: 'CENA', id: 'cena', descripcion: $("#alimento_tipo3").val(), indicaciones: '' };
            buscaOrdenObj(obj);
            refrescaTablaOrden();
          }
          $("#modal_alimentos").removeClass('smartforms-modal-visible');
*/
        }
      });

      $("#cuidados_form").validate({
        submitHandler: function(form) {
          var posicion = window.ordenObj.length;
          var obj = { posicion: posicion, tipo: 'CUIDADO', id: '0', descripcion: $("#cuidados_texto").val(), indicaciones: '' };
          window.ordenObj.push(obj);
          refrescaTablaOrden();
          $("#modal_cuidados").removeClass('smartforms-modal-visible');
          $('#cuidados_texto').val('');
        }
      });

      $("#soluciones_form").validate({
        submitHandler: function(form) {
          if ($("#soluciones_sel").val() == '') {
            alert("selecciona una solución");
          } else {
            var posicion = window.ordenObj.length;
            var descripcion = '<b>' + $("#soluciones_cantidad").autoNumeric('get') + ' cada ' + $("#soluciones_periodo").autoNumeric('get') + ' hrs. ' + $("#soluciones_via").val() + '</b> - ' + $("#soluciones_sol").val();
            var obj = { posicion: posicion, tipo: 'SOLUCION', cantidad: $("#soluciones_cantidad").autoNumeric('get'), periodo: $("#soluciones_periodo").autoNumeric('get'), via: $("#soluciones_via").val(), concepto: $("#soluciones_sol").val(), id: $("#soluciones_sel").val(), descripcion: descripcion, indicaciones: $("#soluciones_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $("#modal_soluciones").removeClass('smartforms-modal-visible');
            $('#soluciones_sel').val('');
            $("#soluciones_cantidad").val('');
            $("#soluciones_periodo").val('');
            $("#soluciones_via").prop("selectedIndex", 0);
            $("#soluciones_sol").val('');
            $("#soluciones_texto").val('');            
          } 
        }
      });

      $("#medicamentos_form").validate({
        submitHandler: function(form) {
          if ($("#medicamentos_sel").val() == '') {
            alert("selecciona una solución");
          } else {
            var posicion = window.ordenObj.length;
            var descripcion = '<b>' + $("#medicamentos_cantidad").autoNumeric('get') + ' cada ' + $("#medicamentos_periodo").autoNumeric('get') + ' hrs. ' + $("#medicamento_via").val() + '</b> - ' + $("#medicamentos_med").val();
            var obj = { posicion: posicion, tipo: 'MEDICAMENTO', cantidad: $("#medicamentos_cantidad").autoNumeric('get'), periodo: $("#medicamentos_periodo").autoNumeric('get'), via: $("#medicamento_via").val(), concepto: $("#medicamentos_med").val(), id: $("#medicamentos_sel").val(), descripcion: descripcion, indicaciones: $("#medicamentos_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $("#modal_medicamentos").removeClass('smartforms-modal-visible');
            $('#medicamentos_sel').val('');
            $("#medicamentos_cantidad").val('');
            $("#medicamentos_periodo").val('');
            $("#medicamento_via").prop("selectedIndex", 0);
            $("#medicamentos_med").val('');
            $("#medicamentos_texto").val('');
          }
        }
      });

      $("#procedimientos_form").validate({
        submitHandler: function(form) {
          if ($("#procedimeintos_sel").val() == '') {
            alert("selecciona una solución");
          } else {
            var posicion = window.ordenObj.length;
            var obj = { posicion: posicion, tipo: 'PROCEDIMIENTO', id: $("#procedimeintos_sel").val(), descripcion: $("#procedimientos_pro").val(), indicaciones: $("#procedimientos_texto").val() };
            window.ordenObj.push(obj);
            refrescaTablaOrden();
            $("#modal_procedimientos").removeClass('smartforms-modal-visible');
            $('#procedimeintos_sel').val('');
            $("#procedimientos_pro").val('');
            $("#procedimientos_texto").val('');
          }
        }
      });


    });
</script>

</body>
</html>
