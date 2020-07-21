// JavaScript Document

var statusCitas = new Array("DISPONIBLE","CITA PENDIENTE","CITA CUBIERTA","DE VACACIONES","EN CONGRESO","DIA INHABIL","LICENCIA MEDICA","BAJA TEMPORAL","OTRO","ELIMINADA");
var statusDerecho = new Array("ACTIVO","INACTIVO","OTRO");
var statusUsuario = new Array("ACTIVO","INACTIVO");
var tipoCita = new Array("PRIMERA VEZ","SUBSECUENTE","PROCEDIMIENTO");
var titulos = new Array("DR.","DRA.");
var tipoUsuario = new Array("ADMINISTRADOR","CAPTURISTA","CAPTURISTA ESPECIAL","ARCHIVO","REPORTES");
paraRestaurarModificacionesDHenAgregarCitaAp_p = "";
paraRestaurarModificacionesDHenAgregarCitaAp_m = "";
paraRestaurarModificacionesDHenAgregarCitaNombre = "";
paraRestaurarModificacionesDHenAgregarCitaTel = "";
paraRestaurarModificacionesDHenAgregarCitaDir = "";
tipo_cedulas = new Array("10","20","30","31","32","40","41","50","51","60","61","70","71","80","81","90","91","92","99");

var estados = new Array();
estados['Zacatecas'] = new Array ('Apozol','Apulco','Atolinga','Benito Ju&aacute;rez','Calera','Ca&ntilde;itas de Felipe Pescador','Concepci&oacute;n del Oro','Cuauht&eacute;moc','Chalchihuites','Fresnillo','Trinidad Garc&iacute;a de la Cadena','Genaro Codina','General Enrique Estrada','General Francisco R. Murgu&iacute;a','El Plateado de Joaqu&iacute;n Amaro','General P&aacute;nfilo Natera','Guadalupe','Huanusco','Jalpa','Jerez','Jim&eacute;nez del Teul','Juan Aldama','Juchipila','Loreto','Luis Moya','Mazapil','Melchor Ocampo','Mezquital del Oro','Miguel Auza','Momax','Monte Escobedo','Morelos','Moyahua de Estrada','Nochistl&aacute;n de Mej&iacute;a','Noria de &aacute;ngeles','Ojocaliente','P&aacute;nuco','Pinos','R&iacute;o Grande','Sa&iacute;n Alto','El Salvador','Sombrerete','Susticac&aacute;n','Tabasco','Tepechitl&aacute;n','Tepetongo','Teul de Gonz&aacute;lez Ortega','Tlaltenango de S&aacute;nchez Rom&aacute;n','Valpara&iacute;so','Vetagrande','Villa de Cos','Villa Garc&iacute;a','Villa Gonz&aacute;lez Ortega','Villa Hidalgo','Villanueva','Zacatecas','Trancoso','Santa Mar&iacute;a de la Paz','Otro');

estados['Yucat&aacute;n'] = new Array('Abal&aacute;','Acanceh','Akil','Baca','Bokob&aacute;','Buctzotz','Cacalch&eacute;n','Calotmul','Cansahcab','Cantamayec','Celest&uacute;n','Cenotillo','Conkal','Cuncunul','Cuzam&aacute;','Chacsink&iacute;n','Chankom','Chapab','Chemax','Chicxulub Pueblo','Chichimil&aacute;','Chikindzonot','Chochol&aacute;','Chumayel','Dzan','Dzemul','Dzidzant&uacute;n','Dzilam de Bravo','Dzilam Gonz&aacute;lez','Dzit&aacute;s','Dzoncauich','Espita','Halach&oacute;','Hocab&aacute;','Hoct&uacute;n','Hom&uacute;n','Huh&iacute;','Hunucm&aacute;','Ixil','Izamal','Kanas&iacute;n','Kantunil','Kaua','Kinchil','Kopom&aacute;','Mama','Man&iacute;','Maxcan&uacute;','Mayap&aacute;n','M&eacute;rida','Mococh&aacute;','Motul','Muna','Muxupip','Opich&eacute;n','Oxkutzcab','Panab&aacute;','Peto','Progreso','Quintana Roo','R&iacute;o Lagartos','Sacalum','Samahil','Sanahcat','San Felipe','Santa Elena','Sey&eacute;','Sinanch&eacute;','Sotuta','Sucil&aacute;','Sudzal','Suma','Tahdzi&uacute;','Tahmek','Teabo','Tecoh','Tekal de Venegas','Tekant&oacute;','Tekax','Tekit','Tekom','Telchac Pueblo','Telchac Puerto','Temax','Temoz&oacute;n','Tepak&aacute;n','Tetiz','Teya','Ticul','Timucuy','Tinum','Tixcacalcupul','Tixkokob','Tixm&eacute;huac','Tixp&eacute;hual','Tizim&iacute;n','Tunk&aacute;s','Tzucacab','Uayma','Uc&uacute;','Um&aacute;n','Valladolid','Xocchel','Yaxcab&aacute;','Yaxkukul','Yoba&iacute;n','Otro');

estados['Veracruz'] = new Array('Acajete','Acatl&aacute;n','Acayucan','Actopan','Acula','Acultzingo','Agua Dulce','Alpatl&aacute;huac','Alto Lucero de Guti&eacute;rrez Barrios','Altotonga','Alvarado','Amatitl&aacute;n','Amatitl&aacute;n de los Reyes','&aacute;ngel R. Cabada','Apazapan','Aquila','Astacinga','Atlahuilco','Atoyac','Atzacan','Atzalan','Ayahualulco','Banderilla','Benito Ju&aacute;rez','Boca del R&iacute;o','Calcahualco','Camar&oacute;n de Tejada','Camerino Z. Mendoza','Carlos A. Carrillo','Carrillo Puerto','Castillo de Teayo','Catemaco','Cazones de Herrera','Cerro Azul','Chacaltianguis','Chalma','Chiconamel','Chiconquiaco','Chicontepec','Chinameca','Chinampa de Gorostiza','Chocom&aacute;n','Chontla','Chumatl&aacute;n','Citlalt&eacute;petl','Coacoatzintla','Coahuitl&aacute;n (Progreso de Zaragoza)','Coatepec','Coatzacoalcos','Coatzintla','Coetzala','Colipa','Comapa','C&oacute;rdoba','Cosamaloapan','Cosautl&aacute;n de Carvajal','Coscomatepec','Cosoleacaque','Cotaxtla','Coxquihi','Coyutla','Cuichapa','Cuitl&aacute;huac','El Higo','Emiliano Zapata','Espinal','Filomeno Mata','Fort&iacute;n','Guti&eacute;rrez Zamora','Hidalgotitl&aacute;n','Huatusco','Huayacocotla','Hueyapan de Ocampo','Huiloapan de Cuauht&eacute;moc','Igancio de la Llave','Ilamatl&aacute;n','Isla','Ixcatepec','Ixhuac&aacute;n de los Reyes','Ixhuatl&aacute;n de Madero','Ixhuatl&aacute;n del Caf&eacute;','Ixhuatl&aacute;n del Sureste','Ixhuatlancillo','Ixmatlahuacan','Ixtaczoquitl&aacute;n','Jalancingo','Jalcomulco','J&aacute;ltipan','Jamapa','Jes&uacute;s Carranza','Jilotepec','Jos&eacute; Azueta','Juan Rodr&iacute;guez Clara','Juchique de Ferrer','La Antigua','La Perla','Landero y Coss','Las Choapas','Las Minas','Las Vigas de Ram&iacute;rez','Lerdo de Tejada','Los Reyes','Magdalena','Maltrata','Manlio Fabio Altamirano','Mariano Escobedo','Mart&iacute;nez de la Torre','Mecatl&aacute;n','Mecayapan','Medell&iacute;n','Mihuatl&aacute;n','Minatitl&aacute;n','Misantla','Mixtla de Altamirano','Moloac&aacute;n','Nanchital de L&aacute;zaro C&aacute;rdenas del R&iacute;o','Naolinco','Naranjal','Naranjos-Amatl&aacute;n','Nautla','Nogales','Oluta','Omealca','Orizaba','Otatitl&aacute;n','Oteapan','Ozuluama','Pajapan','P&aacute;nuco','Papantla','Paso de Ovejas','Paso del Macho','Perote','Plat&oacute;n S&aacute;nchez','Playa Vicente','Poza Rica de Hidalgo','Pueblo Viejo','Puente Nacional','Rafael Delgado','Rafael Lucio','R&iacute;o Blanco','Saltabarranca','San Andr&eacute;s Tenejapan','San Andr&eacute;s Tuxtla','San Juan Evangelista','San Rafael','Santiago Sochiapan','Santiago Tuxtla','Sayula de Alem&aacute;n','Sochiapa','Soconusco','Soledad Atzompa','Soledad de Doblado','Soteapan','Tamal&iacute;n','Tamiahua','Tampico Alto','Tancoco','Tantima','Tantoyuca','Tatahuicapan de Ju&aacute;rez','Tatatila','Tecolutla','Tehuipango','Temapache','Tempoal','Tenampa','Tenochtitl&aacute;n','Teocelo','Tepatlaxco','Tepetl&aacute;n','Tepetzintla','Tequila','Texcatepec','Texhuac&aacute;n','Texistepec','Tezonapa','Tierra Blanca','Tihuatl&aacute;n','Tlachichilco','Tlacojalpan','Tlacolulan','Tlacotalpan','Tlacotepec de Mej&iacute;a','Tlalixcoyan','Tlalnelhuayocan','Tlaltetela','Tlapacoyan','Tlaquilpan','Tlilapan','Tomatl&aacute;n','Tonay&aacute;n','Totutla','Tres Valles','Tuxpan','Tuxtilla','&uacute;rsulo Galv&aacute;n','Uxpanapa','Vega de Alatorre','Veracruz','Villa Aldama','Xalapa','Xico','Xoxocotla','Yanga','Yecuatla','Zacualpan','Zaragoza','Zentla','Zongolica','Zontecomatl&aacute;n','Zozocolco','Otro');

estados['Tlaxcala'] = new Array('Amaxac de Guerrero','Apetatitl&aacute;n de Antonio Carvajal','Atlangatepec','Altzayanca','Apizaco','Benito Ju&aacute;rez','Calpulalpan','El Carmen Tequexquitla','Cuapiaxtla','Cuaxomulco','Emiliano Zapata','Santa Ana Chiautempan','Mu&ntilde;oz de Domingo Arenas','Espa&ntilde;ita','Huamantla','Hueyotlipan','Ixtacuixtla de Mariano Matamoros','Ixtenco','Mazatecochco de Jos&eacute; Maria Morelos','Contla de Juan Cuamatzi','Tepetitla de Lardiz&aacute;bal','Sanctorum de L&aacute;zaro C&aacute;rdenas','Nanacamilpa de Mariano Arista','Acuamanala de Miguel Hidalgo','Nativitas','Panotla','Papalotla de Xicoht&eacute;ncatl','San Pablo del Monte','Santa Cruz Tlaxcala','Tenancingo','Teolocholco','Tepeyanco','Terrenate','Tetla de la Solidaridad','Tetlatlahuca','Tlaxcala de Xicoht&eacute;ncatl','Tlaxco','Tocatlan','Totolac','Tzompantepec','Xaloztoc','Xicohtzinco','Yauhquemecan','Zacatelco','Zitlaltepec de Trinidad S&aacute;nchez Santos','L&aacute;zaro C&aacute;rdenas','La Magdalena Tlaltelulco','San Dami&aacute;n Texoloc','San Francisco Tetlanohcan','San Jer&oacute;nimo Zacualpan','San Jos&eacute; Teacalco','San Juan Huactzinco','San Lorenzo Axocomanitla','San Lucas Tecopilco','Santa Ana Nopalucan','Santa Apolonia Teacalco','Santa Catarina Ayometla','Santa Cruz Quilehtla','Santa Isabel Xiloxoxtla','Otro');

estados['Tamaulipas'] = new Array('Abasolo','Aldama','Altamira','Antiguo Morelos','Burgos','Bustamante','Camargo','Casas','Ciudad Madero','Cruillas','G&oacute;mez Farias','Gonz&aacute;lez','G¸&eacute;mez','Guerrero','Gustavo D&iacute;az Ord&aacute;z','Hidalgo','Jaumave','Jim&eacute;nez','Llera','Mainero','El Mante','Matamoros','M&eacute;ndez','Mier','Miguel Alem&aacute;n','Miquihuana','Nuevo Laredo','Nuevo Morelos','Ocampo','Padilla','Palmillas','Reynosa','R&iacute;o Bravo','San Carlos','San Fernando','San Nicol&aacute;s','Soto la Marina','Tampico','Tula','Valle Hermoso','Victoria','Villagr&aacute;n','Xicot&eacute;ncatl','Otro');

estados['Tabasco'] = new Array('Balanc&aacute;n','C&aacute;rdenas','Centla','Centro','Comalcalco','Cunduac&aacute;n','Emiliano Zapata','Huimanguillo','Jalapa','Jalpa de M&eacute;ndez','Jonuta','Macuspana','Nacajuca','Para&iacute;so','Tacotalpa','Teapa','Tenosique','Otro');

estados['Sonora'] = new Array('Aconchi','Agua Prieta','&aacute;lamos','Altar','Arivechi','Arizpe','Atil','Bacad&eacute;huachi','Bacanora','Bacerac','Bacoachi','B&aacute;cum','Ban&aacute;michi','Bavi&aacute;cora','Bavispe','Benito Ju&aacute;rez','Benjam&iacute;n Hill','Caborca','Cajeme','Cananea','Carb&oacute;','Cucurpe','Cumpas','Divisaderos','Empalme','Etchojoa','Fronteras','General Plutarco El&iacute;as Calles','Granados','Guaymas','Hermosillo','Huachinera','Hu&aacute;sabas','Huatabampo','Hu&eacute;pac','&iacute;muris','La Colorada','Magdalena','Mazat&aacute;n','Moctezuma','Naco','N&aacute;cori Chico','Nacozari','Navojoa','Nogales','Onavas','Opodepe','Oquitoa','Pitiquito','Puerto Pe&ntilde;asco','Quiriego','Ray&oacute;n','Rosario','Sahuaripa','San Felipe de Jes&uacute;s','San Ignacio R&iacute;o Muerto','San Javier','San Luis R&iacute;o Colorado','San Miguel de Horcasitas','San Pedro de la Cueva','Santa Ana','Santa Cruz','S&aacute;ric','Soyopa','Suaqui Grande','Tepache','Trincheras','Tubutama','Ures','Villa Hidalgo','Villa Pesqueira','Y&eacute;cora','Otro');

estados['Sinaloa'] = new Array('Ahome','Angostura','Badiraguato','Choix','Concordia','Cosal&aacute;','Culiac&aacute;n','El Fuerte','Elota','Escuinapa','Guasave','Mazatl&aacute;n','Mocorito','Navolato','Rosario','Salvador Alvarado','San Ignacio','Sinaloa','Otro');

estados['San Luis Potos&iacute;'] = new Array('Ahualulco','Alaquines','Aquism&oacute;n','Armadillo de los Infante','Axtla de Terrazas','C&aacute;rdenas','Catorce','Cedral','Cerritos','Cerro de San Pedro','Charcas','Ciudad del Ma&iacute;z','Ciudad Fern&aacute;ndez','Ciudad Valles','Coxcatl&aacute;n','&eacute;bano','El Naranjo','Guadalc&aacute;zar','Huehuetl&aacute;n','Lagunillas','Matehuala','Matlapa','Mexquitic de Carmona','Moctezuma','Ray&oacute;n','R&iacute;overde','Salinas','San Antonio','San Ciro de Acosta','San Luis Potos&iacute;','San Mart&iacute;n Chalchicuautla','San Nicol&aacute;s de Tolentino','San Vicente Tancuayalab','Santa Catarina','Santa Mar&iacute;a del R&iacute;o','Santo Domingo','Soledad de Graciano S&aacute;nchez','Tamasopo','Tamazunchale','Tampac&aacute;n','Tampamol&oacute;n','Tamu&iacute;n','Tancahuitz','Tanlaj&aacute;s','Tanqui&aacute;n de Escobedo','Tierra Nueva','Vanegas','Venado','Villa de Arista','Villa de Arriaga','Villa de Guadalupe','Villa de la Paz','Villa de Ramos','Villa de Reyes','Villa Hidalgo','Villa Ju&aacute;rez','Xilitla','Zaragoza','Otro');

estados['Quintana Roo'] = new Array('Benito Ju&aacute;rez','Cozumel','Felipe Carrillo Puerto','Isla Mujeres','Jos&eacute; Mar&iacute;a Morelos','L&aacute;zaro C&aacute;rdenas','Oth&oacute;n P. Blanco','Solidaridad','Tulum','Otro');

estados['Quer&eacute;taro'] = new Array('Amealco de Bonfil','Arroyo Seco','Cadereyta de Montes','Col&oacute;n','Corregidora','El Marqu&eacute;s','Ezequiel Montes','Huimilpan','Jalpan de Serra','Landa de Matamoros','Pedro Escobedo','Pe&ntilde;amiller','Pinal de Amoles','Quer&eacute;taro','San Joaqu&iacute;n','San Juan del R&iacute;o','Tequisquiapan','Tolim&aacute;n','Otro');

