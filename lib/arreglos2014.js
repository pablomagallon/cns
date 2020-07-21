// JavaScript Document

function validarReporteC(liga){
	var fechaI = document.getElementById('date1');
	var fechaF = document.getElementById('date2');
	var tipo = document.getElementById('tipo_reporte').value;
	f1=fechaI.value.length;
	f2=fechaF.value.length;
	if (f1==0 || f2==0){
		alert("Ambas fechas deben estar establecidas!");
		return false;
	}
	
	var fechaIn = fechaI.value;
	var fechaFi = fechaF.value;
	var diaIn = fechaIn.substring(0,2); 
	var mesIn = (fechaIn.substring(3,5))*1 - 1;
	var anoIn = fechaIn.substring(6,10); 
	var fechaInU = new Date(anoIn,mesIn,diaIn);
	var diaFi = fechaFi.substring(0,2); 
	var mesFi = (fechaFi.substring(3,5))*1 - 1;
	var anoFi = fechaFi.substring(6,10); 
	var fechaFiU = new Date(anoFi,mesFi,diaFi);
	if(fechaInU > fechaFiU) {
      alert("La fecha final no puede ser menor a la fecha inicial");
    } else {
		var opcion = document.getElementById('RadioGroup1_0');
		if (opcion.checked) 
			var tipoReporte = document.getElementById('RadioGroup1_0').value;
		else
			var tipoReporte = document.getElementById('RadioGroup1_1').value;
		var piso = document.getElementById('piso').value;
		window.open(liga+"?fechaI="+fechaIn+"&fechaF="+fechaFi+"&tipoReporte="+tipoReporte+"&piso="+piso+"&tipo="+tipo,'_blank');
	}
	return false;
}


function ObtenerTpoDerXSexo(elemento,elemeto)
{
    ind=document.getElementById(elemento).selectedIndex;
    var sex=document.getElementById(elemento).options[ind].value;
    var tpoCedHom=new Array("10","40","41","50","51","70","71","90");
    var tpoDerHom=new Array("Trabajador","Esposo","Concubino","Padre","Abuelo","Hijo","Hijo de conyuge","Pensionado");
    var tpoCedMuj=new Array("20","30","31","32","60","61","80","81","91");
    var tpoDerMuj=new Array("Trabajadora","Esposa","Concubina","Mujer","Madre","Abuela","Hija","Hija de conyuge","Pensionada");
    var tpoCedGen=new Array("92","99");
    var tpoDerGen=new Array("Familiar de pensionado","No derechohabiente");
    var lista=document.getElementById(elemeto);
    opciones=document.getElementById(elemeto).length;
    vaciarSelect(elemeto);
    opcion=new Option("","-1");
    lista.appendChild(opcion);
    if(sex=="H"){
        for(i=0;i<tpoCedHom.length;i++)
        {
            opcion=new Option(tpoDerHom[i],tpoCedHom[i],"","");
            lista.appendChild(opcion);
        }
    }
    else
    {
        for(i=0;i<tpoCedMuj.length;i++)
        {
            opcion=new Option(tpoDerMuj[i],tpoCedMuj[i],"","");
            lista.appendChild(opcion);
        }
    }
    for(x=0;x<tpoDerGen.length;x++)
    {
        opcion=new Option(tpoDerGen[x],tpoCedGen[x],"","");
        lista.appendChild(opcion);
    }
}

function vaciarSelect(elemeto)
{
    opciones=document.getElementById(elemeto).length;
    lista=document.getElementById(elemeto);
    while(opciones>0){
        lista.options[opciones-1]=null;
        opciones=document.getElementById(elemeto).length;
    }
}

function borrarReferencias(obj)
{
    if(obj.value=="Tipo de derechohabiente" || obj.value=="Apellido Paterno" || obj.value=="Apellido Materno" || obj.value=="Nombre(s)" || obj.value=="DD/MM/AAAA")
        obj.value="";
}


function calendarios(elemento)
{
    var mes=$("#mes"+elemento+" option:selected").val();
    vaciarSelect("dia"+elemento);
    switch(mes)
    {
        case '01':
            dias=31;
            break;
        case '02':
            anio=document.getElementById('anio'+elemento).value;
            if((anio%4)==0)
                dias=29;
            else
                dias=28;
            break;
        case '03':
            dias=31;
            break;
        case '04':
            dias=30;
            break;
        case '05':
            dias=31;
            break;
        case '06':
            dias=30;
            break;
        case '07':
            dias=31;
            break;
        case '08':
            dias=31;
            break;
        case '09':
            dias=30;
            break;
        case '10':
            dias=31;
            break;
        case '11':
            dias=30;
            break;
        case '12':
            dias=31;
            break;			
    }
    for(i=1;i<=dias;i++)
    {
        if(i<10)
            opcion=new Option(i,"0"+i);
        else
            opcion=new Option(i,i);
        document.getElementById("dia"+elemento).options[i-1]=opcion;
    }
		
}

