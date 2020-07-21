var estados = new Array();
estados['Zacatecas'] = new Array ('Apozol','Apulco','Atolinga','Benito Ju&aacute;rez','Calera','Ca&ntilde;itas de Felipe Pescador','Concepci&oacute;n del Oro','Cuauht&eacute;moc','Chalchihuites','Fresnillo','Trinidad Garc&iacute;a de la Cadena','Genaro Codina','General Enrique Estrada','General Francisco R. Murgu&iacute;a','El Plateado de Joaqu&iacute;n Amaro','General P&aacute;nfilo Natera','Guadalupe','Huanusco','Jalpa','Jerez','Jim&eacute;nez del Teul','Juan Aldama','Juchipila','Loreto','Luis Moya','Mazapil','Melchor Ocampo','Mezquital del Oro','Miguel Auza','Momax','Monte Escobedo','Morelos','Moyahua de Estrada','Nochistl&aacute;n de Mej&iacute;a','Noria de &aacute;ngeles','Ojocaliente','P&aacute;nuco','Pinos','R&iacute;o Grande','Sa&iacute;n Alto','El Salvador','Sombrerete','Susticac&aacute;n','Tabasco','Tepechitl&aacute;n','Tepetongo','Teul de Gonz&aacute;lez Ortega','Tlaltenango de S&aacute;nchez Rom&aacute;n','Valpara&iacute;so','Vetagrande','Villa de Cos','Villa Garc&iacute;a','Villa Gonz&aacute;lez Ortega','Villa Hidalgo','Villanueva','Zacatecas','Trancoso','Santa Mar&iacute;a de la Paz','Otro');

estados['Yucat&aacute;n'] = new Array('Abal&aacute;','Acanceh','Akil','Baca','Bokob&aacute;','Buctzotz','Cacalch&eacute;n','Calotmul','Cansahcab','Cantamayec','Celest&uacute;n','Cenotillo','Conkal','Cuncunul','Cuzam&aacute;','Chacsink&iacute;n','Chankom','Chapab','Chemax','Chicxulub Pueblo','Chichimil&aacute;','Chikindzonot','Chochol&aacute;','Chumayel','Dzan','Dzemul','Dzidzant&uacute;n','Dzilam de Bravo','Dzilam Gonz&aacute;lez','Dzit&aacute;s','Dzoncauich','Espita','Halach&oacute;','Hocab&aacute;','Hoct&uacute;n','Hom&uacute;n','Huh&iacute;','Hunucm&aacute;','Ixil','Izamal','Kanas&iacute;n','Kantunil','Kaua','Kinchil','Kopom&aacute;','Mama','Man&iacute;','Maxcan&uacute;','Mayap&aacute;n','M&eacute;rida','Mococh&aacute;','Motul','Muna','Muxupip','Opich&eacute;n','Oxkutzcab','Panab&aacute;','Peto','Progreso','Quintana Roo','R&iacute;o Lagartos','Sacalum','Samahil','Sanahcat','San Felipe','Santa Elena','Sey&eacute;','Sinanch&eacute;','Sotuta','Sucil&aacute;','Sudzal','Suma','Tahdzi&uacute;','Tahmek','Teabo','Tecoh','Tekal de Venegas','Tekant&oacute;','Tekax','Tekit','Tekom','Telchac Pueblo','Telchac Puerto','Temax','Temoz&oacute;n','Tepak&aacute;n','Tetiz','Teya','Ticul','Timucuy','Tinum','Tixcacalcupul','Tixkokob','Tixm&eacute;huac','Tixp&eacute;hual','Tizim&iacute;n','Tunk&aacute;s','Tzucacab','Uayma','Uc&uacute;','Um&aacute;n','Valladolid','Xocchel','Yaxcab&aacute;','Yaxkukul','Yoba&iacute;n','Otro');