estados['Puebla'] = new Array('Acajete','Acateno','Acatl&aacute;n de Osorio','Acatzingo','Acteopan','Ahuacatl&aacute;n','Ahuatl&aacute;n','Ahuazotepec','Ahuehuetitla','Ajalpan','Albino Zertuche','Aljojuca','Altepexi','Amixtl&aacute;n','Amozoc','Aquixtla','Atempan','Atexcal','Atlequizayan','Atlixco','Atoyatempan','Atzala','Atzitzihuac&aacute;n','Atzitzintla','Axutla','Ayotoxco de Guerrero','Calpan','Caltepec','Camocuautla','Ca&ntilde;ada Morelos','Caxhuac&aacute;n','Chalchicomula de Sesma','Chapulco','Chiautla','Chiautzingo','Chichiquila','Chiconcuautla','Chietla','Chigmecatitl&aacute;n','Chignahuapan','Chignautla','Chila de la Sal','Chila de las Flores','Chilchotla','Chinantla','Coatepec','Coatzingo','Cohetzala','Cohuec&aacute;n','Coronango','Coxcatl&aacute;n','Coyomeapan','Coyotepec','Cuapiaxtla de Madero','Cuautempan','Cuautinch&aacute;n','Cuautlancingo','Cuayuca de Andrade','Cuetzalan del Progreso','Cuyoaco','Domingo Arenas','Eloxochitl&aacute;n','Epatl&aacute;n','Esperanza','Francisco Z. Mena','General Felipe &aacute;ngeles','Guadalupe','Guadalupe Victoria','Hermenegildo Galeana','Honey','Huaquechula','Huatlatlauca','Huauchinango','Huehuetla','Huehuetl&aacute;n el Chico','Huehuetl&aacute;n el Grande','Huejotzingo','Hueyapan','Hueytamalco','Hueytlalpan','Huitzilan de Serd&aacute;n','Huitziltepec','Ixcamilpa de Guerrero','Ixcaquixtla','Ixtacamaxtitl&aacute;n','Ixtepec','Iz&uacute;car de Matamoros','Jalpan','Jolalpan','Jonotla','Jopala','Juan C. Bonilla','Juan Galindo','Juan N. M&eacute;ndez','La Magdalena Tlatlauquitepec','Lafragua','Libres','Los Reyes de Ju&aacute;rez','Mazapiltepec de Ju&aacute;rez','Mixtla','Molcaxac','Naupan','Nauzontla','Nealtican','Nicol&aacute;s Bravo','Nopalucan','Ocotepec','Ocoyucan','Olintla','Oriental','Pahuatl&aacute;n','Palmar de Bravo','Pantepec','Petlalcingo','Piaxtla','Puebla','Quecholac','Quimixtl&aacute;n','Rafael Lara Grajales','San Andr&eacute;s Cholula','San Antonio Ca&ntilde;ada','San Diego La Mesa Tochimiltzingo','San Felipe Teotlalcingo','San Felipe Tepatl&aacute;n','San Gabriel Chilac','San Gregorio Atzompa','San Jer&oacute;nimo Tecuanipan','San Jer&oacute;nimo Xayacatl&aacute;n','San Jos&eacute; Chiapa','San Jos&eacute; Miahuatl&aacute;n','San Juan Atenco','San Juan Atzompa','San Mart&iacute;n Texmelucan','San Mart&iacute;n Totoltepec','San Mat&iacute;as Tlalancaleca','San Miguel Ixitl&aacute;n','San Miguel Xoxtla','San Nicol&aacute;s Buenos Aires','San Nicol&aacute;s de los Ranchos','San Pablo Anicano','San Pedro Cholula','San Pedro Yeloixtlahuaca','San Salvador el Seco','San Salvador el Verde','San Salvador Huixcolotla','San Sebasti&aacute;n Tlacotepec','Santa Catarina Tlaltempan','Santa In&eacute;s Ahuatempan','Santa Isabel Cholula','Santiago Miahuatl&aacute;n','Santo Tom&aacute;s Hueyotlipan','Soltepec','Tecali de Herrera','Tecamachalco','Tecomatl&aacute;n','Tehuac&aacute;n','Tehuitzingo','Tenampulco','Teopantl&aacute;n','Teotlalco','Tepanco de L&oacute;pez','Tepango de Rodr&iacute;guez','Tepatlaxco de Hidalgo','Tepeaca','Tepemaxalco','Tepeojuma','Tepetzintla','Tepexco','Tepexi de Rodr&iacute;guez','Tepeyahualco','Tepeyahualco de Cuauht&eacute;moc','Tetela de Ocampo','Teteles de &aacute;vila Castillo','Teziutl&aacute;n','Tianguismanalco','Tilapa','Tlachichuca','Tlacotepec de Benito Ju&aacute;rez','Tlacuilotepec','Tlahuapan','Tlalnepantla','Tlaltenango','Tlaola','Tlapacoya','Tlapanal&aacute;','Tlatlauquitepec','Tlaxco','Tochimilco','Tochtepec','Totoltepec de Guerrero','Tulcingo','Tuzamapan de Galeana','Tzicatlacoyan','Venustiano Carranza','Vicente Guerrero','Xayacatl&aacute;n de Bravo','Xicotepec','Xicotl&aacute;n','Xiutetelco','Xochiapulco','Xochiltepec','Xochitl&aacute;n de Vicente Su&aacute;rez','Xochitl&aacute;n Todos Santos','Yaon&aacute;huac','Yehualtepec','Zacapala','Zacapoaxtla','Zacatl&aacute;n','Zapotitl&aacute;n','Zapotitl&aacute;n de M&eacute;ndez','Zaragoza','Zautla','Zihuateutla','Zinacatepec','Zongozotla','Zoquiapan','Zoquitl&aacute;n','Otro');

estados['Oaxaca'] = new Array('Abejones','Acatl&aacute;n de P&eacute;rez Figueroa','&aacute;nimas Trujano','Asunci&oacute;n Cacalotepec','Asunci&oacute;n Cuyotepeji','Asunci&oacute;n Ixtaltepec','Asunci&oacute;n Nochixtl&aacute;n','Asunci&oacute;n Ocotl&aacute;n','Asunci&oacute;n Tlacolulita','Ayoquezco de Aldama','Ayotzintepec','Calihual&aacute;','Candelaria Loxicha','Capulalpam de M&eacute;ndez','Chahuites','Chalcatongo de Hidalgo','Chiquihuitl&aacute;n de Benito Ju&aacute;rez','Ci&eacute;nega de Zimatl&aacute;n','Ciudad Ixtepec','Coatecas Altas','Coicoy&aacute;n de las Flores','Concepci&oacute;n Buenavista','Concepci&oacute;n P&aacute;palo','Constancia del Rosario','Cosolapa','Cosoltepec','Cuil&aacute;pam de Guerrero','Cuyamecalco Villa de Zaragoza','Ejutla de Crespo','El Barrio de la Soledad','El Espinal','Eloxochitl&aacute;n de Flores Mag&oacute;n','Fresnillo de Trujano','Guadalupe de Ram&iacute;rez','Guadalupe Etla','Guelatao de Ju&aacute;rez','Guevea de Humboldt','Heroica Ciudad de Tlaxiaco','Huajuapan de Le&oacute;n','Huautepec','Huautla de Jim&eacute;nez','Ixpantepec Nieves','Ixtl&aacute;n de Ju&aacute;rez','Juchit&aacute;n de Zaragoza','La Compa&ntilde;&iacute;a','La Pe','La Reforma','La Trinidad Vista Hermosa','Loma Bonita','Magdalena Apasco','Magdalena Jaltepec','Magdalena Mixtepec','Magdalena Ocotl&aacute;n','Magdalena Pe&ntilde;asco','Magdalena Teitipac','Magdalena Tequisistl&aacute;n','Magdalena Tlacotepec','Magdalena Yodocono de Porfirio D&iacute;az','Magdalena Zahuatl&aacute;n','Mariscala de Ju&aacute;rez','M&aacute;rtires de Tacubaya','Mat&iacute;as Romero','Mazatl&aacute;n Villa de Flores','Mesones Hidalgo','Miahuatl&aacute;n de Porfirio D&iacute;az','Mixistl&aacute;n de la Reforma','Monjas','Natividad','Nazareno Etla','Nejapa de Madero','Nuevo Zoquiapam','Oaxaca de Ju&aacute;rez','Ocotl&aacute;n de Morelos','Pinotepa de Don Luis','Pluma Hidalgo','Putla Villa de Guerrero','Reforma de Pineda','Reyes Etla','Rojas de Cuauht&eacute;moc','Salina Cruz','San Agust&iacute;n Amatengo','San Agust&iacute;n Atenango','San Agust&iacute;n Chayuco','San Agust&iacute;n de las Juntas','San Agust&iacute;n Etla','San Agust&iacute;n Loxicha','San Agust&iacute;n Tlacotepec','San Agust&iacute;n Yatareni','San Andr&eacute;s Cabecera Nueva','San Andr&eacute;s Dinicuiti','San Andr&eacute;s Huaxpaltepec','San Andr&eacute;s Huayapam','San Andr&eacute;s Ixtlahuaca','San Andr&eacute;s Lagunas','San Andr&eacute;s Nuxi&ntilde;o','San Andr&eacute;s Paxtl&aacute;n','San Andr&eacute;s Sinaxtla','San Andr&eacute;s Solaga','San Andr&eacute;s Teotil&aacute;lpam','San Andr&eacute;s Tepetlapa','San Andr&eacute;s Ya&aacute;','San Andr&eacute;s Zabache','San Andr&eacute;s Zautla','San Antonino Castillo Velasco','San Antonino el Alto','San Antonino Monte Verde','San Antonio Acutla','San Antonio de la Cal','San Antonio Huitepec','San Antonio Nanahuatipam','San Antonio Sinicahua','San Antonio Tepetlapa','San Baltazar Chichicapam','San Baltazar Loxicha','San Baltazar Yatzachi el Bajo','San Bartolo Coyotepec','San Bartolo Soyaltepec','San Bartolo Yautepec','San Bartolom&eacute; Ayautla','San Bartolom&eacute; Loxicha','San Bartolom&eacute; Quialana','San Bartolom&eacute; Yucua&ntilde;e','San Bartolom&eacute; Zoogocho','San Bernardo Mixtepec','San Blas Atempa','San Carlos Yautepec','San Crist&oacute;bal Amatl&aacute;n','San Crist&oacute;bal Amoltepec','San Crist&oacute;bal Lachirioag','San Crist&oacute;bal Suchixtlahuaca','San Dionisio del Mar','San Dionisio Ocotepec','San Dionisio Ocotl&aacute;n','San Esteban Atatlahuca','San Felipe Jalapa de D&iacute;az','San Felipe Tejalapam','San Felipe Usila','San Francisco Cahuac&uacute;a','San Francisco Cajonos','San Francisco Chapulapa','San Francisco Chind&uacute;a','San Francisco del Mar','San Francisco Huehuetl&aacute;n','San Francisco Ixhuat&aacute;n','San Francisco Jaltepetongo','San Francisco Lachigol&oacute;','San Francisco Logueche','San Francisco Nuxa&ntilde;o','San Francisco Ozolotepec','San Francisco Sola','San Francisco Telixtlahuaca','San Francisco Teopan','San Francisco Tlapancingo','San Gabriel Mixtepec','San Ildefonso Amatl&aacute;n','San Ildefonso Sola','San Ildefonso Villa Alta','San Jacinto Amilpas','San Jacinto Tlacotepec','San Jer&oacute;nimo Coatl&aacute;n','San Jer&oacute;nimo Silacayoapilla','San Jer&oacute;nimo Sosola','San Jer&oacute;nimo Taviche','San Jer&oacute;nimo Tecoatl','San Jer&oacute;nimo Tlacochahuaya','San Jorge Nuchita','San Jos&eacute; Ayuquila','San Jos&eacute; Chiltepec','San Jos&eacute; del Pe&ntilde;asco','San Jos&eacute; del Progreso','San Jos&eacute; Estancia Grande','San Jos&eacute; Independencia','San Jos&eacute; Lachiguir&iacute;','San Jos&eacute; Tenango','San Juan Achiutla','San Juan Atepec','San Juan Bautista Atatlahuca','San Juan Bautista Coixtlahuaca','San Juan Bautista Cuicatl&aacute;n','San Juan Bautista Guelache','San Juan Bautista Jayacatl&aacute;n','San Juan Bautista lo de Soto','San Juan Bautista Suchitepec','San Juan Bautista Tlachichilco','San Juan Bautista Tlacoatzintepec','San Juan Bautista Tuxtepec','San Juan Bautista Valle Nacional','San Juan Cacahuatepec','San Juan Chicomez&uacute;chil','San Juan Chilateca','San Juan Cieneguilla','San Juan Coatzospam','San Juan Colorado','San Juan Comaltepec','San Juan Cotzoc&oacute;n','San Juan de los Cues','San Juan del Estado','San Juan del R&iacute;o','San Juan Diuxi','San Juan Evangelista Analco','San Juan Guelav&iacute;a','San Juan Guichicovi','San Juan Ihualtepec','San Juan Juquila Mixes','San Juan Juquila Vijanos','San Juan Lachao','San Juan Lachigalla','San Juan Lajarcia','San Juan Lalana','San Juan Mazatl&aacute;n','San Juan Mixtepec Distrito 08','San Juan Mixtepec Distrito 26','San Juan Ozolotepec','San Juan Petlapa','San Juan Quiahije','San Juan Quiotepec','San Juan Sayultepec','San Juan Taba&aacute;','San Juan Tamazola','San Juan Teita','San Juan Teitipac','San Juan Tepeuxila','San Juan Teposcolula','San Juan Yae&eacute;','San Juan Yatzona','San Juan Yucuita','San Juan Yum&iacute;','San Lorenzo','San Lorenzo Albarradas','San Lorenzo Cacaotepec','San Lorenzo Cuaunecuiltitla','San Lorenzo Texmelucan','San Lorenzo Victoria','San Lucas Camotl&aacute;n','San Lucas Ojitl&aacute;n','San Lucas Quiavin&iacute;','San Lucas Zoquiapam','San Luis Amatl&aacute;n','San Marcial Ozolotepec','San Marcos Arteaga','San Mart&iacute;n de los Cansecos','San Mart&iacute;n Huamelulpam','San Mart&iacute;n Itunyoso','San Mart&iacute;n Lachil&aacute;','San Mart&iacute;n Peras','San Mart&iacute;n Tilcajete','San Mart&iacute;n Toxpalan','San Mart&iacute;n Zacatepec','San Mateo Cajonos','San Mateo del Mar','San Mateo Etlatongo','San Mateo Nejapam','San Mateo Pe&ntilde;asco','San Mateo Pi&ntilde;as','San Mateo R&iacute;o Hondo','San Mateo Sindihui','San Mateo Tlapiltepec','San Mateo Yoloxochitl&aacute;n','San Melchor Betaza','San Miguel Achiutla','San Miguel Ahuehuetitl&aacute;n','San Miguel Alo&aacute;pam','San Miguel Amatitl&aacute;n','San Miguel Amatl&aacute;n','San Miguel Chicahua','San Miguel Chimalapa','San Miguel Coatl&aacute;n','San Miguel del Puerto','San Miguel del R&iacute;o','San Miguel Ejutla','San Miguel el Grande','San Miguel Huautla','San Miguel Mixtepec','San Miguel Panixtlahuaca','San Miguel Peras','San Miguel Piedras','San Miguel Quetzaltepec','San Miguel Santa Flor','San Miguel Soyaltepec','San Miguel Suchixtepec','San Miguel Tecomatl&aacute;n','San Miguel Tenango','San Miguel Tequixtepec','San Miguel Tilquiapam','San Miguel Tlacamama','San Miguel Tlacotepec','San Miguel Tulancingo','San Miguel Yotao','San Nicol&aacute;s','San Nicol&aacute;s Hidalgo','San Pablo Coatl&aacute;n','San Pablo Cuatro Venados','San Pablo Etla','San Pablo Huitzo','San Pablo Huixtepec','San Pablo Macuiltianguis','San Pablo Tijaltepec','San Pablo Villa de Mitla','San Pablo Yaganiza','San Pedro Amuzgos','San Pedro Amuzgos','San Pedro Atoyac','San Pedro Cajonos','San Pedro Comitancillo','San Pedro Coxcaltepec C&aacute;ntaros','San Pedro el Alto','San Pedro Huamelula','San Pedro Huilotepec','San Pedro Ixcatl&aacute;n','San Pedro Ixtlahuaca','San Pedro Jaltepetongo','San Pedro Jicay&aacute;n','San Pedro Jocotipac','San Pedro Juchatengo','San Pedro M&aacute;rtir','San Pedro M&aacute;rtir Quiechapa','San Pedro M&aacute;rtir Yucuxaco','San Pedro Mixtepec - Distrito 22 -','San Pedro Mixtepec - Distrito 26 -','San Pedro Molinos','San Pedro Nopala','San Pedro Ocopetatillo','San Pedro Ocotepec','San Pedro Pochutla','San Pedro Quiatoni','San Pedro Sochiapam','San Pedro Tapanatepec','San Pedro Taviche','San Pedro Teozacoalco','San Pedro Teutila','San Pedro Tida&aacute;','San Pedro Topiltepec','San Pedro Totolapa','San Pedro y San Pablo Ayutla','San Pedro y San Pablo Teposcolula','San Pedro y San Pablo Tequixtepec','San Pedro Yaneri','San Pedro Y&oacute;lox','San Pedro Yucunama','San Raymundo Jalpan','San Sebasti&aacute;n Abasolo','San Sebasti&aacute;n Coatl&aacute;n','San Sebasti&aacute;n Ixcapa','San Sebasti&aacute;n Nicananduta','San Sebasti&aacute;n R&iacute;o Hondo','San Sebasti&aacute;n Tecomaxtlahuaca','San Sebasti&aacute;n Teitipac','San Sebasti&aacute;n Tutla','San Sim&oacute;n Almolongas','San Sim&oacute;n Zahuatl&aacute;n','San Vicente Coatl&aacute;n','San Vicente Lachix&iacute;o','San Vicente Nu&ntilde;&uacute;','Santa Ana','Santa Ana Ateixtlahuaca','Santa Ana Cuauht&eacute;moc','Santa Ana del Valle','Santa Ana Tavela','Santa Ana Tlapacoyan','Santa Ana Yareni','Santa Ana Zegache','Santa Catalina Quieri','Santa Catarina Cuixtla','Santa Catarina Ixtepeji','Santa Catarina Juquila','Santa Catarina Lachatao','Santa Catarina Loxicha','Santa Catarina Mechoac&aacute;n','Santa Catarina Minas','Santa Catarina Quian&eacute;','Santa Catarina Quioquitani','Santa Catarina Tayata','Santa Catarina Ticu&aacute;','Santa Catarina Yosonot&uacute;','Santa Catarina Zapoquila','Santa Cruz Acatepec','Santa Cruz Amilpas','Santa Cruz de Bravo','Santa Cruz Itundujia','Santa Cruz Mixtepec','Santa Cruz Nundaco','Santa Cruz Papalutla','Santa Cruz Tacache de Mina','Santa Cruz Tacahua','Santa Cruz Tayata','Santa Cruz Xitla','Santa Cruz Xoxocotl&aacute;n','Santa Cruz Zenzontepec','Santa Gertrudis','Santa In&eacute;s de Zaragoza','Santa In&eacute;s del Monte','Santa In&eacute;s Yatzeche','Santa Luc&iacute;a del Camino','Santa Luc&iacute;a Miahuatl&aacute;n','Santa Luc&iacute;a Monteverde','Santa Luc&iacute;a Ocotl&aacute;n','Santa Magdalena Jicotl&aacute;n','Santa Mar&iacute;a Alotepec','Santa Mar&iacute;a Apazco','Santa Mar&iacute;a Atzompa','Santa Mar&iacute;a Camotl&aacute;n','Santa Mar&iacute;a Chachoapam','Santa Mar&iacute;a Chilchotla','Santa Mar&iacute;a Chimalapa','Santa Mar&iacute;a Colotepec','Santa Mar&iacute;a Cortijo','Santa Mar&iacute;a Coyotepec','Santa Mar&iacute;a del Rosario','Santa Mar&iacute;a del Tule','Santa Mar&iacute;a Ecatepec','Santa Mar&iacute;a Guelac&eacute;','Santa Mar&iacute;a Guienagati','Santa Mar&iacute;a Huatulco','Santa Mar&iacute;a Huazolotitl&aacute;n','Santa Mar&iacute;a Ipalapa','Santa Mar&iacute;a Ixcatl&aacute;n','Santa Mar&iacute;a Jacatepec','Santa Mar&iacute;a Jalapa del Marqu&eacute;s','Santa Mar&iacute;a Jaltianguis','Santa Mar&iacute;a la Asunci&oacute;n','Santa Mar&iacute;a Lachix&iacute;o','Santa Mar&iacute;a Mixtequilla','Santa Mar&iacute;a Nat&iacute;vitas','Santa Mar&iacute;a Nduayaco','Santa Mar&iacute;a Ozolotepec','Santa Mar&iacute;a P&aacute;palo','Santa Mar&iacute;a Pe&ntilde;oles','Santa Mar&iacute;a Petapa','Santa Mar&iacute;a Quiegolani','Santa Mar&iacute;a Sola','Santa Mar&iacute;a Tataltepec','Santa Mar&iacute;a Tecomavaca','Santa Mar&iacute;a Temaxcalapa','Santa Mar&iacute;a Temaxcaltepec','Santa Mar&iacute;a Teopoxco','Santa Mar&iacute;a Tepantlali','Santa Mar&iacute;a Texcatitl&aacute;n','Santa Mar&iacute;a Tlahuitoltepec','Santa Mar&iacute;a Tlalixtac','Santa Mar&iacute;a Tonameca','Santa Mar&iacute;a Totolapilla','Santa Mar&iacute;a Xadani','Santa Mar&iacute;a Yalina','Santa Mar&iacute;a Yaves&iacute;a','Santa Mar&iacute;a Yolotepec','Santa Mar&iacute;a Yosoy&uacute;a','Santa Mar&iacute;a Yucuhiti','Santa Mar&iacute;a Zacatepec','Santa Mar&iacute;a Zaniza','Santa Mar&iacute;a Zoquitl&aacute;n','Santiago Amoltepec','Santiago Apoala','Santiago Ap&oacute;stol','Santiago Astata','Santiago Atitl&aacute;n','Santiago Ayuquililla','Santiago Cacaloxtepec','Santiago Camotl&aacute;n','Santiago Chazumba','Santiago Choapam','Santiago Comaltepec','Santiago del R&iacute;o','Santiago Huajolotitl&aacute;n','Santiago Huauclilla','Santiago Ihuitl&aacute;n Plumas','Santiago Ixcuintepec','Santiago Ixtayutla','Santiago Jamiltepec','Santiago Jocotepec','Santiago Juxtlahuaca','Santiago Lachiguiri','Santiago Lalopa','Santiago Laollaga','Santiago Laxopa','Santiago Llano Grande','Santiago Matatl&aacute;n','Santiago Miltepec','Santiago Minas','Santiago Nacaltepec','Santiago Nejapilla','Santiago Niltepec','Santiago Nundiche','Santiago Nuyo&oacute;','Santiago Pinotepa Nacional','Santiago Suchilquitongo','Santiago Tamazola','Santiago Tapextla','Santiago Tenango','Santiago Tepetlapa','Santiago Tetepec','Santiago Texcalcingo','Santiago Textitl&aacute;n','Santiago Tilantongo','Santiago Tillo','Santiago Tlazoyaltepec','Santiago Xanica','Santiago Xiacu&iacute;','Santiago Yaitepec','Santiago Yaveo','Santiago Yolom&eacute;catl','Santiago Yosond&uacute;a','Santiago Yucuyachi','Santiago Zacatepec','Santiago Zoochila','Santo Domingo Albarradas','Santo Domingo Armenta','Santo Domingo Chihuit&aacute;n','Santo Domingo de Morelos','Santo Domingo Ingenio','Santo Domingo Ixcatl&aacute;n','Santo Domingo Nuxa&aacute;','Santo Domingo Ozolotepec','Santo Domingo Petapa','Santo Domingo Roayaga','Santo Domingo Tehuantepec','Santo Domingo Teojomulco','Santo Domingo Tepuxtepec','Santo Domingo Tlatayapam','Santo Domingo Tomaltepec','Santo Domingo Tonal&aacute;','Santo Domingo Tonaltepec','Santo Domingo Xagac&iacute;a','Santo Domingo Yanhuitl&aacute;n','Santo Domingo Yodohino','Santo Domingo Zanatepec','Santo Tom&aacute;s Jalieza','Santo Tom&aacute;s Mazaltepec','Santo Tom&aacute;s Ocotepec','Santo Tom&aacute;s Tamazulapan','Santos Reyes Nopala','Santos Reyes P&aacute;palo','Santos Reyes Tepejillo','Santos Reyes Yucun&aacute;','Silacayoapam','Sitio de Xitlapehua','Soledad Etla','Tamazulapam del Esp&iacute;ritu Santo','Tanetze de Zaragoza','Taniche','Tataltepec de Vald&eacute;s','Teococuilco de Marcos P&eacute;rez','Teotitl&aacute;n de Flores Mag&oacute;n','Teotitl&aacute;n del Valle','Teotongo','Tepelmeme Villa de Morelos','Tezoatl&aacute;n de Segura y Luna','Tlacolula de Matamoros','Tlacotepec Plumas','Tlalixtac de Cabrera','Totontepec Villa de Morelos','Trinidad Zaachila','Uni&oacute;n Hidalgo','Valerio Trujano','Villa de Chilapa de D&iacute;az','Villa de Etla','Villa de Tamazulapam del Progreso','Villa de Tututepec de Melchor Ocampo','Villa de Zaachila','Villa D&iacute;az Ordaz','Villa Hidalgo','Villa Sola de Vega','Villa Talea de Castro','Villa Tejupam de la Uni&oacute;n','Yaxe','Yogana','Yutanduchi de Guerrero','Zapotitl&aacute;n del R&iacute;o','Zapotitl&aacute;n Lagunas','Zapotitl&aacute;n Palmas','Zimatl&aacute;n de Alvarez','Otro');

