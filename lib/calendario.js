// JavaScript Document

function diasPorMes(mes, Anio) {
	var meses = new Array(12)
	meses[1] = 31; // Enero
	meses[2] = (((Anio % 4 == 0) && (Anio % 100 != 0)) || (Anio % 400 == 0)) ? 29 : 28
	meses[3] = 31 // Marzo
	meses[4] = 30 // Abril
	meses[5] = 31 // Mayo
	meses[6] = 30 // Junio
	meses[7] = 31 // Julio
	meses[8] = 31 // Agosto
	meses[9] = 30 // Septiembre
	meses[10] = 31 // Octubre
	meses[11] = 30 // Noviembre
	meses[12] = 31 // Diciembre
	return meses[mes]
}

function getNombreDelMes(mes) {
	var meses = new Array(12)
	meses[1] = "Enero"
	meses[2] = "Febrero"
	meses[3] = "Marzo"
	meses[4] = "Abril"
	meses[5] = "Mayo"
	meses[6] = "Junio"
	meses[7] = "Julio"
	meses[8] = "Agosto"
	meses[9] = "Septiembre"
	meses[10] = "Octubre"
	meses[11] = "Noviembre"
	meses[12] = "Diciembre"
	return meses[mes]
}

function setCal(QueMes) {
    var now = new Date()
    var anio = now.getYear()
    if (anio < 1000) {anio+=1900}
    var mes = now.getMonth()+QueMes
    if (now.getMonth()+QueMes > 11) {mes-=12;year++}
    if (now.getMonth()+QueMes < 0) {mes+=12;year--}
    var fecha = now.getDate()
    var primerDia = new Date(anio, mes, 1)
    var primerDia2 = primerDia.getDay()
    primerDia = null
    var dias = diasPorMes(mes+1, anio)
    drawCal(primerDia2 + 1, dias, fecha, mes+1, anio)
}

function drawCal(firstDay, lastDate, date, Mes, Anio) {
	var now = new Date()
	var codigo = ""
	codigo += '<table>'
	codigo += '<tr><td colspan="7">'
	codigo += getNombreDelMes(Mes) + ' ' + Anio 
	codigo += '</td></tr>'
	
	var diasSemana = new Array(7)
	diasSemana[0] = "<abbr title=\"Domingo\">D</abbr>"
	diasSemana[1] = "<abbr title=\"Lunes\">L</abbr>"
	diasSemana[2] = "<abbr title=\"Martes\">M</abbr>"
	diasSemana[3] = "<abbr title=\"Miercoles\">M</abbr>"
	diasSemana[4] = "<abbr title=\"Jueves\">J</abbr>"
	diasSemana[5] = "<abbr title=\"Viernes\">V</abbr>"
	diasSemana[6] = "<abbr title=\"Sabado\">S</abbr>"
	
	codigo += '<tr>'
	for (var dayNum = 0; dayNum < 7; ++dayNum) {
	codigo += '<td>' + diasSemana[dayNum] + '</td>' 
	}
	codigo += '</tr>'
	
	var cDia = 1
	var curCell = 1
	
	for (var row = 1; row <= Math.ceil((lastDate + firstDay - 1) / 7); ++row) {
	codigo += '<tr>'
	for (var col = 1; col <= 7; ++col) {
	if (cDia > lastDate)
	break
	if (curCell < firstDay) {
	codigo += '<td></td>';
	curCell++
	} else {
	var textoCelda = cDia;
	var textoTd = '<td>'
	if (cDia == date && Mes == now.getMonth()+1) {
	textoTd = '<td>'
	} 
	codigo += textoTd + textoCelda + '</td>'
	cDia++
	}
	}
	codigo += '</tr>'
	}
	codigo += '</table>'
	document.getElementById("boxcalendario").innerHTML=codigo;
}