estados['Veracruz'] = new Array('Acajete','Acatl&aacute;n','Acayucan','Actopan','Acula','Acultzingo','Agua Dulce','Alpatl&aacute;huac','Alto Lucero de Guti&eacute;rrez Barrios','Altotonga','Alvarado','Amatitl&aacute;n','Amatitl&aacute;n de los Reyes','&aacute;ngel R. Cabada','Apazapan','Aquila','Astacinga','Atlahuilco','Atoyac','Atzacan','Atzalan','Ayahualulco','Banderilla','Benito Ju&aacute;rez','Boca del R&iacute;o','Calcahualco','Camar&oacute;n de Tejada','Camerino Z. Mendoza','Carlos A. Carrillo','Carrillo Puerto','Castillo de Teayo','Catemaco','Cazones de Herrera','Cerro Azul','Chacaltianguis','Chalma','Chiconamel','Chiconquiaco','Chicontepec','Chinameca','Chinampa de Gorostiza','Chocom&aacute;n','Chontla','Chumatl&aacute;n','Citlalt&eacute;petl','Coacoatzintla','Coahuitl&aacute;n (Progreso de Zaragoza)','Coatepec','Coatzacoalcos','Coatzintla','Coetzala','Colipa','Comapa','C&oacute;rdoba','Cosamaloapan','Cosautl&aacute;n de Carvajal','Coscomatepec','Cosoleacaque','Cotaxtla','Coxquihi','Coyutla','Cuichapa','Cuitl&aacute;huac','El Higo','Emiliano Zapata','Espinal','Filomeno Mata','Fort&iacute;n','Guti&eacute;rrez Zamora','Hidalgotitl&aacute;n','Huatusco','Huayacocotla','Hueyapan de Ocampo','Huiloapan de Cuauht&eacute;moc','Igancio de la Llave','Ilamatl&aacute;n','Isla','Ixcatepec','Ixhuac&aacute;n de los Reyes','Ixhuatl&aacute;n de Madero','Ixhuatl&aacute;n del Caf&eacute;','Ixhuatl&aacute;n del Sureste','Ixhuatlancillo','Ixmatlahuacan','Ixtaczoquitl&aacute;n','Jalancingo','Jalcomulco','J&aacute;ltipan','Jamapa','Jes&uacute;s Carranza','Jilotepec','Jos&eacute; Azueta','Juan Rodr&iacute;guez Clara','Juchique de Ferrer','La Antigua','La Perla','Landero y Coss','Las Choapas','Las Minas','Las Vigas de Ram&iacute;rez','Lerdo de Tejada','Los Reyes','Magdalena','Maltrata','Manlio Fabio Altamirano','Mariano Escobedo','Mart&iacute;nez de la Torre','Mecatl&aacute;n','Mecayapan','Medell&iacute;n','Mihuatl&aacute;n','Minatitl&aacute;n','Misantla','Mixtla de Altamirano','Moloac&aacute;n','Nanchital de L&aacute;zaro C&aacute;rdenas del R&iacute;o','Naolinco','Naranjal','Naranjos-Amatl&aacute;n','Nautla','Nogales','Oluta','Omealca','Orizaba','Otatitl&aacute;n','Oteapan','Ozuluama','Pajapan','P&aacute;nuco','Papantla','Paso de Ovejas','Paso del Macho','Perote','Plat&oacute;n S&aacute;nchez','Playa Vicente','Poza Rica de Hidalgo','Pueblo Viejo','Puente Nacional','Rafael Delgado','Rafael Lucio','R&iacute;o Blanco','Saltabarranca','San Andr&eacute;s Tenejapan','San Andr&eacute;s Tuxtla','San Juan Evangelista','San Rafael','Santiago Sochiapan','Santiago Tuxtla','Sayula de Alem&aacute;n','Sochiapa','Soconusco','Soledad Atzompa','Soledad de Doblado','Soteapan','Tamal&iacute;n','Tamiahua','Tampico Alto','Tancoco','Tantima','Tantoyuca','Tatahuicapan de Ju&aacute;rez','Tatatila','Tecolutla','Tehuipango','Temapache','Tempoal','Tenampa','Tenochtitl&aacute;n','Teocelo','Tepatlaxco','Tepetl&aacute;n','Tepetzintla','Tequila','Texcatepec','Texhuac&aacute;n','Texistepec','Tezonapa','Tierra Blanca','Tihuatl&aacute;n','Tlachichilco','Tlacojalpan','Tlacolulan','Tlacotalpan','Tlacotepec de Mej&iacute;a','Tlalixcoyan','Tlalnelhuayocan','Tlaltetela','Tlapacoyan','Tlaquilpan','Tlilapan','Tomatl&aacute;n','Tonay&aacute;n','Totutla','Tres Valles','Tuxpan','Tuxtilla','&uacute;rsulo Galv&aacute;n','Uxpanapa','Vega de Alatorre','Veracruz','Villa Aldama','Xalapa','Xico','Xoxocotla','Yanga','Yecuatla','Zacualpan','Zaragoza','Zentla','Zongolica','Zontecomatl&aacute;n','Zozocolco','Otro');