estados['Nuevo Le&oacute;n'] = new Array('Abasolo','Agualeguas','Allende','An&aacute;huac','Apodaca','Aramberri','Bustamante','Cadereyta Jim&eacute;nez','Carmen','Cerralvo','China','Ci&eacute;nega de Flores','Doctor Arroyo','Doctor Coss','Doctor Gonz&aacute;lez','Galeana','Garc&iacute;a','General Bravo','General Escobedo','General Ter&aacute;n','General Trevi&ntilde;o','General Zaragoza','General Zuazua','Guadalupe','Hidalgo','Higueras','Hualahuises','Iturbide','Ju&aacute;rez','Lampazos de Naranjo','Linares','Los Aldamas','Los Herreras','Los Ramones','Mar&iacute;n','Melchor Ocampo','Mier y Noriega','Mina','Montemorelos','Monterrey','Par&aacute;s','Pesquer&iacute;a','Rayones','Sabinas Hidalgo','Salinas Victoria','San Nicol&aacute;s de los Garza','San Pedro Garza Garc&iacute;a','Santa Catarina','Santiago','Vallecillo','Villaldama','Otro');

estados['Nayarit'] = new Array('Acaponeta','Ahuacatl&aacute;n','Amatl&aacute;n de Ca&ntilde;as','Bah&iacute;a de Banderas','Compostela','Del Nayar','Huajicori','Ixtl&aacute;n del R&iacute;o','Jala','La Yesca','Rosamorada','Ruiz','San Blas','San Pedro Lagunillas','Santa Mar&iacute;a del Oro','Santiago Ixcuintla','Tecuala','Tepic','Tuxpan','Xalisco','Otro');

estados['Morelos'] = new Array('Amacuzac','Atlatlahucan','Axoyiapan','Ayala','Coatl&aacute;n del Rio','Cuatla','Cuernavaca','Emiliano Zapata','Huitzilac','Jantetelco','Jiutepec','Jojutla','Jonacatepec','Mazatepec','Miacatl&aacute;n','Ocuituco','Puente de Ixtla','Temixco','Temoac','Tepalcingo','Tepoztl&aacute;n','Tetecala','Tetela del Volc&aacute;n','Tlalnepantla','Tlaltizap&aacute;n','Tlaquiltenango','Tlayacapan','Totolapan','Xochitepec','Yautepec','Yecapixtla','Zacatepec de Hidalgo','Zacualpan de Amilpas','Otro');

estados['Michoac&aacute;n'] = new Array('Acuitzio','Aguililla','&aacute;lvaro Obreg&oacute;n','Angamacutiro','Angangueo','Apatzing&aacute;n','Aporo','Aquila','Ario','Arteaga','Brise&ntilde;as','Buenavista','C&aacute;racuaro','Chaparan','Charo','Chavinda','Cher&aacute;n','Chilchota','Chinicuila','Chirintzio','Chuc&aacute;ndiro','Churumuco','Coahuayana','Coalcom&aacute;n de V&aacute;zquez Pallares','Coeneo','Cojumatl&aacute;n de R&eacute;gules','Contepec','Cop&aacute;ndaro','Cotija','Cuitzeo','Ecuandureo','Epitacio Huerta','Erongar&iacute;cuaro','Gabriel Zamora','Hidalgo','Huandacareo','Huaniqueo','Huetamo','Huiramba','Indaparapeo','Irimbo','Ixtl&aacute;n','Jacona','Jim&eacute;nez','Jiquilpan','Jos&eacute; Sixto Verduzco','Ju&aacute;rez','Jungapeo','La Huacana','La Piedad','Lagunillas','L&aacute;zaro C&aacute;rdenas','Los Reyes','Madero','Maravat&iacute;o','Marcos Castellanos','Morelia','Morelos','M&uacute;gica','Nahuatzen','Nocup&eacute;taro','Nuevo Parangaricutiro','Nuevo Urecho','Numar&aacute;n','Ocampo','Pajacuar&aacute;n','Panind&iacute;cuaro','Paracho','Par&aacute;cuaro','P&aacute;tzcuaro','Penjamillo','Perib&aacute;n','Pur&eacute;pero','Puru&aacute;ndiro','Quer&eacute;ndaro','Quiroga','Salvador Escalante','San Lucas','Santa Ana Maya','Senguio','Suahuayo','Susupuato','Tac&aacute;mbaro','Tanc&iacute;taro','Tangamandapio','Tanganc&iacute;cuaro','Tanhuato','Taretan','Tar&iacute;mbaro','Tepalcatepec','Tingambato','Ting¸ind&iacute;n','Tiquicheo de Nicol&aacute;s Romero','Tlalpujahua','Tlazazalca','Tocumbo','Tumbiscat&iacute;o','Turicato','Tuxpan','Tuzantla','Tzintzuntzan','Tzitzio','Uruapan','Venustiano Carranza','Villamar','Vista Hermosa','Yur&eacute;cuaro','Zacapu','Zamora','Zin&aacute;paro','Zinap&eacute;cuaro','Ziracuaretiro','Zit&aacute;cuaro','Otro');

estados['Estado de M&eacute;xico'] = new Array('Acambay','Acolman','Aculco','Almoloya de Alquisiras','Almoloya de Ju&aacute;rez','Almoloya del R&iacute;o','Amanalco','Amatepec','Amemeca','Apaxco','Atenco','Atizap&aacute;n','Atizap&aacute;n de Zaragoza','Atlacomulco','Atlautla','Axapusco','Ayapango','Calimaya','Capulhuac','Chalco','Chapa de Mota','Chapultepec','Chiautla','Chicoloapan','Chiconcuac','Chimalhuac&aacute;n','Coacalco de Berrioz&aacute;bal','Coatepec Harinas','Cocotitl&aacute;n','Coyotepec','Cuautitl&aacute;n','Cuautitl&aacute;n Izcalli','Donato Guerra','Ecatepec de Morelos','Ecatzingo','El Oro','Huehuetoca','Hueypoxtla','Huixquilucan','Isidro Fabela','Ixtapaluca','Ixtapan de la Sal','Ixtapan del Oro','Ixtlahuaca','Jaltenco','Jilotepec','Jilotzingo','Jiquipilco','Jocotitl&aacute;n','Joquicingo','Juchitepec','La Paz','Lerma','Luvianos','Malinalco','Melchor Ocampo','Metepec','Mexicaltzingo','Morelos','Naucalpan de Ju&aacute;rez','Nextlalpan','Nezahualc&oacute;yotl','Nicol&aacute;s Romero','Nopaltepec','Ocoyoacac','Ocuilan','Otumba','Otzoloapan','Otzolotepec','Ozumba','Papalotla','Polotitl&aacute;n','Ray&oacute;n','San Antonio la Isla','San Felipe del Progreso','San Jos&eacute; del Rinc&oacute;n','San Mart&iacute;n de las Pir&aacute;mides','San Mateo Atenco','San Sim&oacute;n de Guerrero','Santo Tom&aacute;s','Soyaniquilpan de Ju&aacute;rez','Sultepec','Tec&aacute;mac','Tejupilco','Temamatla','Temascalapa','Temascalcingo','Temascaltepec','Temoaya','Tenancingo','Tenango del Aire','Tenango del Valle','Teoloyucan','Teotihuac&aacute;n','Tepetlaoxtoc','Tepetlixpa','Tepotzotl&aacute;n','Tequixquiac','Texcaltitl&aacute;n','Texcalyacac','Texcoco','Tezoyuca','Tianguistenco','Timilpan','Tlalmanalco','Tlalnepantla de Baz','Tlatlaya','Toluca','Tonanitla','Tonatico','Tultepec','Tultitl&aacute;n','Valle de Bravo','Valle de Chalco Solidaridad','Villa de Allende','Villa del Carb&oacute;n','Villa Guerrero','Villa Victoria','Xalatlaco','Xonacatl&aacute;n','Zacazonapan','Zacualpan','Zinacantepec','Zumpahuac&aacute;n','Zumpango','Otro');