function marcarPrealta(id_cama, id_piso) {
    var contenedor=document.getElementById('cp');
    var ajax=new AjaxGET();
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4)
        {
        	infoPiso(id_piso);
        }
        else
            contenedor.innerHTML="<img src=\"diseno/loading.gif\">";
    }
    ajax.open("GET","prealta.php?id_cama="+id_cama,true);
    ajax.send(null);
}

function obtenerCodigoPostal(edo,mun,col)
{
    vaciarSelect('cp');
    var contenedor=document.getElementById('cp');
    var municipio=document.getElementById(mun).value;
    var estado=document.getElementById(edo).value;
    var colonia=document.getElementById(col).value;
    var seleccionado=contenedor.value;
    var ajax=new AjaxGET();
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4)
        {
            contenedor.innerHTML=ajax.responseText;
            contenedor.value=seleccionado;
        }
        else
            contenedor.innerHTML="<img src=\"diseno/loading.gif\">";
    }
    ajax.open("GET","../codigos_postales.php?estado="+quitarAcentos(estado)+"&municipio="+quitarAcentos(municipio)+"&col="+ponerAcentos(colonia),true);
    ajax.send(null);
    document.getElementById('cp').disabled=false;
}

function cargarColonias(colonia,cp,mun,edo)
{
    var codigo=document.getElementById(cp).value;
    var municipio=document.getElementById(mun).value;
    var contenedor=document.getElementById(colonia);
    var estado=document.getElementById(edo).value;
    var seleccionado=document.getElementById(colonia).value;
    vaciarSelect(colonia);
    var ajax=new AjaxGET();
    ajax.onreadystatechange=function() {
        if(ajax.readyState==4)
        {
            contenedor.innerHTML=ajax.responseText;
            contenedor.value=seleccionado;
        }
        else
            contenedor.innerHTML="<img src=\"diseno/loading.gif\">"; 
    }
    ajax.open("GET","../mostrarColonias.php?cp="+codigo+"&municipio="+quitarAcentos(municipio)+"&estado="+quitarAcentos(estado));
    ajax.send(null);
}


function quitarAcentosUmf(Text)  
{  
    var cadena=""; 
    var codigo="";  
    var temp = "";
    var total = Text.length;
    for (var j = 0; j < total; j++)  
    {  
        var Char=Text.charCodeAt(j);
        var cara=Text.charAt(j);
        if (cara == "&") {
            temp = Text.substring(j,j+8);
            switch (temp) {
                case "&aacute;":
                    cadena += "a";
                    j = j + 7;
                    break;
                case "&Aacute;":
                    cadena += "A";
                    j = j + 7;
                    break;
                case "&eacute;":
                    cadena += "e";
                    j = j + 7;
                    break;
                case "&Eacute;":
                    cadena += "E";
                    j = j + 7;
                    break;
                case "&iacute;":
                    cadena += "i";
                    j = j + 7;
                    break;
                case "&iacute;":
                    cadena += "I";
                    j = j + 7;
                    break;
                case "&oacute;":
                    cadena += "o";
                    j = j + 7;
                    break;
                case "&Oacute;":
                    cadena += "O";
                    j = j + 7;
                    break;
                case "&uacute;":
                    cadena += "u";
                    j = j + 7;
                    break;
                case "&uacute;":
                    cadena += "U";
                    j = j + 7;
                    break;
                case "&ntilde;":
                    cadena += "n";
                    j = j + 7;
                    break;
                case "&Ntilde;":
                    cadena += "N";
                    j = j + 7;
                    break;
                default:
                    cadena+=Text.charAt(j);  
                    break;  
            }
        } else {
            switch(Char)  
            {  
                case 225:
                    cadena+="a";  
                    break;  
                case 233:
                    cadena+="e";  
                    break;  
                case 237:
                    cadena+="i";  
                    break;  
                case 243:
                    cadena+="o";  
                    break;  
                case 250:
                    cadena+="u";  
                    break;  
                case 193:
                    cadena+="A";  
                    break;  
                case 201:
                    cadena+="E";  
                    break;  
                case 205:
                    cadena+="I";  
                    break;  
                case 211:
                    cadena+="O";  
                    break;  
                case 218:
                    cadena+="U";  
                    break;  
                case 241:
                    cadena+="n";  
                    break;  
                case 209:
                    cadena+="N";  
                    break;  
                default:
                    cadena+=Text.charAt(j);  
                    break;  
            }  
        }
        codigo+="_"+Text.charCodeAt(j);  
    }  
    return cadena;  
}  