estados['Tlaxcala'] = new Array('Amaxac de Guerrero','Apetatitl&aacute;n de Antonio Carvajal','Atlangatepec','Altzayanca','Apizaco','Benito Ju&aacute;rez','Calpulalpan','El Carmen Tequexquitla','Cuapiaxtla','Cuaxomulco','Emiliano Zapata','Santa Ana Chiautempan','Mu&ntilde;oz de Domingo Arenas','Espa&ntilde;ita','Huamantla','Hueyotlipan','Ixtacuixtla de Mariano Matamoros','Ixtenco','Mazatecochco de Jos&eacute; Maria Morelos','Contla de Juan Cuamatzi','Tepetitla de Lardiz&aacute;bal','Sanctorum de L&aacute;zaro C&aacute;rdenas','Nanacamilpa de Mariano Arista','Acuamanala de Miguel Hidalgo','Nativitas','Panotla','Papalotla de Xicoht&eacute;ncatl','San Pablo del Monte','Santa Cruz Tlaxcala','Tenancingo','Teolocholco','Tepeyanco','Terrenate','Tetla de la Solidaridad','Tetlatlahuca','Tlaxcala de Xicoht&eacute;ncatl','Tlaxco','Tocatlan','Totolac','Tzompantepec','Xaloztoc','Xicohtzinco','Yauhquemecan','Zacatelco','Zitlaltepec de Trinidad S&aacute;nchez Santos','L&aacute;zaro C&aacute;rdenas','La Magdalena Tlaltelulco','San Dami&aacute;n Texoloc','San Francisco Tetlanohcan','San Jer&oacute;nimo Zacualpan','San Jos&eacute; Teacalco','San Juan Huactzinco','San Lorenzo Axocomanitla','San Lucas Tecopilco','Santa Ana Nopalucan','Santa Apolonia Teacalco','Santa Catarina Ayometla','Santa Cruz Quilehtla','Santa Isabel Xiloxoxtla','Otro');

estados['Tamaulipas'] = new Array('Abasolo','Aldama','Altamira','Antiguo Morelos','Burgos','Bustamante','Camargo','Casas','Ciudad Madero','Cruillas','G&oacute;mez Farias','Gonz&aacute;lez','Gü&eacute;mez','Guerrero','Gustavo D&iacute;az Ord&aacute;z','Hidalgo','Jaumave','Jim&eacute;nez','Llera','Mainero','El Mante','Matamoros','M&eacute;ndez','Mier','Miguel Alem&aacute;n','Miquihuana','Nuevo Laredo','Nuevo Morelos','Ocampo','Padilla','Palmillas','Reynosa','R&iacute;o Bravo','San Carlos','San Fernando','San Nicol&aacute;s','Soto la Marina','Tampico','Tula','Valle Hermoso','Victoria','Villagr&aacute;n','Xicot&eacute;ncatl','Otro');

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