estados['Jalisco'] = new Array('Guadalajara','Tlajomulco de Z&uacute;&ntilde;iga','Tlaquepaque','Tonal&aacute;','Zapopan','Acatic','Acatl&aacute;n de Ju&aacute;rez','Ahualulco de Mercado','Amacueca','Amatit&aacute;n','Ameca','Arandas','Atemajac de Brizuela','Atengo','Atenguillo','Atotonilco el Alto','Atoyac','Autl&aacute;n de Navarro','Ayotl&aacute;n','Ayutla','Bola&ntilde;os','Cabo Corrientes','Ca&ntilde;adas de Obreg&oacute;n','Capilla de Guadalupe','Casimiro Castillo','Chapala','Chimaltit&aacute;n','Chiquilistl&aacute;n','Cihuatl&aacute;n','Cocula','Colotl&aacute;n','Concepci&oacute;n de Buenos Aires','Cuautitl&aacute;n de Garc&iacute;a Barrag&aacute;n','Cuautla','Cuqu&iacute;o','Degollado','Ejutla','El Arenal','El Grullo','El Lim&oacute;n','El Salto','Encarnaci&oacute;n de D&iacute;az','Etzatl&aacute;n','G&oacute;mez Far&iacute;as','Guachinango','Hostotipaquillo','Huej&uacute;car','Huejuquilla el Alto','Ixtlahuac&aacute;n de los Membrillos','Ixtlahuac&aacute;n del R&iacute;o','Jalostotitl&aacute;n','Jamay','Jes&uacute;s Mar&iacute;a','Jilotl&aacute;n de los Dolores','Jocotepec','Juanacatl&aacute;n','Juchitl&aacute;n','La Barca','La Huerta','La Manzanilla de la Paz','Lagos de Moreno','Magdalena','Mascota','Mazamitla','Mexticac&aacute;n','Mezquitic','Mixtl&aacute;n','Ocotl&aacute;n','Ojuelos de Jalisco','Pihuamo','Poncitl&aacute;n','Puerto Vallarta','Quitupan','San Crist&oacute;bal de la Barranca','San Diego de Alejandr&iacute;a','San Gabriel','San Ignacio Cerro Gordo','San Juan de los Lagos','San Juanito de Escobedo','San Juli&aacute;n','San Marcos','San Mart&iacute;n de Bola&ntilde;os','San Mart&iacute;n de Hidalgo','San Miguel el Alto','San Sebasti&aacute;n del Oeste','Santa Mar&iacute;a de los &aacute;ngeles','Santa Mar&iacute;a del Oro','Sayula','Tala','Talpa de Allende','Tamazula de Gordiano','Tapalpa','Tecalitl&aacute;n','Techaluta de Montenegro','Tecolotl&aacute;n','Tenamaxtl&aacute;n','Teocaltiche','Teocuitatl&aacute;n de Corona','Tepatitl&aacute;n de Morelos','Tequila','Teuchitl&aacute;n','Tizap&aacute;n el Alto','Tolim&aacute;n','Tomatl&aacute;n','Tonaya','Tonila','Totatiche','Tototl&aacute;n','Tuxcacuesco','Tuxcueca','Tuxpan','Uni&oacute;n de San Antonio','Uni&oacute;n de Tula','Valle de Guadalupe','Valle de Ju&aacute;rez','Villa Corona','Villa Guerrero','Villa Hidalgo','Villa Purificaci&oacute;n','Yahualica de Gonz&aacute;lez Gallo','Zacoalco de Torres','Zapotiltic','Zapotitl&aacute;n de Vadillo','Zapotl&aacute;n del Rey','Zapotl&aacute;n El Grande','Zapotlanejo','Otro');

estados['Hidalgo'] = new Array('Acatl&aacute;n','Acaxochitl&aacute;n','Actopan','Agua Blanca de Iturbide','Ajacuba','Alfajayucan','Almoloya','Apan','Atitalaquia','Atlapexco','Atotonilco de Tula','Atotonilco el Grande','Calnali','Cardonal','Chapantongo','Chapulhuac&aacute;n','Chilcuautla','Cuautepec de Hinojosa','El Arenal','Eloxochitl&aacute;n','Emiliano Zapata','Epazoyucan','Francisco I. Madero','Huasca de Ocampo','Huautla','Huazalingo','Huehuetla','Huejutla de Reyes','Huichapan','Ixmiquilpan','Jacala de Ledezma','Jaltoc&aacute;n','Ju&aacute;rez Hidalgo','La Misi&oacute;n','Lolotla','Metepec','Metztitl&aacute;n','Mineral de la Reforma','Mineral del Chico','Mineral del Monte','Mixquiahuala de Ju&aacute;rez','Molango de Escamilla','Nicol&aacute;s Flores','Nopala de Villagr&aacute;n','Omitl&aacute;n de Ju&aacute;rez','Pachuca de Soto','Pacula','Pisaflores','Progreso de Obreg&oacute;n','San Agust&iacute;n Metzquititl&aacute;n','San Agust&iacute;n Tlaxiaca','San Bartolo Tutotepec','San Felipe Orizatl&aacute;n','San Salvador','Santiago de Anaya','Santiago Tulantepec de Lugo Guerrero','Singuilucan','Tasquillo','Tecozautla','Tenango de Doria','Tepeapulco','Tepehuac&aacute;n de Guerrero','Tepeji del R&iacute;o de Ocampo','Tepetitl&aacute;n','Tetepango','Tezontepec de Aldama','Tianguistengo','Tizayuca','Tlahuelilpan','Tlahuiltepa','Tlanalapa','Tlanchinol','Tlaxcoapan','Tolcayuca','Tula de Allende','Tulancingo de Bravo','Villa de Tezontepec','Xochiatipan','Xochicoatl&aacute;n','Yahualica','Zacualtip&aacute;n de Angeles','Zapotl&aacute;n de Ju&aacute;rez','Zempoala','Zimap&aacute;n','Otro');

estados['Guerrero'] = new Array('Acapulco de Ju&aacute;rez','Acatepec','Ahuacuotzingo','Ajuchitl&aacute;n del Progreso','Alcozauca de Guerrero','Alpoyeca','Apaxtla','Arcelia','Atenango del R&iacute;o','Atlamajalcingo del Monte','Atlixtac','Atoyac de &aacute;lvarez','Ayutla de los Libres','Azoy&uacute;','Benito Ju&aacute;rez','Buenavista de Cu&eacute;llar','Chilapa de &aacute;lvarez','Chilpancingo de los Bravo','Coahuayutla de Jos&eacute; Mar&iacute;a Izazaga','Cochoapa el Grande','Cocula','Copala','Copalillo','Copanatoyac','Coyuca de Ben&iacute;tez','Coyuca de Catal&aacute;n','Cuajinicuilapa','Cual&aacute;c','Cuautepec','Cuetzala del Progreso','Cutzamala de Pinz&oacute;n','Eduardo Neri','Florencio Villarreal','General Canuto A. Neri','General Heliodoro Castillo','Huamuxtitl&aacute;n','Huitzuco de los Figueroa','Iguala de la Independencia','Igualapa','Iliatenco','Ixcateopan de Cuauht&eacute;moc','Jos&eacute; Azueta','Jos&eacute; Joaqu&iacute;n Herrera','Juan R. Escudero','Juchit&aacute;n','La Uni&oacute;n de Isidoro Montes de Oca','Leonardo Bravo','Malinaltepec','Marquelia','M&aacute;rtir de Cuilapan','Metlat&oacute;noc','Mochitl&aacute;n','Olinal&aacute;','Ometepec','Pedro Ascencio Alquisiras','Petatl&aacute;n','Pilcaya','Pungarabato','Quechultenango','San Luis Acatl&aacute;n','San Marcos','San Miguel Totolapan','Taxco de Alarc&oacute;n','Tecoanapa','T&eacute;cpan de Galeana','Teloloapan','Tepecoacuilco de Trujano','Tetipac','Tixtla de Guerrero','Tlacoachistlahuaca','Tlacoapa','Tlalchapa','Tlalixtaquilla de Maldonado','Tlapa de Comonfort','Tlapehuala','Xalpatl&aacute;huac','Xochihuehuetl&aacute;n','Xochistlahuaca','Zapotitl&aacute;n Tablas','Zir&aacute;ndaro','Zitlala','Otro');

estados['Guanajuato'] = new Array('Abasolo','Ac&aacute;mbaro','Allende','Apaseo el Alto','Apaseo el Grande','Atarjea','Celaya','Comonfort','Coroneo','Cortazar','Cuer&aacute;maro','Doctor Mora','Dolores Hidalgo','Guanajuato','Huan&iacute;maro','Irapuato','Jaral del Progreso','Jer&eacute;cuaro','Le&oacute;n','Manuel Doblado','Morole&oacute;n','Ocampo','P&eacute;njamo','Pueblo Nuevo','Pur&iacute;sima del Rinc&oacute;n','Romita','Salamanca','Salvatierra','San Diego de la Uni&oacute;n','San Felipe','San Francisco del Rinc&oacute;n','San Jos&eacute; Iturbide','San Luis de la Paz','Santa Catarina','Santa Cruz de Juventino Rosas','Santiago Maravat&iacute;o','Silao','Tarandacuao','Tarimoro','Tierra Blanca','Uriangato','Valle de Santiago','Victoria','Villagr&aacute;n','Xich&uacute;','Yuriria','Otro');

estados['Durango'] = new Array('Canatl&aacute;n','Canelas','Coneto de Comonfort','Cuencam&eacute;','Durango','El Oro','General Sim&oacute;n Bol&iacute;var','G&oacute;mez Palacio','Guadalupe Victoria','Guanacev&iacute;','Hidalgo','Ind&eacute;','Lerdo','Mapim&iacute;','Mezquital','Nazas','Nombre de Dios','Nuevo Ideal','Ocampo','Ot&aacute;ez','P&aacute;nuco de Coronado','Pe&ntilde;&oacute;n Blanco','Poanas','Pueblo Nuevo','Rodeo','San Bernardo','San Dimas','San Juan de Guadalupe','San Juan del R&iacute;o','San Luis del Cordero','San Pedro del Gallo','Santa Clara','Santiago Papasquiaro','S&uacute;chil','Tamazula','Tepehuanes','Tlahualilo','Topia','Vicente Guerrero','Otro');

estados['Colima'] = new Array('Armer&iacute;a','Colima','Comala','Coquimatl&aacute;n','Cuauht&eacute;moc','Ixtlahuac&aacute;n','Manzanillo','Minatitl&aacute;n','Tecom&aacute;n','Villa de &aacute;lvarez','Otro');

estados['Coahuila'] = new Array('Abasolo','Acu&ntilde;a','Allende','Arteaga','Candela','Casta&ntilde;os','Cuatroci&eacute;negas','Escobedo','Francisco I. Madero','Frontera','General Cepeda','Guerrero','Hidalgo','Jim&eacute;nez','Ju&aacute;rez','Lamadrid','Matamoros','Monclova','Morelos','M&uacute;zquiz','Nadadores','Nava','Ocampo','Parras','Piedras Negras','Progreso','Ramos Arizpe','Sabinas','Sacramento','Saltillo','San Buenaventura','San Juan de Sabinas','San Pedro','Sierra Mojada','Torre&oacute;n','Viesca','Villa Uni&oacute;n','Zaragoza','Otro');

estados['Chihuahua'] = new Array('Ahumada','Aldama','Allende','Aquiles Serd&aacute;n','Ascensi&oacute;n','Bach&iacute;niva','Balleza','Batopilas','Bocoyna','Buenaventura','Camargo','Carich&iacute;','Casas Grandes','Chihuahua','Ch&iacute;nipas','Coronado','Coyame del Sotol','Cuauht&eacute;moc','Cusihuiriachi','Delicias','Dr. Belisario Dom&iacute;nguez','El Tule','Galeana','G&oacute;mez Far&iacute;as','Gran Morelos','Guachochi','Guadalupe','Guadalupe y Calvo','Guazapares','Guerrero','Hidalgo del Parral','Huejotit&aacute;n','Ignacio Zaragoza','Janos','Jim&eacute;nez','Ju&aacute;rez','Julimes','La Cruz','L&oacute;pez','Madera','Maguarichi','Manuel Benavides','Matach&iacute;','Matamoros','Meoqui','Morelos','Moris','Namiquipa','Nonoava','Nuevo Casas Grandes','Ocampo','Ojinaga','Pr&aacute;xedis G. Guerrero','Riva Palacio','Rosales','Rosario','San Francisco de Borja','San Francisco de Conchos','San Francisco del Oro','Santa B&aacute;rbara','Santa Isabel','Satev&oacute;','Saucillo','Tem&oacute;sachi','Urique','Uruachi','Valle de Zaragoza','Otro');

estados['Chiapas'] = new Array('Acacoyagua','Acala','Acapetahua','Aldama','Altamirano','Amat&aacute;n','Amatenango de la Frontera','Amatenango del Valle','&aacute;ngel Albino Corzo','Arriaga','Bejucal de Ocampo','Bella Vista','Benem&eacute;rito de las Am&eacute;ricas','Berrioz&aacute;bal','Bochil','Cacahoat&aacute;n','Capainal&aacute;','Catazaj&aacute;','Chalchihuit&aacute;n','Chamula','Chanal','Chapultenango','Chenalh&oacute;','Chiapa de Corzo','Chiapilla','Chicoas&eacute;n','Chicomuselo','Chil&oacute;n','Cintalapa','Coapilla','Comit&aacute;n de Dom&iacute;nguez','El Bosque','El Porvenir','Escuintla','Francisco Le&oacute;n','Frontera Comalapa','Frontera Hidalgo','Huehuet&aacute;n','Huitiup&aacute;n','Huixt&aacute;n','Huixtla','Ixhuat&aacute;n','Ixtacomit&aacute;n','Ixtapa','Ixtapangajoya','Jiquipilas','Jitotol','Ju&aacute;rez','La Concordia','La Grandeza','La Independencia','La Libertad','La Trinataria','Larr&aacute;inzar','Las Margaritas','Las Rosas','Mapastepec','Maravilla Tenejapa','Marqu&eacute;s de Comillas','Mazapa de Madero','Mazat&aacute;n','Metapa','Mitontic','Montecristo de Guerrero','Motozintla','Nicol&aacute;s Ruiz','Ocosingo','Ocotepec','Ocozocoautla de Espinosa','Ostuac&aacute;n','Osumacinta','Oxchuc','Palenque','Pantelh&oacute;','Pantepec','Pichucalco','Pijijiapan','Pueblo Nuevo Solistahuac&aacute;n','Ray&oacute;n','Reforma','Sabanilla','Salto de Agua','San Andr&eacute;s Duraznal','San Crist&oacute;bal de las Casas','San Fernando','San Juan Cancuc','San Lucas','Santiago el Pinar','Siltepec','Simojovel','Sital&aacute;','Socoltenango','Solosuchiapa','Soyal&oacute;','Suanuapa','Suchiapa','Suchiate','Tapachula','Tapalapa','Tapilula','Tecpat&aacute;n','Tenejapa','Teopisca','Tila','Tonal&aacute;','Totolapa','Tumbal&aacute;','Tuxtla Chico','Tuxtla Guti&eacute;rrez','Tuzant&aacute;n','Tzimol','Uni&oacute;n Ju&aacute;rez','Venustiano Carranza','Villa Comaltitl&aacute;n','Villa Corzo','Villaflores','Yajal&oacute;n','Zinacant&aacute;n','Otro');

estados['Campeche'] = new Array('Calakmul','Calkin&iacute;','Campeche','Candelaria','Carmen','Champot&oacute;n','Esc&aacute;rcega','Hecelchak&aacute;n','Hopelch&eacute;n','Palizada','Tenabo','Otro');

estados['Baja California Sur'] = new Array ('Comond&uacute;','La Paz','Loreto','Los Cabos','Muleg&eacute;','Otro');

estados['Baja California'] = new Array ('Ensenada','Mexicali','Tecate','Tijuana','Playas de Rosarito','Otro');

estados['Aguascalientes'] = new Array('Aguascalientes','Asientos','Calvillo','Cos&iacute;o','El Llano','Jes&uacute;s Mar&iacute;a','Pabell&oacute;n de Arteaga','Rinc&oacute;n de Romos','San Francisco de los Romo','San Jos&eacute; de Gracia','Tepezal&aacute;','Otro');

estados['Distrito Federal'] = new Array('Distrito Federal','Otro');

listaEstados = new Array('Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila','Colima','Distrito Federal','Durango','Guanajuato','Guerrero','Hidalgo','Jalisco','Estado de M&eacute;xico','Michoac&aacute;n','Morelos','Nayarit','Nuevo Le&oacute;n','Oaxaca','Puebla','Quer&eacute;taro','Quintana Roo','San Luis Potos&iacute;','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz','Yucat&aacute;n','Zacatecas','Otro');

function cargarEstados(elemento) {
	sel = document.getElementById(elemento);
	totalEstados = listaEstados.length;
	opcion = document.createElement("OPTION");
	opcion.innerHTML = '';
	opcion.value = ''; 	
	sel.appendChild(opcion);
	for(i=0;i<totalEstados;i++) {
		opcion = document.createElement("OPTION");
		opcion.innerHTML = listaEstados[i];
		opcion.value = listaEstados[i]; 	
		sel.appendChild(opcion);
	}
}

function ObtenerUnidadesMedicas(estado,elemento)
{
    estado=quitarAcentosUmf(estado);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4)
        {
            document.getElementById(elemento).innerHTML=ponerAcentos(xml.responseText);
        }
        if(xml.readyState==2)
        {
            document.getElementById(elemento).innerHTML="<img src=\"diseno/loading.gif\">";
        }
    };
    xml.open("GET", "../ObtenerUMF.php?estado="+estado, true);
    xml.send();
    
}

function cargarMunicipios(estado,elemento) {
	sel = document.getElementById(elemento);
	total = sel.options.length - 1;
	for(j=total;j>=0;j--) {
		sel.options[j] = null;
	}

	totalMunicipios = estados[estado].length;
	opcion = document.createElement("OPTION");
	opcion.innerHTML = '';
	opcion.value = ''; 	
	sel.appendChild(opcion);
	for(i=0;i<totalMunicipios;i++) {
		opcion = document.createElement("OPTION");
		opcion.innerHTML = estados[estado][i];
		opcion.value = estados[estado][i]; 	
		sel.appendChild(opcion);
	}
    ObtenerUnidadesMedicas(estado,'Unidad');
}

