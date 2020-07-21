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

<link rel="stylesheet" href="lib/misEstilos.css" type="text/css">
<link href="lib/login.css" rel="stylesheet" type="text/css" />
<link href="lib/impresion.css" media="print" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="lib/css/cupertino/jquery-ui-1.10.4.custom.css">
<script type="text/javascript" src="lib/jquery-2.1.1.min.js"></script>
  <script src="lib/jquery-ui-1.10.4.custom.min.js"></script>
  <script type="text/javascript" src="lib/arreglos.js"></script>
  <script type="text/javascript" src="lib/arreglos2014.js"></script>

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
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  </script>
    <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
    /* support: IE7 */
    *height: 1.2em;
    *top: 0.1em;
  }
  .custom-combobox-input {
	  width:580px;
    margin: 0;
    padding: 0.1em;
  }
  .custom-combobox-input * {
	  font-size:12px;
  }
  
#camara, #foto{
    width: 320px;
    min-height: 240px;
    border: 1px solid #008000;
}

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
                    </tr></table>
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
</body>
</html>