estados['Michoac&aacute;n'] = new Array('Acuitzio','Aguililla','&aacute;lvaro Obreg&oacute;n','Angamacutiro','Angangueo','Apatzing&aacute;n','Aporo','Aquila','Ario','Arteaga','Brise&ntilde;as','Buenavista','C&aacute;racuaro','Chaparan','Charo','Chavinda','Cher&aacute;n','Chilchota','Chinicuila','Chirintzio','Chuc&aacute;ndiro','Churumuco','Coahuayana','Coalcom&aacute;n de V&aacute;zquez Pallares','Coeneo','Cojumatl&aacute;n de R&eacute;gules','Contepec','Cop&aacute;ndaro','Cotija','Cuitzeo','Ecuandureo','Epitacio Huerta','Erongar&iacute;cuaro','Gabriel Zamora','Hidalgo','Huandacareo','Huaniqueo','Huetamo','Huiramba','Indaparapeo','Irimbo','Ixtl&aacute;n','Jacona','Jim&eacute;nez','Jiquilpan','Jos&eacute; Sixto Verduzco','Ju&aacute;rez','Jungapeo','La Huacana','La Piedad','Lagunillas','L&aacute;zaro C&aacute;rdenas','Los Reyes','Madero','Maravat&iacute;o','Marcos Castellanos','Morelia','Morelos','M&uacute;gica','Nahuatzen','Nocup&eacute;taro','Nuevo Parangaricutiro','Nuevo Urecho','Numar&aacute;n','Ocampo','Pajacuar&aacute;n','Panind&iacute;cuaro','Paracho','Par&aacute;cuaro','P&aacute;tzcuaro','Penjamillo','Perib&aacute;n','Pur&eacute;pero','Puru&aacute;ndiro','Quer&eacute;ndaro','Quiroga','Salvador Escalante','San Lucas','Santa Ana Maya','Senguio','Suahuayo','Susupuato','Tac&aacute;mbaro','Tanc&iacute;taro','Tangamandapio','Tanganc&iacute;cuaro','Tanhuato','Taretan','Tar&iacute;mbaro','Tepalcatepec','Tingambato','Tingüind&iacute;n','Tiquicheo de Nicol&aacute;s Romero','Tlalpujahua','Tlazazalca','Tocumbo','Tumbiscat&iacute;o','Turicato','Tuxpan','Tuzantla','Tzintzuntzan','Tzitzio','Uruapan','Venustiano Carranza','Villamar','Vista Hermosa','Yur&eacute;cuaro','Zacapu','Zamora','Zin&aacute;paro','Zinap&eacute;cuaro','Ziracuaretiro','Zit&aacute;cuaro','Otro');

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
	var conso = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	tConso = conso.length;
	seEncontro = false;
	for(i=0;i<tConso;i++)
		if (conso[i] == valor.toUpperCase()) seEncontro = true;
	return seEncontro;
}

function esVocal(valor) {
	var vocal = new Array('A','E','I','O','U','Ü');
	tVocal = vocal.length;
	seEncontro = false;
	for(i=0;i<tVocal;i++)
		if (vocal[i] == valor.toUpperCase()) seEncontro = true;
	return seEncontro;
}

function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { 
		test=args[i+2]; 
		val=document.getElementById(args[i]);
		if (val) { 
			nm=val.name; 
			if ((val=val.value)!="") {
				if (test.indexOf('isEmail')!=-1) { 
					p=val.indexOf('@');
					if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe ser una direccion de email.\n';
				} else if ((test!='R') && (test!='L') && (test!='C') && (test!='H') && (test!='E') && (test!='F')) { 
					num = parseFloat(val);
					if (isNaN(val)) errors+='- '+nm+' debe ser un numero.\n';
					if (test.indexOf('inRange') != -1) { 
						p=test.indexOf(':');
						min=test.substring(8,p); max=test.substring(p+1);
						if (num<min || max<num) errors+='- '+nm+' debe ser un numero entre '+min+' y '+max+'.\n';
					} 
				}
			} else if (test.charAt(0) == 'R') {
				if (nm == 'ap_p') nm = 'apellido paterno';
				if (nm == 'ap_m') nm = 'apellido materno';
				errors += '- '+nm+' es requerido.\n';
			}
			if (test.charAt(0) == 'L') { // formato para campos login y password
				if (val.length < 6) errors += '- '+nm+' debe contener al menos 6 caracteres.\n';
			}
			if (test.charAt(0) == 'C') { // formato para campo cedula
				if (val.length != 10) errors += '- '+nm+' debe contener 10 caracteres.\n';
				else {
					l1 = val.charAt(0);
					l2 = val.charAt(1);
					l3 = val.charAt(2);
					l4 = val.charAt(3);
					ano = val.charAt(4) + val.charAt(5);
					mes = val.charAt(6) + val.charAt(7);
					dia = val.charAt(8) + val.charAt(9);
					if(!esConsonante(l1)) errors += '- El primer caracter de la cedula debe ser una consonante.\n';
					else if (!esVocal(l2))  errors += '- El segundo caracter de la cedula debe ser una vocal.\n';
					else if(!esConsonante(l3)) errors += '- El tercer caracter de la cedula debe ser una consonante.\n';
					else if(!esConsonante(l4)) errors += '- El cuarto caracter de la cedula debe ser una consonante.\n';
					else if(!esFechaValida(dia+"/"+mes+"/19"+ano)) errors += '- La fecha de la cedula es invalida.\n';
				}
			}
			if (test.charAt(0) == 'H') { // formato para campos hora valida xx:xx
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
			}
			if (test.charAt(0) == 'F') { // formato para campos fecha valida dd-mm-aaaa
				var fecha = val;
				if (esFechaValida(val) == false) errors += '- La fecha es invalida, debe ser en formato (DD/MM/AAAA)';
			}
			if (test.charAt(0) == 'E') { // formato para numero de empleado
				if (val.length != 6) errors += '- No. de Empleado debe contener 6 digitos.\n';
				else if (isNaN(val)) errors += '- No. de Empleado debe ser numerico.\n';
			}			
		}
    } 
	if (errors) alert('Ocurrieron los siguientes errores:\n'+errors);
    document.MM_returnValue = (errors == '');
  } 
}