function quitarAcentos(Text)  
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
				case "&aacute;": cadena += "(/a)";
				j = j + 7;
				break;
				case "&Aacute;": cadena += "(/A)";
				j = j + 7;
				break;
				case "&eacute;": cadena += "(/e)";
				j = j + 7;
				break;
				case "&Eacute;": cadena += "(/E)";
				j = j + 7;
				break;
				case "&iacute;": cadena += "(/i)";
				j = j + 7;
				break;
				case "&iacute;": cadena += "(/I)";
				j = j + 7;
				break;
				case "&oacute;": cadena += "(/o)";
				j = j + 7;
				break;
				case "&Oacute;": cadena += "(/O)";
				j = j + 7;
				break;
				case "&uacute;": cadena += "(/u)";
				j = j + 7;
				break;
				case "&uacute;": cadena += "(/U)";
				j = j + 7;
				break;
				case "&ntilde;": cadena += "(/n)";
				j = j + 7;
				break;
				case "&Ntilde;": cadena += "(/N)";
				j = j + 7;
				break;
				default:  
				cadena+=Text.charAt(j);  
				break;  
			}
		} else {
			switch(Char)  
			{  
				case 225: cadena+="(/a)";  
				break;  
				case 233: cadena+="(/e)";  
				break;  
				case 237: cadena+="(/i)";  
				break;  
				case 243: cadena+="(/o)";  
				break;  
				case 250: cadena+="(/u)";  
				break;  
				case 193: cadena+="(/A)";  
				break;  
				case 201: cadena+="(/E)";  
				break;  
				case 205: cadena+="(/I)";  
				break;  
				case 211: cadena+="(/O)";  
				break;  
				case 218: cadena+="(/U)";  
				break;  
				case 241: cadena+="(/n)";  
				break;  
				case 209: cadena+="(/N)";  
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

function ponerAcentos(Text) {
	var cadena=""; 
	var temp = "";
	var total = Text.length;
	for (var j = 0; j < total; j++)  
	{  
		var cara=Text.charAt(j);
		if (cara == "(") {
			temp = Text.substring(j,j+4);
			switch (temp) {
				case "(/a)": cadena += "&aacute;";
				j = j + 3;
				break;
				case "(/A)": cadena += "&Aacute;";
				j = j + 3;
				break;
				case "(/e)": cadena += "&eacute;";
				j = j + 3;
				break;
				case "(/E)": cadena += "&Eacute;";
				j = j + 3;
				break;
				case "(/i)": cadena += "&iacute;";
				j = j + 3;
				break;
				case "(/I)": cadena += "&Iacute;";
				j = j + 3;
				break;
				case "(/o)": cadena += "&oacute;";
				j = j + 3;
				break;
				case "(/O)": cadena += "&Oacute;";
				j = j + 3;
				break;
				case "(/u)": cadena += "&uacute;";
				j = j + 3;
				break;
				case "(/U)": cadena += "&Uacute;";
				j = j + 3;
				break;
				case "(/n)": cadena += "&ntilde;";
				j = j + 3;
				break;
				case "(/N)": cadena += "&Ntilde;";
				j = j + 3;
				break;
				default:  
				cadena+=Text.charAt(j);  
				break;  
			}
		} else {
			cadena+=Text.charAt(j);  
		}
	}  
	return cadena;
}

function ConstructorXMLHttpRequest()  
{ 
	if(window.XMLHttpRequest) /*Vemos si el objeto window(la base de la ventana del navegador) posee el m&eacute;todo XMLHttpRequest(Navegadores como Mozilla y Safari). */  
	{ 
		return new XMLHttpRequest(); //Si lo tiene, crearemos el objeto con este m&eacute;todo. 
	} 
	else if(window.ActiveXObject) /*Sino ten&iacute;a el m&eacute;todo anterior, deber&iacute;a ser el Internet Exp. un navegador que emplea objetos ActiveX, lo mismo, miramos si tiene el m&eacute;todo de creaci&oacute;n. */ 
	{ 
	
		var request = false;
		try {
		  request = new XMLHttpRequest();
		} catch (trymicrosoft) {
		  try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		  } catch (othermicrosoft) {
			try {
			  request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
			  request = false;
			}
		  }
		}
		return request;
	} 
	/* Si el navegador llego aqu&iacute; es porque no posee manera alguna de crear el objeto, emitimos un mensaje de error. */ 
	throw new Error("No se pudo crear el objeto XMLHttpRequest"); 
} 


/* El objetivo de este fichero es crear la clase objetoAjax (en Javascript a las ìclasesî se les llama ìprototiposî) */ 
function objetoAjax( )  
{ 
/*Primero necesitamos un objeto XMLHttpRequest que cogeremos del constructor para que sea compatible con la mayor&iacute;a de navegadores posible. */ 
	this.objetoRequest = new ConstructorXMLHttpRequest();  
} 
 
function peticionAsincrona(url,parametros,tipoPeticion) //Funci&oacute;n asignada al m&eacute;todo coger del objetoAjax. 
{ 
 /*Copiamos el objeto actual, si usamos this dentro de la funci&oacute;n que asignemos a  onreadystatechange, no funcionara.*/ 
 var objetoActual = this;  
 this.objetoRequest.open('POST', url, tipoPeticion); //Preparamos la conexi&oacute;n. 
 /*Aqu&iacute; no solo le asignamos el nombre de la funci&oacute;n, sino la funci&oacute;n completa, as&iacute; cada vez que se cree un nuevo objetoAjax se asignara una nueva funci&oacute;n. */ 
 this.objetoRequest.onreadystatechange =  
  function()  
  { 
   switch(objetoActual.objetoRequest.readyState)  
   { 
    case 1: //Funci&oacute;n que se llama cuando se est&aacute; cargando. 
    objetoActual.cargando(); 
    break; 
    case 2: //Funci&oacute;n que se llama cuando se a cargado. 
    objetoActual.cargado(); 
    break; 
    case 3: //Funci&oacute;n que se llama cuando se est&aacute; en interactivo. 
    objetoActual.interactivo(); 
    break; 
    case 4:  
                                                         /*Funci&oacute;n que se llama cuando se completo la transmisi&oacute;n, se le 
env&iacute;an 4  
                                                         par&aacute;metros.*/ 
    objetoActual.completado(objetoActual.objetoRequest.status,  
                            objetoActual.objetoRequest.statusText, 
                            objetoActual.objetoRequest.responseText,  
                              objetoActual.objetoRequest.responseXML); 
    break; 
   } 
  } 
 this.objetoRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
 this.objetoRequest.send(parametros); //Iniciamos la transmisi&oacute;n de datos. 
} 
/*Las siguientes funciones las dejo en blanco ya que las redefiniremos seg&uacute;n nuestra necesidad  
haci&eacute;ndolas muy sencillas o complejas dentro de la p&aacute;gina o omitiendolas sino son necesarias.*/ 
function objetoRequestCargando() {} 
function objetoRequestCargado() {} 
function objetoRequestInteractivo() {} 
function objetoRequestCompletado(estado, estadoTexto, respuestaTexto, respuestaXML) {} 
 
/* Por &uacute;ltimo diremos que las funciones que hemos creado, pertenecen al ObjetoAJAX,  con prototype,  
de esta manera todos los objetoAjax que se creen, lo har&aacute;n conteniendo estas funciones en ellos*/ 
 
//Definimos la funci&oacute;n de recoger informaci&oacute;n. 
objetoAjax.prototype.coger = peticionAsincrona ; 
//Definimos una serie de funciones que ser&iacute;a posible utilizar y las dejamos en blanco en esta clase. 
objetoAjax.prototype.cargando = objetoRequestCargando ; 
objetoAjax.prototype.cargado = objetoRequestCargado ; 
objetoAjax.prototype.interactivo = objetoRequestInteractivo ; 
objetoAjax.prototype.completado = objetoRequestCompletado ; 


function AjaxGET()
{
	if(window.XMLHttpRequest) /*Vemos si el objeto window(la base de la ventana del navegador) posee el m&eacute;todo XMLHttpRequest(Navegadores como Mozilla y Safari). */  
	{ 
		return new XMLHttpRequest(); //Si lo tiene, crearemos el objeto con este m&eacute;todo. 
	} 
	else if(window.ActiveXObject) /*Sino ten&iacute;a el m&eacute;todo anterior, deber&iacute;a ser el Internet Exp. un navegador que emplea objetos ActiveX, lo mismo, miramos si tiene el m&eacute;todo de creaci&oacute;n. */ 
	{ 
	
		var request = false;
		try {
		  request = new XMLHttpRequest();
		} catch (trymicrosoft) {
		  try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		  } catch (othermicrosoft) {
			try {
			  request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
			  request = false;
			}
		  }
		}
		return request;
	} 
	/* Si el navegador llego aqu&iacute; es porque no posee manera alguna de crear el objeto, emitimos un mensaje de error. */ 
	throw new Error("No se pudo crear el objeto XMLHttpRequest"); 
}

var cursores=new Array("auto","hand","crosshair","default","pointer","move","e-resize","ne-resize","nw-resize","n-resize","se-resize","sw-resize","s-resize","w-resize","text","wait");
function setCursor() {
	document.body.style.cursor = 'hand'
}
function restoreCursor() {
	document.body.style.cursor = 'default'
}