function sumaTiempos(t1, t2){
	var dot1 = t1.indexOf(":");
	var dot2 = t2.indexOf(":");
	var m1 = t1.substr(0, dot1);
	var m2 = t2.substr(0, dot2);
	var s1 = t1.substr(dot1 + 1);
	var s2 = t2.substr(dot2 + 1);
	var sRes = (Number(s1) + Number(s2));
	var mRes;
	var addMinute = false;
	if (sRes >= 60){
		addMinute = true;
		sRes -= 60;
	}
	mRes = (Number(m1) + Number(m2) + (addMinute? 1: 0));
	var mResS = String(mRes);
	var sResS = String(sRes);
	if (mResS.length <2) mResS = "0" + mResS
	if (sResS.length <2) sResS = "0" + sResS
	return mResS + ":" + sResS;
}

function rehacerHorario(objeto,int_prv, int_sub, int_pro, div, totalDiv, actualDiv, dia, hora_salida) {
//	eliminar opciones subsecuentes
//alert(objeto.value + " - " + int_prv + " - " + int_sub + " - " + int_pro + " - " + div + " - " + totalDiv + " - " + actualDiv + " - " + dia + " - " + hora_salida);
	for(var i=actualDiv; i<= 50; i++) {
		if (document.getElementById('div'+dia+i)) {
			myDiv = document.getElementById('div'+dia+i);
			myDiv.parentNode.removeChild(myDiv);
		}
	}
// fin eliminar opciones subsecuentes
// crear opciones nuevas
	var aObjeto = objeto.value.split('|');
	var hora_actual = "";
	var hora_nueva = "";
	var hora_final = "";	

	hora_actual = aObjeto[1]; // hora termina
//	hora_actual = aObjeto[2]; // hora termina
	tipo_cita = aObjeto[3]; // tipo_cita
	checkedPRV = "";
	checkedSUB = "";
	checkedPRO = "";
	checkedSNC = "";
	if (tipo_cita == "-1") { sumar = int_prv; checkedSNC = "checked"; }
	if (tipo_cita == "0") { sumar = int_prv; checkedPRV = "checked"; }
	if (tipo_cita == "1") { sumar = int_sub; checkedSUB = "checked"; }
	if (tipo_cita == "2") { sumar = int_pro; checkedPRO = "checked"; }
	hora_nueva = sumaTiempos(hora_actual,"00:"+sumar);
	hora_final = hora_salida;
	var i = actualDiv+1;
	while (esMenor(hora_nueva,hora_final)) {
		if (!document.getElementById('div'+dia+i)) {
			fi = document.getElementById(dia); // 1
  			contenedor = document.createElement('div'); // 2
  			contenedor.id = 'div'+dia+i; // 3
			contenedor.innerHTML = hora_actual + " a " + hora_nueva + " - <input type=\"radio\" name=\"hor" + dia + i + "\" value=\"" + dia + "|" + hora_actual + "|" + hora_nueva + "|0\" onClick=\"javascript: rehacerHorario(this,'" + int_prv + "','" + int_sub + "','" + int_pro + "','div" + dia + i + "'," + totalDiv + "," + i + ",'" + dia + "','" + hora_salida + "');\" " + checkedPRV + ">Primera Vez <input type=\"radio\" name=\"hor" + dia + i + "\" value=\"" + dia + "|" + hora_actual + "|" + hora_nueva + "|1\" onClick=\"javascript: rehacerHorario(this,'" + int_prv + "','" + int_sub + "','" + int_pro + "','div" + dia + i + "'," + totalDiv + "," + i + ",'" + dia + "','" + hora_salida + "');\" " + checkedSUB + ">Subsecuente <input type=\"radio\" name=\"hor" + dia + i + "\" value=\"" + dia + "|" + hora_actual + "|" + hora_nueva + "|2\" onClick=\"javascript: rehacerHorario(this,'" + int_prv + "','" + int_sub + "','" + int_pro + "','div" + dia + i + "'," + totalDiv + "," + i + ",'" + dia + "','" + hora_salida + "');\" " + checkedPRO + ">Procedimiento <input type=\"radio\" name=\"hor" + dia + i + "\" value=\"" + dia + "|" + hora_actual + "|" + hora_nueva + "|-1\" onClick=\"javascript: rehacerHorario(this,'" + int_prv + "','" + int_sub + "','" + int_pro + "','div" + dia + i + "'," + totalDiv + "," + i + ",'" + dia + "','" + hora_salida + "');\" " + checkedSNC + ">Sin Cita<br><br>";
			fi.appendChild(contenedor); // 4
			hora_actual = hora_nueva;
			hora_nueva = sumaTiempos(hora_actual,"00:"+sumar);
			i++;
		}
	}
// fin crear opciones nuevas
}


function esMenor(horaActual, horaNueva) {
	hra= parseInt(horaActual.substr(0,2),10);
	mina= parseInt(horaActual.substr(3,2),10);
	hrn= parseInt(horaNueva.substr(0,2),10);
	minn= parseInt(horaNueva.substr(3,2),10);
	err = true;
	if (hra > hrn)
		err = false;
	if (hra == hrn) 
		if (mina > minn)
			err = false;
	return err;
}


function MM_jumpMenu(targ,selObj,restore){ //v3.0
	var MCon, MConI, MSer, MSerI, MDr, MDrI;
	MCon = document.getElementById('MCon');
	MConI = MCon.selectedIndex;
	idCon = MCon.options[MConI].value;
	MSer = document.getElementById('MSer');
	MSerI = MSer.selectedIndex;
	idSer = MSer.options[MSerI].value;
	MDr = document.getElementById('MMed');
	MDrI = MDr.selectedIndex;
	idDr = MDr.options[MDrI].value;
	location.href = "incidencias.php?idConsultorio="+idCon+"&idServicio="+idSer+"&idMedico="+idDr;
}


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

function cargarIncidencias() {
	var contenedor2;
	contenedor2 = document.getElementById('incidenciasActuales');
	var agenda= new AjaxGET();
	agenda.open("GET", "incidenciasActuales.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"../diseno/loading.gif\">";
		}
	}
	agenda.send(null)
	
}

function cargarAgenda() {
	var contenedor2;
	var contenedor;
	contenedor2 = document.getElementById('contenido');
	contenedor = document.getElementById('incidenciasActuales');
	var agenda= new AjaxGET();
	agenda.open("GET", "agenda.php",true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor2.innerHTML = agenda.responseText;
			cargarIncidencias();
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor2.innerHTML = "<img src=\"../diseno/loading.gif\">";
			contenedor.innerHTML = "<img src=\"../diseno/loading.gif\">";
		}
	}
	agenda.send(null)
	
}