function inicio(liga) {
	var contenedor = document.getElementById('contenido');
	var seleccion= new AjaxGET();
	seleccion.open("GET", liga,true);
	seleccion.onreadystatechange=function()
	{
		if (seleccion.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			document.getElementById('contenido').innerHTML = '';
			contenedor.innerHTML = seleccion.responseText;
		}
		if ((seleccion.readyState==1) ||(seleccion.readyState==2)||(seleccion.readyState==3))
		{
			contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	seleccion.send(null)
	mostrarDiv('menu');
//	hayCitasArep();
//	listaCitasArep();
//	hayCitasRezagadas();
//	listaCitasRezagadas();
}

function capturarRec() {
	var contenedor2;
	contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "agregarReceta.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
			cargarEstados('estado');
			cargarEstados('estadoAgregar');
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}

function mostrarDiv(nombre) {
	capa = eval('document.getElementById("' + nombre + '").style');
//	div = document.getElementById(nombre);
	capa.display ='';
}

function ocultarDiv(nombre) {
	capa = eval('document.getElementById("' + nombre + '").style');
//	div = document.getElementById(nombre);
	capa.display='none';
}

function validarCedula(val) {
	out = "";
	if (val.length != 10) out = 'La cedula debe ser de 10 caracteres';
	else {
		l1 = val.charAt(0);
		l2 = val.charAt(1);
		l3 = val.charAt(2);
		l4 = val.charAt(3);
		ano = val.charAt(4) + val.charAt(5);
		mes = val.charAt(6) + val.charAt(7);
		dia = val.charAt(8) + val.charAt(9);
		if(!esConsonante(l1)) out = 'El primer caracter de la cedula debe ser una consonante.\n';
		else if (!esVocal(l2))  out = 'El segundo caracter de la cedula debe ser una vocal.\n';
		else if(!esConsonante(l3)) out = 'El tercer caracter de la cedula debe ser una consonante.\n';
		else if(!esConsonante(l4)) out = 'El cuarto caracter de la cedula debe ser una consonante.\n';
		else if(!esFechaValida(dia+"/"+mes+"/19"+ano)) out = 'La fecha de la cedula es invalida.\n';
	}
	return out;
}

function buscarDH(cedula) {
//	cedulaCorrecta = validarCedula(cedula);
	if (cedula.length > 3) {
		var contenedor;
		contenedor = document.getElementById('derechohabientes');
		var objeto= new AjaxGET();
		objeto.open("GET", "buscarDHparaAlta.php?cedula="+cedula,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = objeto.responseText;
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	} else {
		alert('Debe teclear al menos 4 caracteres');
	}
}

function buscarDHN(ap_p, ap_m, nombre) {
	if ((ap_p.length > 0) || (ap_m.length > 0) || (nombre.length > 0)) {
		var contenedor;
		contenedor = document.getElementById('derechohabientes2');
		var objeto= new AjaxGET();
		objeto.open("GET", "buscarDHNparaAlta.php?ap_p="+ap_p+"&ap_m="+ap_m+"&nombre="+nombre,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = objeto.responseText;
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	} else {
		alert('Debe ingresar al menos un campo de busqueda (apellido paterno, apellido materno o nombre)');
	}
}

function buscarDHbusqueda(cedula) {
	if (cedula.length > 3) {
		var contenedor;
		contenedor = document.getElementById('derechohabientes');
		var objeto= new AjaxGET();
		objeto.open("GET", "buscarDHparaBusqueda.php?cedula="+cedula,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = objeto.responseText;
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	} else {
		alert('Debe teclear al menos 4 caracteres');
	}
}

function buscarDHNbusqueda(ap_p, ap_m, nombre) {
	if ((ap_p.length > 0) || (ap_m.length > 0) || (nombre.length > 0)) {
		var contenedor;
		contenedor = document.getElementById('derechohabientes2');
		var objeto= new AjaxGET();
		objeto.open("GET", "buscarDHNparaBusqueda.php?ap_p="+ap_p+"&ap_m="+ap_m+"&nombre="+nombre,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = objeto.responseText;
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	} else {
		alert('Debe ingresar al menos un campo de busqueda (apellido paterno, apellido materno o nombre)');
	}
}

function cargarDatosDH () {
	if (!document.getElementById('dh')) {
		alert( "Ingrese la cedula del derechohabiente y haga click en Buscar..." )	;
	} else {
		valor = document.getElementById('dh').options[document.getElementById('dh').selectedIndex].value;
		valor = ponerAcentos(valor);
		if (valor == -1) {
			alert('No existe derechohabiente con la cedula introducida');
		} else {
			aValor = valor.split('|');
			document.getElementById('id_derecho').value = aValor[0];
			document.getElementById('cedula').value = aValor[1]+'/'+aValor[2];
			document.getElementById('ap_p').value = aValor[3];
			document.getElementById('ap_m').value = aValor[4];
			document.getElementById('nombre').value = aValor[5];
			document.getElementById('cedulaBuscar').value = '';
			document.getElementById('derechohabientes').innerHTML = 'Ingrese la cedula del derechohabiente y haga click en Buscar...';
			ocultarDiv('buscar');
			document.getElementById('agregar').disabled = '';			
		}
	}
}

function validarAplicarDosis(id_receta, id_ingreso) {
	error = true;
	dosis1 = "";
	if(document.getElementById('dosis')) {
		dosis1 = document.getElementById('dosis').value;
		dosis1 =dosis1.replace(" ","");
		if (dosis1.length > 0) {
			if(isNaN(dosis1)) {
				error = true;
			} else {
				error = false;
			}
		} else {
			error = true;
		}
	}
	if (error) {
		alert('Debes introducir la dosis a aplicar');
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var objeto= new AjaxGET();
		objeto.open("GET", "aplicarDosisConfirmar.php?id_receta=" + id_receta + "&dosis=" + dosis1 + "&id_ingreso=" + id_ingreso,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				datosDosis = objeto.responseText;
				alert(datosDosis);
				if (datosDosis == "Dosis Aplicada Correctamente") {
					inicio('inicio.php');
				}
			}
		}
		objeto.send(null)
	}
}

function validarReutilizarMedicamento(id_receta, id_ingreso) {
	error = true;
	dosis1 = "";
	if(document.getElementById('dosis')) {
		dosis1 = document.getElementById('dosis').value;
		dosis1 =dosis1.replace(" ","");
		if (dosis1.length > 0) {
			if(isNaN(dosis1)) {
				error = true;
			} else {
				error = false;
			}
		} else {
			error = true;
		}
	}
	if (error) {
		alert('Debes introducir la dosis a aplicar');
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var objeto= new AjaxGET();
		objeto.open("GET", "reutilizarMedicamentoConfirmar.php?id_receta=" + id_receta + "&dosis=" + dosis1 + "&id_ingreso=" + id_ingreso,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				datosDosis = objeto.responseText;
				alert(datosDosis);
				if (datosDosis == "Dosis Aplicada Correctamente") {
					inicio('inicio.php');
				}
			}
		}
		objeto.send(null)
	}
}

function validarBajaMedicamento(id_receta, id_ingreso) {
	if (confirm('Realmente deseas dar de baja el medicamento del sistema ?')) {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var objeto= new AjaxGET();
		objeto.open("GET", "bajaMedicamentoConfirmar.php?id_receta=" + id_receta + "&id_ingreso=" + id_ingreso,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				datosDosis = objeto.responseText;
				alert(datosDosis);
				if (datosDosis == "Baja de Medicamento Realizada Correctamente") {
					inicio('inicio.php');
				}
			}
		}
		objeto.send(null)
	}
}

function validarBajaMedicamentoCaduco(id_receta, id_ingreso) {
	if (confirm('Realmente deseas dar de baja el medicamento del sistema ?')) {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var objeto= new AjaxGET();
		objeto.open("GET", "bajaMedicamentoCaducoConfirmar.php?id_receta=" + id_receta + "&id_ingreso=" + id_ingreso,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				datosDosis = objeto.responseText;
				alert(datosDosis);
				if (datosDosis == "Baja de Medicamento Realizada Correctamente") {
					inicio('inicio.php');
				}
			}
		}
		objeto.send(null)
	}
}

function validarAltaPaciente(id_piso, id_cama) {
	var estado = document.getElementById('estado').value;
	var fecha = document.getElementById('fecha').value;
	var servicio = document.getElementById('servicio').value;
	var medico = document.getElementById('medico').value;
	var id_derecho = document.getElementById('id_derecho').value;
	var cedula = document.getElementById('cedula').value;
	var ap_p = document.getElementById('ap_p').value;
	var ap_m = document.getElementById('ap_m').value;
	var nombre = document.getElementById('nombre').value;
	var alergias = document.getElementById('alergias').value;
	var grupo_sanguineo = document.getElementById('grupo_sanguineo').value;
	var diagnostico = document.getElementById('diagnostico_alta').value;
	var error = "";
	if (estado.length < 1) error += "Selecciona Procedencia\n\r"
	if (!esFechaValida(fecha)) error += "La fecha de ingreso debe ser con formato dd/mm/aaaa\n\r"
	if (servicio < 1) error += "Selecciona un Servicio\n\r"
	if (medico < 1) error += "Selecciona un Medico\n\r"
	if (diagnostico == "") error += "Selecciona un Diagnóstico\n\r"
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		if ((id_derecho.length > 0) && (cedula.length > 0) && (ap_p.length > 0) && (ap_m.length > 0) && (nombre.length > 0)) {
			var contenedor;
			contenedor = document.getElementById('contenido');
			var contenedor2;
			contenedor2 = document.getElementById('enviando');
			var objeto= new AjaxGET();
			objeto.open("GET", quitarAcentos("altaPacienteConfirmar.php?id_piso="+id_piso+"&id_cama="+id_cama+"&estado=" + estado + "&fecha=" + fecha + "&servicio=" + servicio + "&medico=" + medico + "&id_derecho="+id_derecho+"&alergias="+alergias+"&grupo_sanguineo="+grupo_sanguineo+"&diagnostico="+diagnostico),true);
			objeto.onreadystatechange=function()
			{
				if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
				{
					contenedor2.innerHTML = "&nbsp;";
					document.getElementById('agregar').disabled = '';
					document.getElementById('regresar').disabled = '';
					document.getElementById('seleccionar').disabled = '';

					if (canvasData != '') {
						var ajax = new XMLHttpRequest();
						ajax.open("POST",'subirFoto.php',false);
						ajax.setRequestHeader('Content-Type', 'application/upload');
						ajax.send(id_derecho+'.'+canvasData );
					}

					altaPacienteHecha(objeto.responseText,id_piso, id_cama);
				}
				if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
				{
					document.getElementById('agregar').disabled = 'disabled';
					document.getElementById('regresar').disabled = 'disabled';
					document.getElementById('seleccionar').disabled = 'disabled';
					contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
				}
			}
			objeto.send(null)
		} else {
			alert('Cedula y nombre completo es requerido');
		}
	}
}

function validarBajaPaciente(id_piso, id_cama) {
	var fecha = document.getElementById('fecha').value;
	var tipo = document.getElementById('tipo').value;
	var observaciones = document.getElementById('observaciones').value;
	var error = "";
	if (!esFechaValida(fecha)) error += "La fecha de salida debe ser con formato dd/mm/aaaa\n\r"
	if (tipo == "0") error += "Seleccione el tipo de salida\n\r"
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var contenedor2;
		contenedor2 = document.getElementById('enviando');
		var objeto= new AjaxGET();
		objeto.open("GET", quitarAcentos("bajaPacienteConfirmar.php?id_piso="+id_piso+"&id_cama="+id_cama+"&fecha="+fecha+"&observaciones="+observaciones+"&tipo="+tipo),true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor2.innerHTML = "&nbsp;";
				document.getElementById('agregar').disabled = '';
				document.getElementById('regresar').disabled = '';
				bajaPacienteHecha(objeto.responseText,id_piso, id_cama);
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				document.getElementById('agregar').disabled = 'disabled';
				document.getElementById('regresar').disabled = 'disabled';
				contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function altaPacienteHecha(respuesta,id_piso, id_cama) {
		if (respuesta == "Paciente Ingresado Correctamente") {
			imprimirBrazalete(id_piso, id_cama);
			alert(respuesta);
			infoPiso(id_piso);
		} else {
			alert(respuesta);
		}
}

function bajaPacienteHecha(respuesta,id_piso, id_cama) {
		alert(respuesta);
		if (respuesta == "Salida del Paciente Realizada Correctamente") {
			infoPiso(id_piso);
		}
}

function esHoraValida(val,nm) {
	errors = "";
	a = val.charAt(0);
	b = val.charAt(1);
	c = val.charAt(2);
	d = val.charAt(3);
	e = val.charAt(4);
	if (val.length != 5) errors += '- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (isNaN(a)) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (isNaN(b)) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (c != ':') errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (isNaN(d)) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (isNaN(e)) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if ((a==2 && b>3) || (a>2)) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	else if (d>5) errors+='- '+nm+' debe contener una hora valida. ej 08:30\n';
	return errors;
}

function DetectaBloqueoPops()
{
  var popup
  try
  {
    //Se crea una nueva ventana para probar si esta o no activo
    // el bloqueador de ventanas emergentes.
    //Si esta activo, se lanza el error, de lo contrario sÛlo se cierra la ventana creada
    if(!(popup = window.open('about:blank','_blank','width=1,height=1')))
      throw "ErrPop"
    msj = "La ventana se creÛ con Èxito"
    popup.close()
  }
  catch(err)
  {
    //Se captura el error, si fue por motivo de bloqueo, se muestra el mensaje de advertencia
    //Si no fue por bloque, entonces se muestra la descripciÛn del error ocurrido.
    if(err=="ErrPop")
      msj = "tA T E N C I ” Nnn°El bloqueo de popups esta activo!"
    else
    {
      msj="Hubo un erro en la p·gina.nn"
      msj+="DescripciÛn del error: " + err.description + "nn"
     }
  }
  alert(msj)
 
}

function citaExtemporaneaAgregada(datosCita) {
	aRespuesta = datosCita.split('|');
	tRespuesta = aRespuesta.length;
	window.open('imprimirCitaExtemporanea.php?id_consultorio='+aRespuesta[0]+'&id_servicio='+aRespuesta[1]+'&id_derecho='+aRespuesta[2]+'&fecha_cita='+aRespuesta[3]+'&id_usuario='+aRespuesta[4]+'&fecha_inicio='+aRespuesta[5]+'&fecha_fin='+aRespuesta[6],'_blank');
	alert('Cita Agregada Extemporanea Correctamente\n\r');
	selDia(aRespuesta[3], aRespuesta[3]);
}

function agregarDHenCita() {
	var cedula = document.getElementById('cedulaBuscar').value;
//	document.getElementById('buscar').style.height = "0px;";
	ocultarDiv('buscar'); 
	mostrarDiv('divAgregarDH');
	document.getElementById('divBotones_EstadoAgregarDH').innerHTML = '<input name="botonCancelarAgregarDH" type="button" class="botones" id="botonCancelarAgregarDH" onclick="javascript: cancelarAgregarDHenCita();" value="Cancelar" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="botonAgregarDH" type="submit" class="botones" id="botonAgregarDH" value="Agregar" />';
	document.getElementById('divAgregarDH').style.height = "180px";
	document.getElementById('cedulaAgregar').value = cedula;
	document.getElementById('cedulaTipoAgregar').focus();
}

function cancelarAgregarDHenCita() {
	document.getElementById('cedulaAgregar').value = "";	
	document.getElementById('cedulaTipoAgregar').value = "";	
	document.getElementById('ap_pAgregar').value = "";	
	document.getElementById('ap_mAgregar').value = "";	
	document.getElementById('nombreAgregar').value = "";	
	document.getElementById('telefonoAgregar').value = "";	
	document.getElementById('direccionAgregar').value = "";	
	document.getElementById('estadoAgregar').value = "";	
	document.getElementById('municipioAgregar').value = "";	
	ocultarDiv('divAgregarDH');
}

function agregarDHenCitaForma() {
    var patronTel=/^[0-9]{2,3}[0-9]{7,8}$/;
    var patronCed=/^[A-Z][AEIOU][A-Z]{2}[0-9]{2}[0][0-9]|[1][0-2][0-2][0-9]|[3][0-1]$/;
    var patronFecha=/^[0-2][0-9]|[3][0-1]\/[0][9]|[1][0-2]\/[0-9][0-9][0-9][0-9]$/;
    var patronCodigoPostal=/^[0-9]{5}$/;
    var patronNombre=/^\d+$/
    var cedula=patronCed.test($("#cedulaAgregar").val());
    var telefono=patronTel.test($("#telefonoAgregar").val());
    var fecha=patronFecha.test($("#fecha_nacAgregar").val());
    var cp=patronCodigoPostal.test($("#cp").val());
    var ced=$("#cedulaAgregar").val();
    ind=document.getElementById('sexo').selectedIndex;
    var sexo=document.getElementById('sexo').options[ind].value;
    ind=document.getElementById('cedulaTipoAgregar').selectedIndex;
    var tpoCed=document.getElementById('cedulaTipoAgregar').options[ind].value;
    var app=quitarAcentos($("#ap_pAgregar").val());
    var apm=quitarAcentos($("#ap_mAgregar").val());
    var nom=quitarAcentos($("#nombreAgregar").val());
    var tel=$("#telefonoAgregar").val();
    var fecNac=$("#dia1").val()+"/"+$("#mes1").val()+"/"+$("#anio1").val();
    var dir=$("#direccionAgregar").val();
    var col=$("#col").val();
    var cp1=$("#cp").val();
    var curp=$("#curpAgregar").val();
    var email=$("#emailAgregar").val();
    var cel=$("#cel").val();
    if (document.getElementById('municipioAgregar').selectedIndex == "undefined") {
    	alert("selecciona un municipio");
    	return false;
    }
    if (document.getElementById('Unidad').selectedIndex == "undefined") {
    	alert("selecciona una unidad");
    	return false;
    }
    ind=document.getElementById('estadoAgregar').selectedIndex;
    var edo=document.getElementById('estadoAgregar').options[ind].value;
    ind=document.getElementById('municipioAgregar').selectedIndex;
    var mun=document.getElementById('municipioAgregar').options[ind].value;
    ind=document.getElementById('Unidad').selectedIndex;
    var um=document.getElementById('Unidad').options[ind].value;
    var cont=true;
    if(um=="-1")
    {
        alert("Clinica de procedencia del derechohabiente");
        cont=false;
    }
	if(tpoCed==60 || tpoCed==61 || tpoCed==50 || tpoCed==51 || tpoCed==80 || tpoCed==81 || tpoCed==70 || tpoCed==71)
    {
        fechaNac=validarFechaCedula(ced, fecNac, tpoCed);
        if(!fechaNac)
            return;
    }
    if(tpoCed=="10"||tpoCed=="20"||tpoCed=="90")
    {
        cedulaTrab=validarCedulaTrabajador($("#cedulaAgregar").val(),nom,app,apm,fecNac);
        if(!cedulaTrab)
            return;
    }
    if(!cedula || $("#cedulaAgregar").val()=="")
    {
        if($("#cedulaAgregar").val()=="")
            alert("introduzca la cedula del derechoHabiente");
        else
            alert("Introduzca una cedula correcta");
        $("#cedulaAgregar").val("");
        cont=false;
    }
    else
    if(validarCedula(document.getElementById('cedulaAgregar').value)!=""){
        alert(validarCedula(document.getElementById('cedulaAgregar').value));
        $("#cedulaAgregar").val("");
        cont=false;
    }
    else
    if(($("#ap_pAgregar").val()=="" || patronNombre.test(app))|| $("#ap_pAgregar").val()=="Apellido Paterno") 
    {
        alert("introduzca el apellido Paterno");
        cont=false;
    }
    if(($("#ap_mAgregar").val()=="" || patronNombre.test(apm))|| $("#ap_pAgregar").val()=="Apellido Materno" ) 
    {
        alert("introduzca el apellido Materno");
        cont=false;
    }
    else
    if(($("#nombreAgregar").val()=="" || patronNombre.test(nom))|| $("#nombreAgregar").val()=="Apellido Materno" ) 
    {
        alert("introduzca el nombre del DerechoHabiente");
        cont=false;
    } else if($("#telefonoAgregar").val()==""|| !telefono){
        if($("#telefonoAgregar").val()=="")
            alert("introduzca un numero de telefono");
        else
            alert("Introduzca el numero de telefono con formato 01(lada)numero \n o (lada)telefono \n de 8 a 10 digitos");
        cont=false;
    }else if($("#direccionAgregar").val()=="" || $("#col").val()==""||($("#cp").val()=="" || !cp)){
        alert("introduzca la direccion del DerechoHabiente");
        cont=false;
    }else if($("#estadoAgregar option:selected").val()==""){
        alert("elija el estado de procedencia del DerechoHabiente");
        cont=false;
    }else if($("#municipioAgregar option:selected").val()==""){
        alert("elija el municipio de procedencia del DerechoHabiente");
        cont=false;
    }else{
        if($("#curpAgregar").val() == ""){
            alert("Introduzca la curp");
            cont=false;
        }

        if($("#emailAgregar").val()!=""){
            Pemail = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            if(!Pemail.test($("#emailAgregar").val()))
            {
                alert("Introduzca el correo Electronico alguien@dominio.com");
                cont=false;
            }
                
        }
        if($("#cel").val()!="")
        {
            PCel=/[0-9]{10}/;
            if(!PCel.test($("#cel").val()))
            {
                alert("El Numero de celular tiene que ser numerico y de 10 digitos \n ejemplo 3310000100");
                cont=false;
            }
        }
        if(cont){
            var contenedor = document.getElementById('divBotones_EstadoAgregarDH');
            var objeto= new AjaxGET();
			//cadena = quitarAcentos("agregarDHenCita.php?cedula=" + cedula + "&cedula_tipo=" + tpoCed + "&ap_p="+app+"&ap_m="+ap_m+"&nombre="+nombre+"&fecha_nac="+edad+"&telefono="+telefono+"&direccion="+direccion+"&estado="+estado+"&municipio="+municipio);
            cadena = quitarAcentos("agregarDHenCita.php?cedulaAgregar="+ced+"&cedulaTipoAgregar="+tpoCed+"&ap_pAgregar="+app+"&ap_mAgregar="+apm+"&nombreAgregar="+nom+"&fecha_nacAgregar="+fecNac+"&direccionAgregar="+dir+"&telefonoAgregar="+tel+"&estadoAgregar="+edo+"&municipioAgregar="+mun+"&cel="+cel+"&cp="+cp1+"&col="+col+"&Unidad="+um+"&curp="+curp+"&emailAgregar="+email+"&sexo="+sexo);
            objeto.open("GET",cadena ,true);
            objeto.onreadystatechange=function()
            {
                if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
                {
                    if (objeto.responseText > 0) {
                        alert("Derechohabiente Agregado Correctamente");
                        document.getElementById('id_derecho').value = objeto.responseText;
                        document.getElementById('cedula').value = ced+'/'+tpoCed;
                        document.getElementById('ap_p').value = app;
                        document.getElementById('ap_m').value = apm;
                        document.getElementById('nombre').value = nom;
                        document.getElementById('fecha_nac').value = fecNac;
                        document.getElementById('telefono').value = tel;
                        document.getElementById('direccion').value = dir;
                        document.getElementById('col1').value = col;
                        document.getElementById('cp1').value = cp1;
                        document.getElementById('curpCita').value = curp;
                        document.getElementById('emailCita').value = email;
                        document.getElementById('cel1').value = cel;
                        document.getElementById('estado').value = edo;
                        cargarMunicipios(edo,'municipio','UnidadCita');
                        document.getElementById('municipio').value = mun;
                        document.getElementById('UnidadCita').value=um;
                        document.getElementById('observaciones').disabled = '';
                        document.getElementById('observaciones').focus();
                        document.getElementById('modificar').disabled = '';
                        document.getElementById('agregar').disabled = '';
                    } else {
                        alert("Error al agregar derechohabiente, pongase en contacto con el administrador del sistema");
                    }
                    ocultarDiv('divAgregarDH');
                    contenedor.innerHTML = '<input name="botonCancelarAgregarDH" type="button" class="botones" id="botonCancelarAgregarDH" onclick="javascript: cancelarAgregarDHenCita();" value="Cancelar" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="botonAgregarDH" type="submit" class="botones" id="botonAgregarDH" value="Agregar" />';
                }
                if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
                {
                    contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
                }
            }
            objeto.send(null)
        }
    }
}



function esFechaValida(fecha){
	if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha)){
		return false;
	}
	var dia  =  parseInt(fecha.substring(0,2),10);
	var mes  =  parseInt(fecha.substring(3,5),10);
	var anio =  parseInt(fecha.substring(6),10);
 
    switch(mes){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            numDias=30;
            break;
        case 2:
            numDias=29;
            break;
        default:
            return false;
    }
 
        if (dia>numDias || dia==0){
            return false;
        }
        return true;
}

function esConsonante(valor) {
	var conso = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','&ntilde;','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	tConso = conso.length;
	seEncontro = false;
	for(i=0;i<tConso;i++)
		if (conso[i] == valor.toUpperCase()) seEncontro = true;
	return seEncontro;
}

function esVocal(valor) {
	var vocal = new Array('A','E','I','O','U');
	tVocal = vocal.length;
	seEncontro = false;
	for(i=0;i<tVocal;i++)
		if (vocal[i] == valor.toUpperCase()) seEncontro = true;
	return seEncontro;
}


// ------------- VARIABLES Y REDEFINICION DE FUNCIONES ---------------

var PeticionAjax01 = new objetoAjax(); //Definimos un nuevo objetoAjax. 
PeticionAjax01.cargando = requestCargando; //Funci&oacute;n completado del objetoAjax redefinida. 
PeticionAjax01.completado = objetoRequestCompletado01; //Funci&oacute;n completado del objetoAjax redefinida. 

var fresh = new objetoAjax(); //Definimos un nuevo objetoAjax. 
fresh.completado = freshCompletado; //Funci&oacute;n completado del objetoAjax redefinida. 
fresh.cargando = freshcargando; //Funci&oacute;n completado del objetoAjax redefinida. 


// ------------- FUNCIONES COMPLETADO  -------------------
function freshCompletado(estado, estadoTexto, respuestaTexto, respuestaXML) 
{
	document.getElementById('variables').innerHTML = respuestaTexto;
} 

// ------------ FUNCIONES CARGANDO  -----------------------
function requestCargando() {
	document.getElementById('estado').innerHTML = "<img src=\"diseno/loading.gif\">";
}
function freshcargando() {
	document.getElementById('variables').innerHTML = "cargando...";
}



function objetoRequestCompletado01(estado, estadoTexto, respuestaTexto, respuestaXML) 
{
	aRespuesta = respuestaTexto.split('|');
	tRespuesta = aRespuesta.length;
	if (aRespuesta[0] == 1) {  // cuando usuario es correcto
		switch (aRespuesta[2]) {
			case '0':
				alert(aRespuesta[3]);
				location.replace('admin/index.php');
				break;
			case '1':
			case '2':
			case '3':
			case '5':
			case '8':
			case '9':
				document.getElementById('nombre_usuario').innerHTML = aRespuesta[1];
				inicio(aRespuesta[3]);
				break;
			case '4':
				alert(aRespuesta[3]);
				location.replace('admin/index.php');
				break;
		}
		
	} else {
		document.getElementById('estado').innerHTML = aRespuesta[3] // cuando usuario no es correcto
	}
} 




function hacerLogin() {
//	document.getElementById('ingresar')focus();
	PeticionAjax01.coger('loginAcceder.php','usuario='+document.getElementById('usuario').value+'&pass='+document.getElementById('pass').value,true)
}


function refrescarVariables() {
	fresh.coger('variables.php','',true)
}  

function verificarLogin() {   
  	var usuario = document.getElementById('usuario').value;
	var pass = document.getElementById('pass').value;
	var correcto = true;
  	if (usuario.length < 6) { alert('Introduce un Nombre de Usuario Correcto'); correcto = false; }
  	if ((pass.length < 6) && (correcto == true)) { alert('Introduce una Contrase&ntilde;a Correcta'); correcto = false; }
	if (correcto == true) hacerLogin();
}   
   
function obtenerLogin() {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "login.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		    $("#usuario").focus();

		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
	
}

function buscarPor() {
	if (document.getElementById('tipo_busqueda').value == 'nombre') {
		ocultarDiv('buscarPorCedula');
		mostrarDiv('buscarPorNombre');
	} else {
		ocultarDiv('buscarPorNombre');
		mostrarDiv('buscarPorCedula');
	}
}

function reportes() {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "reportes.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}

function reportesCargar(liga) {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", liga,true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		}
		if (agenda.readyState==2)
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}

function validarReporte(liga){
	var fechaI = document.getElementById('date1');
	var fechaF = document.getElementById('date2');
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
		window.open(liga+"?fechaI="+fechaIn+"&fechaF="+fechaFi+"&tipoReporte="+tipoReporte+"&piso="+piso,'_blank');
	}
	return false;
}

function logout() {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "logout.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
//			contenedor2.innerHTML = agenda.responseText;
			document.getElementById('menu').style.display = "none";
			obtenerLogin();
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}
function ayuda() {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "ayuda.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}

function buscar() {
	var contenedor2 = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "buscar.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
		}
	}
	agenda.send(null)
}