function cambiarMes(mes) {
	var contenedor;
	contenedor = document.getElementById('contenido');
	var agenda= new AjaxGET();
	agenda.open("GET", "agenda.php?getdate="+mes,true);
	agenda.onreadystatechange=function()
	{
		if (agenda.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = agenda.responseText
		}
		if ((agenda.readyState==1) ||(agenda.readyState==2)||(agenda.readyState==3))
		{
			contenedor.innerHTML = "<img src=\"../diseno/loading.gif\">";
		}
	}
	agenda.send(null)
	
}

function MM_jumpMenuAjax(targ,selObj,restore){ //v3.0
	var MCon, MConI, MSer, MSerI, MDr, MDrI;
	MCon = document.getElementById('MCon');
	MConI = MCon.selectedIndex;
	idCon = MCon.options[MConI].value;
	MSer = document.getElementById('MSer');
	MSerI = MSer.selectedIndex;
	idSer = MSer.options[MSerI].value;
	MDr = document.getElementById('MMed');
	MDrI = MDr.selectedIndex;
	idDr = MDr.options[MDrI].value;
	var contenedor;
	contenedor = document.getElementById('seleccion');
	var seleccion= new AjaxGET();
	seleccion.open("GET", "seleccionConSerDr.php?idConsultorio="+idCon+"&idServicio="+idSer+"&idMedico="+idDr,true);
	seleccion.onreadystatechange=function()
	{
		if (seleccion.readyState==4) // Readystate 4 significa que ya acab&oacute; de cargarlo
		{
			contenedor.innerHTML = seleccion.responseText;
			cargarAgenda()
		}
		if ((seleccion.readyState==1) ||(seleccion.readyState==2)||(seleccion.readyState==3))
		{
			contenedor.innerHTML = "<img src=\"../diseno/loading.gif\">";
		}
	}
	seleccion.send(null)
	
//  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
//  if (restore) selObj.selectedIndex=0;
}



function MM_jumpMenu2(targ,selObj,restore,pagina){ //v3.0
	var MCon, MConI, MSer, MSerI, MDr, MDrI;
	MCon = document.getElementById('MCon');
	MConI = MCon.selectedIndex;
	idCon = MCon.options[MConI].value;
	MSer = document.getElementById('MSer');
	MSerI = MSer.selectedIndex;
	idSer = MSer.options[MSerI].value;
	MDr = document.getElementById('MMed');
	MDrI = MDr.selectedIndex;
	idDr = MDr.options[MDrI].value;
//	alert("incidencias.php?idConsultorio="+idCon+"&idServicio="+idSer+"&idMedico="+idDr);
	location.href = pagina+"?idConsultorio="+idCon+"&idServicio="+idSer+"&idMedico="+idDr;
}

function MM_jumpMenuCons(targ,selObj,restore,pagina){ //v3.0
	var MCon, MConI, MSer, MSerI, MDr, MDrI;
	MCon = document.getElementById('MCon');
	MConI = MCon.selectedIndex;
	idCon = MCon.options[MConI].value;
	location.href = pagina+"?idConsultorio="+idCon;
}

function selDia(fechaC, fechaH) {
	var fechaCita = fechaC;
	var fechaHoy = fechaH;
	var diaCita = fechaCita.substring(6,8); 
	var mesCita = (fechaCita.substring(4,6))*1 - 1;
	var anoCita = fechaCita.substring(0,4); 
	var fechaCitaU = new Date(anoCita,mesCita,diaCita);
	var diaHoy = fechaHoy.substring(6,8); 
	var mesHoy = (fechaHoy.substring(4,6))*1 - 1;
	var anoHoy = fechaHoy.substring(0,4); 
	var fechaCitaH = new Date(anoHoy,mesHoy,diaHoy);
	if(fechaCitaU < fechaCitaH)
   {
      alert("La fecha de la cita es anterior a la fecha de hoy");
    } else {
		var MCon, MConI, MSer, MSerI, MDr, MDrI;
		MCon = document.getElementById('MCon');
		MConI = MCon.selectedIndex;
		idCon = MCon.options[MConI].value;
		MSer = document.getElementById('MSer');
		MSerI = MSer.selectedIndex;
		idSer = MSer.options[MSerI].value;
		MDr = document.getElementById('MMed');
		MDrI = MDr.selectedIndex;
		idDr = MDr.options[MDrI].value;
		location.href = "incidenciasCitasXdia.php?idConsultorio="+idCon+"&idServicio="+idSer+"&idMedico="+idDr+"&getdate="+fechaC;
	}
	
}

function validarAgregarIncidencia() {
	var dias_incidencias = document.getElementById('dias_incidencias').value;
	var tipo_incidencia = document.getElementById('tipo_incidencia').value;
	var observaciones =	document.getElementById('observaciones').value;
	if ((dias_incidencias.length > 0) && (tipo_incidencia.length > 0) && (observaciones.length > 0)) {
		location.href = "incidenciasAgregarDiasConfirmar.php?dias_incidencias="+dias_incidencias+"&tipo_incidencia="+tipo_incidencia+"&observaciones="+observaciones;
	} else {
		alert('Debes introducir una descripcion');
	}
}

function validarAgregarIncidenciaHoras() {
	var horas_incidencias = document.getElementById('horas_incidencias').value;
	var tipo_incidencia = document.getElementById('tipo_incidencia').value;
	var observaciones =	document.getElementById('observaciones').value;
	if ((horas_incidencias.length > 0) && (tipo_incidencia.length > 0) && (observaciones.length > 0)) {
		location.href = "incidenciasAgregarHorariosConfirmar.php?horas_incidencias="+horas_incidencias+"&tipo_incidencia="+tipo_incidencia+"&observaciones="+observaciones;
	} else {
		alert('Debes introducir una descripcion');
	}
}

function validarReporteCitaLejana(idUsuario, idConsultorio, idServicio, idMedico){
	var rg1 = document.getElementById('RadioGroup1_0');
	var rg2 = document.getElementById('RadioGroup1_1');
	var rg3 = document.getElementById('RadioGroup1_2');
	var rg4 = document.getElementById('RadioGroup1_3');
	if (rg1.checked) tipoReporte = "unidad";
	if (rg2.checked) tipoReporte = "consultorio";
	if (rg3.checked) tipoReporte = "servicio";
	if (rg4.checked) tipoReporte = "medico";
	window.open("reporte_cita_mas_lejana_R.php?idConsultorio="+idConsultorio+"&idServicio="+idServicio+"&idMedico="+idMedico+"&idUsuario="+idUsuario+"&tipoReporte="+tipoReporte,'_blank');
	return false;
}

function validarReporte(liga, idUsuario, idConsultorio, idServicio, idMedico){
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
		var rg1 = document.getElementById('RadioGroup1_0');
		var rg2 = document.getElementById('RadioGroup1_1');
		var rg3 = document.getElementById('RadioGroup1_2');
		var rg4 = document.getElementById('RadioGroup1_3');
		if (rg1.checked) tipoReporte = "unidad";
		if (rg2.checked) tipoReporte = "consultorio";
		if (rg3.checked) tipoReporte = "servicio";
		if (rg4.checked) tipoReporte = "medico";
		window.open(liga+"?idConsultorio="+idConsultorio+"&idServicio="+idServicio+"&idMedico="+idMedico+"&idUsuario="+idUsuario+"&tipoReporte="+tipoReporte+"&fechaI="+fechaIn+"&fechaF="+fechaFi,'_blank');
	}
	return false;
}

function validarReporteOcupacion(liga, idUsuario, idConsultorio, idServicio, idMedico){
		var rg1 = document.getElementById('RadioGroup1_0');
		var rg2 = document.getElementById('RadioGroup1_1');
		if (rg1.checked) tipoReporte = "unidad";
		if (rg2.checked) tipoReporte = "consultorio";
		window.open(liga+"?idConsultorio="+idConsultorio+"&idUsuario="+idUsuario+"&tipoReporte="+tipoReporte,'_blank');
	return false;
}
function validarReporteListaDerecho(liga,idUsuario){
		var rg1 = document.getElementById('RadioGroup1_0');
		var rg2 = document.getElementById('RadioGroup1_1');
		if (rg1.checked) tipoReporte = "cedula";
		if (rg2.checked) tipoReporte = "apellidos";
		window.open(liga+"?idUsuario="+idUsuario+"&tipoReporte="+tipoReporte,'_blank');
	return false;
}