var meses=new Array();
meses[1]="Ene";
meses[2]="Feb";
meses[3]="Mar";
meses[4]="Abr";
meses[5]="May";
meses[6]="Jun";
meses[7]="Jul";
meses[8]="Ago";
meses[9]="Sep";
meses[10]="Oct";
meses[11]="Nov";
meses[12]="Dic";
var dias=new Array();
dias[1]="Lun";
dias[2]="Mar";
dias[3]="Mie";
dias[4]="Jue";
dias[5]="Vie";
dias[6]="Sab";
dias[0]="Dom";

fecha = new Date();
var year;
if(fecha.getFullYear){
year = fecha.getFullYear();
}else{
year = fecha.getYear()+1900;}
var month= fecha.getMonth()+1;
var fname='';
//CONVERSION DEL CALENDARIO ARREGLOS MULTIDIMENSIONALES
var tabla_i=new Array();
var tabla_ishift=new Array();

//VALORES MATICES EN A—OS DE CENTURIAS
//COLUMNA 1 FILA 0 VAL 6
tabla_i[00]=6;
tabla_i[06]=6;
tabla_i[17]=6;
tabla_i[23]=6;
tabla_i[28]=6;
tabla_i[34]=6;
tabla_i[45]=6;
tabla_i[51]=6;
tabla_i[56]=6;
tabla_i[62]=6;
tabla_i[73]=6;
tabla_i[79]=6;
tabla_i[84]=6;
tabla_i[90]=6;
//COLUMNA 2 FILA 0 VAL 0
tabla_i[01]=0;
tabla_i[07]=0;
tabla_i[12]=0;
tabla_i[18]=0;
tabla_i[29]=0;
tabla_i[35]=0;
tabla_i[40]=0;
tabla_i[46]=0;
tabla_i[57]=0;
tabla_i[63]=0;
tabla_i[68]=0;
tabla_i[74]=0;
tabla_i[85]=0;
tabla_i[91]=0;
tabla_i[96]=0;
//COLUMNA 3 FILA 0 VAL 1
tabla_i[02]=1;
tabla_i[13]=1;
tabla_i[19]=1;
tabla_i[24]=1;
tabla_i[30]=1;
tabla_i[41]=1;
tabla_i[47]=1;
tabla_i[52]=1;
tabla_i[58]=1;
tabla_i[69]=1;
tabla_i[75]=1;
tabla_i[80]=1;
tabla_i[86]=1;
tabla_i[97]=1;
//COLUMNA 4 FILA 0 VAL 2
tabla_i[03]=2;
tabla_i[08]=2;
tabla_i[14]=2;
tabla_i[25]=2;
tabla_i[31]=2;
tabla_i[36]=2;
tabla_i[42]=2;
tabla_i[53]=2;
tabla_i[59]=2;
tabla_i[64]=2;
tabla_i[70]=2;
tabla_i[81]=2;
tabla_i[87]=2;
tabla_i[92]=2;
tabla_i[98]=2;
//COLUMNA 5 FILA 0 VAL 3
tabla_i[09]=3;
tabla_i[15]=3;
tabla_i[20]=3;
tabla_i[26]=3;
tabla_i[37]=3;
tabla_i[43]=3;
tabla_i[48]=3;
tabla_i[54]=3;
tabla_i[65]=3;
tabla_i[71]=3;
tabla_i[76]=3;
tabla_i[82]=3;
tabla_i[93]=3;
tabla_i[99]=3;
//COLUMNA 6 FILA 0 VAL 4
tabla_i[04]=4;
tabla_i[10]=4;
tabla_i[21]=4;
tabla_i[27]=4;
tabla_i[32]=4;
tabla_i[38]=4;
tabla_i[49]=4;
tabla_i[55]=4;
tabla_i[60]=4;
tabla_i[66]=4;
tabla_i[77]=4;
tabla_i[83]=4;
tabla_i[88]=4;
tabla_i[94]=4;
//COLUMNA 7 FILA 0 VAL 5
tabla_i[05]=5;
tabla_i[11]=5;
tabla_i[16]=5;
tabla_i[22]=5;
tabla_i[33]=5;
tabla_i[39]=5;
tabla_i[44]=5;
tabla_i[50]=5;
tabla_i[61]=5;
tabla_i[67]=5;
tabla_i[72]=5;
tabla_i[78]=5;
tabla_i[89]=5;
tabla_i[95]=5;

//DESPLAZAMIENTOS DE LA TABLA 1 PARA LOS RESULTADOS (EN CENTURIAS)
//0 es que no hay desplazamiento ej: si corresponde un 5 para que de 6 hay que:
//(5+D) Mod 7 = 6, D=6
//hasta la centuria 21 est· bien, m·s habrÌa que calcularlas. AÒos mayores al 2199 no est·n contemplados.
tabla_ishift[00]=0;
tabla_ishift[01]=6;
tabla_ishift[02]=5;
tabla_ishift[03]=4;
tabla_ishift[04]=3;
tabla_ishift[05]=2;
tabla_ishift[06]=1;
tabla_ishift[07]=0;
tabla_ishift[08]=6;
tabla_ishift[09]=5;
tabla_ishift[10]=4;
tabla_ishift[11]=3;
tabla_ishift[12]=2;
tabla_ishift[13]=1;
tabla_ishift[14]=0;
tabla_ishift[15]=4;
tabla_ishift[16]=2;
tabla_ishift[17]=0;
tabla_ishift[18]=5;
tabla_ishift[19]=3; //Realmente solo deberÌamos poner desde aquÌ (1900)
tabla_ishift[20]=2;
tabla_ishift[21]=6;

var theStatus = new Object();
//FUNCIONES DE CALENDARIO
//STEP I (paso uno)
function step_i(Year){
var Century=Math.floor(Year/100);
var Decade=Year-(Century*100);
var TABLA_I=tabla_i[Decade];
return ((TABLA_I+tabla_ishift[Century]) % 7);
}
//STEP II (paso dos)
function step_ii(Year,Month){
var step1=step_i(Year);
var CATEGORIA;
var b=bisiesto(Year);

	switch (Month){
		case 1: //ENERO
			if(b){CATEGORIA=6;}
			else{CATEGORIA=0;}
		break;
		case 2: //FEBRERO
			if(b){CATEGORIA=2;}
			else{CATEGORIA=3;}
		break;
//		case 3: //MARZO
//			CATEGORIA=3;
//		break;
		case 4: //ABRIL
		case 7: //JULIO		
			CATEGORIA=6;
		break;
		case 5: //MAYO
			CATEGORIA=1;
		break;
		case 6: //JUNIO
			CATEGORIA=4;
		break;
		case 8: //AGOSTO
			CATEGORIA=2;
		break;
		case 10: //OCTUBRE
			CATEGORIA=0;
		break;
//		case 11: //NOVIEMBRE
//			CATEGORIA=3;
//		break;
		case 12: //DICIEMBRE
		case 9: //SEPTIEMBRE
			CATEGORIA=5;
		break;
		default: //OPTIMIZACION, LAS QUE SON MAS MAR. NOV.
			CATEGORIA=3;
		
	}
return ((CATEGORIA+step1) % 7);
}
//STEP III (paso 3)
function step_iii(Year,Month,Day){
var step2=step_ii(Year,Month);
Day=(Day % 7);
return step3=((Day+5+step2) % 7);
}

function bisiesto(Year){
var b=false;
if((Year % 4)==0){b=true;}
if((Year % 100)==0){b=false;}
if((Year % 400)==0){b=true;}
return b;
}

function daysOfMonth(Month,Year){
switch (Month){
case 4:
case 6:
case 9:
case 11:
	return 30;
	break;
case 2:
	if (bisiesto(Year)){return 29;}else{return 28;}
	break;
default:
	return 31;
	
}
}

//FUNCIONES PARA DIBUJAR Y LIMPIAR EL CALENDARIO
//LIMPIA CALENDARIO
function doHide(id,formname,fieldname){
layer = document.getElementById(id);
layer.innerHTML='';
}
//DIBUJAR CALENDARIO
function doShow(id,formname,fieldname){
if (year>2100){year=2100;}
if (year<1900){year=1900;}
if (month<1){month=12;year-=1;}
if (month>12){month=1;year+=1;}
layer = document.getElementById(id);
layer.innerHTML='';
var innerTMP='';
var MonthNum;
var DayNum;
var DayOfWeek=step_iii(year,month,1);
innerTMP+="<table width=\"200\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
innerTMP+="<tr><TD align='center'><A href='#' class='linksCalendario' onClick=\"year-=1;doShow('"+id+"','"+formname+"','"+fieldname+"')\">&#060;&#060;</A></TD><TD align='center'><A href='#' class='linksCalendario' onClick=\"month-=1;doShow('"+id+"','"+formname+"','"+fieldname+"')\">&#060;</A></TD><TD colspan='3' align='center'><H4>" + meses[month] + " - " + year + "</H4></TD><TD align='center'><A href='#' class='linksCalendario' onClick=\"month+=1;doShow('"+id+"','"+formname+"','"+fieldname+"')\">&#062;</A></TD><TD align='center'><A href='#' class='linksCalendario' onClick=\"year+=1;doShow('"+id+"','"+formname+"','"+fieldname+"')\">&#062;&#062;</A></TD></tr>";
innerTMP+="<tr>";
var MaxDays=daysOfMonth(month,year);
for(var dow=0;dow<7;dow++){
innerTMP+="<td align='center'><h4>"+dias[dow]+"</h4></td>";
}
innerTMP+="</tr>";
var SDraw=false;
if(month>9){MonthNum=''+month;}else{MonthNum='0'+month;}
for(var day_c=1;day_c<=36;){
innerTMP+="<tr>\n";
	for(var dow=0;dow<7;dow++){
	if(dow==DayOfWeek){SDraw=true;}
	if(day_c>9){DayNum=''+day_c;}else{DayNum='0'+day_c;}
	innerTMP+="<td align='center'>";
	if((day_c<=MaxDays) && SDraw){innerTMP+="<A href='#' class='linksCalendario' onClick=\"document.forms['"+formname+"'].elements['"+fieldname+"'].value='"+DayNum+"-"+MonthNum+"-"+year+"';doHide('"+id+"','"+formname+"','"+fieldname+"');\">"+(day_c++)+"</A>";}else if(SDraw){day_c++;innerTMP+="&nbsp;";}
	innerTMP+="</td>\n";}
innerTMP+="</tr>\n";
}
innerTMP+="</table>";
//if (fname!=fieldname){alert(innerTMP);}
layer.innerHTML=innerTMP;
fname=fieldname;
}

function infoPiso(id_piso) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "infoPiso.php?id_piso="+id_piso,true);
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
}

var canvasData = '';
function altaPaciente(id_cama) {
	canvasData = '';
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "altaPaciente.php?id_cama="+id_cama,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
//			cargarEstados('estado');
			cargarEstados('estadoAgregar');
			  $(function() {
/*
				$( "#combobox" ).combobox();
				$( "#toggle" ).on("click", function() {
				  $( "#combobox" ).toggle();
				});
 */
					$('#combobox').autocomplete({
					    serviceUrl: 'cie_10_simef.php',
					    minChars:3,
					    onSelect: function( index ) {
					    	$("#diagnostico_alta").val(index.value);
					    }
/*					    onSelect: function (suggestion) {
					        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
					    }
*/					}); 	
				jQuery('#botonIniciar').on('click', function(e) {
					//Pedimos al navegador que nos da acceso a 
					//algún dispositivo de video (la webcam)
					navigator.getUserMedia({
						'audio': false,
						'video': true
					}, function(streamVideo) {
						$("#contenedor_camara").css("display", "block");
						$("#contenedor_foto").css("display", "none");
						$("#botonIniciar").attr("disabled", "disabled");
						$("#botonOtraFoto").attr("disabled", "disabled");
						$("#botonDetener").removeAttr("disabled");
						$("#botonFoto").removeAttr("disabled");
						datosVideo.StreamVideo = streamVideo;
						datosVideo.url = window.URL.createObjectURL(streamVideo);
						jQuery('#camara').attr('src', datosVideo.url);
					}, function() {
						alert('No fue posible obtener acceso a la cámara.');
					});
				
				});
				
				jQuery('#botonDetener').on('click', function(e) {
				
					if (datosVideo.StreamVideo) {
						datosVideo.StreamVideo.stop();
						window.URL.revokeObjectURL(datosVideo.url);
						$("#contenedor_camara").css("display", "none");
						$("#contenedor_foto").css("display", "block");
						$("#botonDetener").attr("disabled", "disabled");
						$("#botonFoto").attr("disabled", "disabled");
						$("#botonOtraFoto").attr("disabled", "disabled");
						$("#botonIniciar").removeAttr("disabled");
					}
				
				});
				
				jQuery('#botonOtraFoto').on('click', function(e) {
					$("#contenedor_camara").css("display", "block");
					$("#contenedor_foto").css("display", "none");
				});

				jQuery('#botonFoto').on('click', function(e) {
					var oCamara, oFoto, oContexto, w, h;
				
					oCamara = jQuery('#camara');
					oFoto = jQuery('#foto');
					w = oCamara.width();
					h = oCamara.height();
					oFoto.attr({
						'width': w,
						'height': h
					});
					oContexto = oFoto[0].getContext('2d');
					oContexto.drawImage(oCamara[0], 0, 0, w, h);
					var canvas = document.getElementById("foto");
					canvasData = canvas.toDataURL('image/jpeg');
								
					$("#contenedor_camara").css("display", "none");
					$("#contenedor_foto").css("display", "block");
					$("#botonOtraFoto").removeAttr("disabled");
				
				});				
				
				
			  });
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
		}
	}
	objeto.send(null)
}

function bajaPaciente(id_cama) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "bajaPaciente.php?id_cama="+id_cama,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
			  $(function() {
					$('#combobox').autocomplete({
					    serviceUrl: 'cie_10_simef.php',
					    minChars:3,
					    onSelect: function( index ) {
					    	$("#diagnostico_mod").val(index.value);
					    }
					}); 	
			  });
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
		}
	}
	objeto.send(null)
}

function opcionesMedicosReceta(objSel) {
	var contenedor = document.getElementById('medicos');
	var objeto= new AjaxGET();
	objeto.open("GET", "medicosParaAlta.php?idServicio="+objSel.value,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "Cargando Medicos...";
		}
	}
	objeto.send(null)
}

function listaCamas(objSel) {
	var contenedor = document.getElementById('camas');
	var objeto= new AjaxGET();
	objeto.open("GET", "camasXpiso.php?id_piso="+objSel.value,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "Cargando Camas...";
		}
	}
	objeto.send(null)
}

function listaCamasVacias(objSel) {
	var contenedor = document.getElementById('camas');
	var objeto= new AjaxGET();
	objeto.open("GET", "camasVaciasXpiso.php?id_piso="+objSel.value,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "Cargando Camas...";
		}
	}
	objeto.send(null)
}

function validarTransferencia(id_piso, id_cama, id_derecho) {
	var piso = document.getElementById('piso').value;
	var cama = document.getElementById('cama').value;
	var error = "";
	if (piso == "0") {
		error += "- Selecciona un piso\n\r";
	}
	if (cama == "0") {
		error += "- Selecciona una cama\n\r";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var objeto= new AjaxGET();
		objeto.open("GET", "transferirPaciente.php?id_piso="+id_piso+"&id_cama="+id_cama+"&id_derecho="+id_derecho+"&cama="+cama,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				alert(objeto.responseText);
				infoPiso(id_piso)
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function validarPassUrgencias() {
	var pass = document.getElementById('pass').value;
	var error = "";
	if (pass == "") {
		error += "- Introduce tu contraseÒa\n\r";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('cargando');
		var objeto= new AjaxGET();
		objeto.open("GET", "buscarContrasena.php?pass="+pass,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = "";
				if (objeto.responseText == "finefinefine") {
					ocultarDiv('pedirPass');
					mostrarDiv('menuUrgencias');
				} else {
					ocultarDiv('menuUrgencias');
					alert('No tienes autorizacion para administrar camillas');
				}
				
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function validarAgregarCamilla() {
	var cami = document.getElementById('cami').value;
	var error = "";
	if (cami == "") {
		error += "- Introduce el No. de camilla\n\r";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('cargando');
		var objeto= new AjaxGET();
		objeto.open("GET", "agregarCamilla.php?cami="+cami,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = "";
				if (objeto.responseText == "ok") {
					alert("camilla agregada correctamente");
					infoPiso(1);
				} else {
					alert(objeto.responseText);
				}
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function validarEliminarCamilla() {
	var cami = document.getElementById('camiEliminar').value;
	var error = "";
	if (cami == "0") {
		error += "- Selecciona el No. de camilla\n\r";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('cargando');
		var objeto= new AjaxGET();
		objeto.open("GET", "eliminarCamilla.php?cami="+cami,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor.innerHTML = "";
				if (objeto.responseText == "ok") {
					alert("camilla eliminada correctamente");
					infoPiso(1);
				} else {
					alert(objeto.responseText);
				}
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function modificarServicio(id_piso, id_cama) {
	var servicio = document.getElementById('servicio').value;
	var medico = document.getElementById('medico').value;
	var error = "";
	if (servicio == "0") {
		error += "- Selecciona el Servicio\n\r";
	}
	if (medico == "0") {
		error += "- Selecciona el Medico tratante\n\r";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('enviandoModificacion');
		var objeto= new AjaxGET();
		objeto.open("GET", "modificarServicio.php?servicio="+servicio+"&medico="+medico+"&id_piso="+id_piso+"&id_cama="+id_cama,true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				alert(objeto.responseText);
				bajaPaciente(id_cama);
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				contenedor.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

function verCamaDH () {
	if (!document.getElementById('dh')) {
		alert( "Ingrese la cedula del derechohabiente y haga click en Buscar..." )	;
	} else {
		valor = document.getElementById('dh').options[document.getElementById('dh').selectedIndex].value;
		valor = ponerAcentos(valor);
		if (valor == -1) {
			alert('No existe derechohabiente hospitalizado con la cedula introducida');
		} else {
			aValor = valor.split('|');
			mostrarDiv("camas");
			var contenedor2 = document.getElementById('camas');
			var agenda= new AjaxGET();
			agenda.open("GET", "camaXbus.php?id_derecho="+aValor[0],true);
			agenda.onreadystatechange=function()
			{
				if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
				{
					contenedor2.innerHTML = agenda.responseText;
				}
				if (agenda.readyState==2)
				{
					contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
				}
			}
			agenda.send(null)
		}
	}
}

function validarModificarObs(id_cama, id_derecho, fecha) {
	var observaciones = document.getElementById('observaciones_mod').value;
	var error = "";
	if (observaciones == "") {
		error += "Introduce una observación";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var contenedor2;
		contenedor2 = document.getElementById('enviando');
		var objeto= new AjaxGET();
		objeto.open("GET", quitarAcentos("modificarObservaciones.php?id_cama="+id_cama+"&observaciones="+observaciones),true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor2.innerHTML = "&nbsp;";
				document.getElementById('agregar').disabled = '';
//				document.getElementById('regresar').disabled = '';
//				infoPiso(id_piso);
				crearOrdenMedica_2017(id_cama, id_derecho, fecha)
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				document.getElementById('agregar').disabled = 'disabled';
//				document.getElementById('regresar').disabled = 'disabled';
				contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

// funciones 2014

function fileExists(url) {
    if(url){
        var req = new XMLHttpRequest();
        req.open('GET', url, false);
        req.send();
        return req.status==200;
    } else {
        return false;
    }
}
function cargarDatosDH2014 () {
	if (!document.getElementById('dh')) {
		alert( "Ingrese la cedula del derechohabiente y haga click en Buscar..." )	;
	} else {
		valor = document.getElementById('dh').options[document.getElementById('dh').selectedIndex].value;
		valor = ponerAcentos(valor);
		if (valor == -1) {
			alert('No existe derechohabiente con la cedula introducida');
		} else {
			aValor = valor.split('|');
			document.getElementById('id_derecho').value = aValor[0];
			document.getElementById('cedula').value = aValor[1]+'/'+aValor[2];
			document.getElementById('ap_p').value = aValor[3];
			document.getElementById('ap_m').value = aValor[4];
			document.getElementById('nombre').value = aValor[5];
			document.getElementById('cedulaBuscar').value = '';
			document.getElementById('alergias').value = aValor[12];
			if (aValor[11] != '') {
				$("#grupo_sanguineo > option[value="+ aValor[11] +"]").attr("selected",true);
			}
			if ((aValor[15] != '') && (fileExists("fotosIngresos/"+aValor[15]))) {
				var canvasLoad = document.getElementById("foto"); // obtenemos la referencia del canvas a su elemento en la pagina
				var contexto = canvasLoad.getContext("2d"); // obtenemos el contexto ( dibujar en 2d)
				var imgLoad = new Image();
				imgLoad.onload = function() {
				  contexto.drawImage(imgLoad, 0, 0);
				};
				imgLoad.src = "fotosIngresos/"+aValor[15]+"?"+(new Date()).getTime();
			}
			
			document.getElementById('derechohabientes').innerHTML = 'Ingrese la cedula del derechohabiente y haga click en Buscar...';
			ocultarDiv('buscar');
			document.getElementById('agregar').disabled = '';
		}
	}
}

function imprimirBrazalete(id_piso, id_cama) {
	window.open("imprimirBrazalete.php?id_piso="+id_piso+"&id_cama="+id_cama);
}

function opcionesMedicosReceta2014(objSel) {
	var contenedor = document.getElementById('medicos_mod');
	var objeto= new AjaxGET();
	objeto.open("GET", "medicosParaAlta2014.php?idServicio="+objSel.value,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "Cargando Medicos...";
		}
	}
	objeto.send(null)
}

function creaPrealta(id_movimiento, id_piso) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "2017_creaPrealta.php?id_movimiento="+id_movimiento,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			if (objeto.responseText == 'ok') {
				alert('Prealta creada correctamente');
				infoPiso(id_piso);
			} else {
				alert(objeto.responseText);
			}
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
		}
	}
	objeto.send(null)
}

function validarModificarObs2014(id_cama, id_derecho, fecha, id_movimiento) {
	var pendientes = document.getElementById('pendientes_mod').value;
	var observaciones = document.getElementById('observaciones_mod').value;
	var servicio = document.getElementById('servicio_mod').value;
	var medico = document.getElementById('medico_mod').value;
	var diagnostico = document.getElementById('diagnostico_mod').value;
	var folio = document.getElementById('folio_mod').value;
	var error = "";
	if ((pendientes == "") && (observaciones == "") && (servicio == "0") && (diagnostico == "")) {
		error += "Introduce o selecciona al menos un valor";
	}
	if ((servicio != "0") && (medico == "0")) {
		error += "Selecciona el medico";
	}
	if (error.length > 0) {
		alert("Ocurrieron los siguientes errores:\n\r\n\r" + error);
	} else {
		var contenedor;
		contenedor = document.getElementById('contenido');
		var contenedor2;
		contenedor2 = document.getElementById('enviando');
		var objeto= new AjaxGET();
		objeto.open("GET", quitarAcentos("modificarObservaciones2014.php?id_cama="+id_cama+"&id_movimiento="+id_movimiento+"&pendientes="+pendientes+"&observaciones="+observaciones+"&interconsulta="+servicio + '_' + medico +"&diagnostico="+diagnostico +"&folio="+folio),true);
		objeto.onreadystatechange=function()
		{
			if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
			{
				contenedor2.innerHTML = "&nbsp;";
				document.getElementById('agregar').disabled = '';
//				document.getElementById('regresar').disabled = '';
//				infoPiso(id_piso);
				crearOrdenMedica_2017(id_cama, id_derecho, fecha)
			}
			if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
			{
				document.getElementById('agregar').disabled = 'disabled';
//				document.getElementById('regresar').disabled = 'disabled';
				contenedor2.innerHTML = "<img src=\"diseno/loading.gif\">";
			}
		}
		objeto.send(null)
	}
}

window.ordenObj = new Array();
//window.ordenObjP = new Array();

function crearOrdenMedica_2017(id_cama, id_derecho, fecha) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "2017_ingresarOrdenMedica.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			window.ordenObj = new Array();
//			window.ordenObjP = new Array();
			contenedor.innerHTML = objeto.responseText;

//			$.each($(".ordnRows"), function(index, vales) {
//				 window.ordenObjP.push(jQuery.parseJSON($(this).val()));
//			});
//			refrescaTablaPOrden();
			  $(function() {
					$('#combobox').autocomplete({
					    serviceUrl: 'cie_10_simef.php',
					    minChars:3,
					    onSelect: function( index ) {
					    	$("#diagnostico_mod").val(index.value);
					    }
					}); 	
/*
					$('#comboboxDiag').autocomplete({
					    serviceUrl: 'cie_10_simef.php',
					    minChars:3,
					    onSelect: function( index ) {
					    	$("#diagnostico_adicional").val(index.value);
					    }
					}); 	
*/
			  		function ocultaTodasVentanas() {
						$("#modal_alimentos").css('display', 'none');
						$("#modal_cuidados").css('display', 'none');
						$("#modal_soluciones").css('display', 'none');
						$("#modal_medicamentos").css('display', 'none');
						$("#modal_procedimientos").css('display', 'none');
			  		}

				  	$("#alimento_tipo1").prop("selectedIndex", 0);
				  	$("#alimento_tipo2").prop("selectedIndex", 0);
				  	$("#alimento_tipo3").prop("selectedIndex", 0);
					$("#btn_modal_alimentos").click(function() {
						ocultaTodasVentanas();
						$("#modal_alimentos").css('display', 'block');
						$("#anteriores_title").html("Alimentos Anteriores");
						var contenedor = document.getElementById('anteriores_body');
						var objeto= new AjaxGET();
						objeto.open("GET", "2017_anterioresConceptos.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha+"&tipo=0",true); // ALIMENTOS
						objeto.onreadystatechange=function()
						{
							if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
							{
								if (objeto.responseText == "0")
									$("#soluciones_sol").focus();
								else {
									$("#anteriores_body").html(objeto.responseText);
									$("#modal_anteriores").modal('show');
								}
							}
							if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
							{
								contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
							}
						}
						objeto.send(null)						
					});
					$("#btn_modal_cuidados").click(function() {
						ocultaTodasVentanas();
						$("#modal_cuidados").css('display', 'block');
						$("#cuidados_texto").focus();
					});
					$("#btn_modal_soluciones").click(function() {
						ocultaTodasVentanas();
						$("#modal_soluciones").css('display', 'block');
						//$("#soluciones_sol").focus();
						$("#anteriores_title").html("Soluciones Anteriores");
						var contenedor = document.getElementById('anteriores_body');
						var objeto= new AjaxGET();
						objeto.open("GET", "2017_anterioresConceptos.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha+"&tipo=4",true); // SOLUCIONES
						objeto.onreadystatechange=function()
						{
							if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
							{
								if (objeto.responseText == "0")
									$("#soluciones_sol").focus();
								else {
									$("#anteriores_body").html(objeto.responseText);
									$("#modal_anteriores").modal('show');
								}
							}
							if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
							{
								contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
							}
						}
						objeto.send(null)						
					});
					$("#btn_modal_medicamentos").click(function() {
						ocultaTodasVentanas();
						$("#modal_medicamentos").css('display', 'block');
						//$("#medicamentos_med").focus();
						$("#anteriores_title").html("Medicamentos Anteriores");
						var contenedor = document.getElementById('anteriores_body');
						var objeto= new AjaxGET();
						objeto.open("GET", "2017_anterioresConceptos.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha+"&tipo=5",true); // MEDICAMENTOS
						objeto.onreadystatechange=function()
						{
							if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
							{
								if (objeto.responseText == "0")
									$("#medicamentos_med").focus();
								else {
									$("#anteriores_body").html(objeto.responseText);
									$("#modal_anteriores").modal('show');
								}
							}
							if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
							{
								contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
							}
						}
						objeto.send(null)						
					});
					$("#btn_modal_procedimientos").click(function() {
						ocultaTodasVentanas();
						$("#modal_procedimientos").css('display', 'block');
						//$("#procedimientos_pro").focus();
						$("#anteriores_title").html("Soluciones Anteriores");
						var contenedor = document.getElementById('anteriores_body');
						var objeto= new AjaxGET();
						objeto.open("GET", "2017_anterioresConceptos.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha+"&tipo=6",true); // PROCEDIMIENTOS / AUX. DIAGNOSTICO
						objeto.onreadystatechange=function()
						{
							if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
							{
								if (objeto.responseText == "0")
									$("#procedimientos_pro").focus();
								else {
									$("#anteriores_body").html(objeto.responseText);
									$("#modal_anteriores").modal('show');
								}
							}
							if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
							{
								contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
							}
						}
						objeto.send(null)						
					});
				    $('#soluciones_periodo').autoNumeric('init', { minimumValue: '0', decimalPlacesOverride: '0' });
				    $('#soluciones_cantidad').autoNumeric('init', { minimumValue: '0' });
					$('#medicamentos_periodo').autoNumeric('init', { minimumValue: '0', decimalPlacesOverride: '0' });
					$('#medicamentos_cantidad').autoNumeric('init', { minimumValue: '0' });
					$('#procedimientos_pro').autocomplete({
					    serviceUrl: '2017_procedimientos.php',
					    minChars:3,
					    onSelect: function (suggestion) {
					    	$("#procedimeintos_sel").val(suggestion.data);
					        //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
					    }
					}); 	
					$('#soluciones_sol').autocomplete({
					    serviceUrl: '2017_medicamentos.php',
					    minChars:3,
					    formatResult: function (suggestion, currentValue) {
					    	var tmp = suggestion.value.split("|");
					    	return tmp[0];
					    },
					    onSelect: function (suggestion) {
					    	var tmp = suggestion.value.split("|");
					    	$("#soluciones_sol").val(tmp[0]);
					    	$("#presentacion_sol").html(tmp[1]);
					    	$("#unidad_sol").html(' &nbsp;' + tmp[2]);
					    	$("#soluciones_sel").val(suggestion.data);
					    }
					}); 	
					$('#medicamentos_med').autocomplete({
					    serviceUrl: '2017_medicamentos.php',
					    minChars:3,
					    formatResult: function (suggestion, currentValue) {
					    	var tmp = suggestion.value.split("|");
					    	return tmp[0];
					    },
					    onSelect: function (suggestion) {
					    	console.log(suggestion.data);
					    	var tmp = suggestion.value.split("|");
					    	$("#medicamentos_med").val(tmp[0]);
					    	$("#presentacion_med").html(tmp[1]);
					    	$("#unidad_med").html(' &nbsp;' + tmp[2]);
					    	$("#medicamentos_sel").val(suggestion.data);
					    }
					}); 	
			  });
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
		}
	}
	objeto.send(null)
}

function getOrdenesMedicas_2017(id_cama, id_derecho, fecha) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "2017_historialOrdenMedica.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha,true);
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
}

function llenarOrdenMedica_2017(id_cama, id_derecho, fecha) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "2017_llenarOrdenMedica.php?id_cama="+id_cama+"&id_derecho="+id_derecho+"&fecha="+fecha,true);
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
}

function bajaPaciente_2017(id_cama) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "bajaPaciente.php?id_cama="+id_cama,true);
	objeto.onreadystatechange=function()
	{
		if (objeto.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = objeto.responseText;
			  $(function() {
					$('#combobox').autocomplete({
					    serviceUrl: 'cie_10_simef.php',
					    minChars:3,
					    onSelect: function( index ) {
					    	$("#diagnostico_mod").val(index.value);
					    }
					}); 	
			  });
		}
		if ((objeto.readyState==1) ||(objeto.readyState==2)||(objeto.readyState==3))
		{
			contenedor.innerHTML = "<br><br><br><br><img src=\"diseno/loading.gif\">";
		}
	}
	objeto.send(null)	
}

function infoPiso_2017(id_piso) {
	var contenedor = document.getElementById('contenido');
	var objeto= new AjaxGET();
	objeto.open("GET", "infoPiso.php?id_piso="+id_piso,true);
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
}

function imprimirOrden(fecha, id_cama, id_derecho, id_medico, id_servicio, idUsuario) {
	window.open("2017_imprimir_orden.php?tipo=todas&fecha="+fecha+"&id_cama="+id_cama+"&id_derecho="+id_derecho+"&id_medico="+id_medico+"&id_servicio="+id_servicio+"&id_usuario="+idUsuario,'_blank');	
}
