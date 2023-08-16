<?php
include("conecta.php");



//################################################### Crea catálogo de autores
$sql= "CREATE TABLE IF NOT EXISTS autores (
	aut_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	aut_act ENUM('0','1') DEFAULT '1',
	aut_nombre VARCHAR(50),
	aut_apellido1 VARCHAR (50),
	aut_apellido2 VARCHAR (50),
	aut_correo  VARCHAR (150),
	aut_telefono VARCHAR (20),
	aut_direccion  VARCHAR (250)
)CHARACTER SET utf8 COLLATE utf8_general_ci";
if ($conn->query($sql) === TRUE) {echo "Tabla autores ok<br>";} else {echo "<font color=red>Error tabla autores: " . $conn->error ."</font><br>";}
//################################################### Crea datos catálogo de autores
$sql="INSERT INTO `autores` (`aut_id`, `aut_nombre`, `aut_apellido1`, `aut_apellido2`, `aut_correo`, 			`aut_telefono`, `aut_direccion`)
					 VALUES ('1',       'Elma',      'Gottdiener',    'Estrada',       'elma@esculturas.org.mx', '5515139080',  'Xuchitla en Scheinvartolo') ";
if ($conn->query($sql) === TRUE) {echo "Datos autores ok<br>";} //else {echo "<font color=red>Error en datos	 autores: " . $conn->error ."</font><br>";}



//################################################### Crea catálogo de obra
$sql= "CREATE TABLE IF NOT EXISTS obra (
	obra_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	obra_autor INT(4) DEFAULT '1',
	obra_act ENUM('0','1') DEFAULT '1',
	
	obra_tipo ENUM('Mad','Bro','Cer') DEFAULT 'Bro',  	/*Mad=Madera  Bro=Bronce Cer=Cerámica */
	obra_prefijo VARCHAR(100),							/*Prefijo de fotos (sin espacios)*/
	obra_nombre VARCHAR(100),							/* Nombre de la obra */
	obra_anio INT(4),									/* año de creación */
	obra_metodo VARCHAR(100),							/*Talla en madera, cera perdida */
	obra_material VARCHAR(100),							/* Cedro rojo */

	obra_venta ENUM('0','1') DEFAULT '0',
	obra_existencia INT(3) DEFAULT '1',
	obra_largoCm DEC(9,2) NULL,
	obra_anchoCm DEC(9,2) NULL,
	obra_fondoCm DEC(9,2) NULL,
	obra_pesoGr  DEC (9,2) NULL,
	obra_precio  DEC (9,2) NULL,
	
	obra_obs_Obra varchar(1500) NULL,
	obra_obs_Metodo varchar(1500) NULL,
	obra_obs_Venta varchar(1500) NULL,
	obra_fotos VARCHAR(2500) NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci";
if ($conn->query($sql) === TRUE) {echo "Tabla obra ok<br>";} else {echo "<font color=red>Error tabla obra: " . $conn->error ."</font><br>";}
//################################################### Crea datos catálogo de autores
$sql="INSERT INTO `obra` (`obra_id`,`obra_tipo`, 	`obra_prefijo`, `obra_nombre`, `obra_anio`, `obra_metodo`, 		`obra_material`, `obra_venta`, `obra_existencia`, `obra_largoCm`, `obra_anchoCm`, `obra_fondoCm`, `obra_pesoGr`, `obra_precio`, `obra_fotos`) 
			      values('1',		'Mad',			'madera1',	    'Madera1',		'2021',		'Talla en madera',	 'Cedro Rojo',	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'madera1.jpeg' ),
			            ('2',		'Mad',			'madera2',	    'Madera 2',		'2021',		'Talla en madera',	 'Cedro Rojo',	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'madera2.jpeg' ),
			            ('3',		'Mad',			'madera3',	    'Madera 3',		'2021',		'Talla en madera',	 'Cedro Rojo',	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'madera3.jpeg' ),
			            ('4',		'Bro',			'Izuly',	    'Izuly',		'2022',		'Cera perdida',	 	 'Bronce',	  	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'Izuly.jpeg@Izuly_1.jpeg' ),
			            ('5',		'Bro',			'toro',	    	'El Toro',		'2022',		'Cera perdida',	 	 'Bronce',	  	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'toro.jpeg@toro_1.jpeg' ),
			            ('6',		'Bro',			'bronce1',	    'Bronce uno',	'2022',		'Cera perdida',	 	 'Bronce',	  	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'bronce1.jpeg@bronce1_1.jpeg@bronce1_3.jpeg' ),
				        ('7',		'Bro',			'bronce2',	    'Bronce dos',	'2022',		'Cera perdida',	 	 'Bronce',	  	  '1',			'1',		 	   '100',          '20',            '30',          '150',	      '150000',		'bronce2.jpeg@bronce2_1.jpeg@bronce2_2.jpeg@bronce2_3.jpeg' )
";
if ($conn->query($sql) === TRUE) {echo "Tabla obra llena ok<br>";} //else {echo "<font color=red>Error llenando obra: " . $conn->error ."</font><br>";}



//################################################### Crea catálogo de visitas
$sql= "CREATE TABLE IF NOT EXISTS visitas (
	vis_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	vis_autor INT(4) DEFAULT '1',
	vis_obra  INT(4) NULL, 
	vis_publico ENUM ('0','1') DEFAULT '1',

	vis_fecha date NULL,
	vis_hora time NULL,

	vis_nombre VARCHAR(250) NULL,
	vis_texto VARCHAR(250) NOT NULL,
	vis_correo VARCHAR(75) NULL,	
	vis_verNombre ENUM('0','1') DEFAULT '1',
	vis_verTexto ENUM('0','1') DEFAULT '1'
)";
if ($conn->query($sql) === TRUE) {echo "Tabla visitas ok<br>";} else {echo "<font color=red>Error creando visitas: " . $conn->error ."</font>$sql<br>";}
//################################################### Llenar catálogo de visitas
$sql="INSERT INTO `visitas` (`vis_id`,	`vis_fecha`, `vis_hora`, `vis_nombre`, 	`vis_verNombre`, `vis_verTexto`, `vis_texto`)
					  VALUES('1',		'2022-05-29', NULL, 	 'Anónimo',		 	'0',             '1',            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla elementum velit vitae vestibulum.'),
					        ('2',		'2022-05-29', NULL, 	 'Miguel de Cervantes','1',          '1',            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla elementum velit vitae vestibulum.'),
					        ('3',		'2022-05-29', NULL, 	 'René Rodín',		 '1',            '1',            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla elementum velit vitae vestibulum.'),
					        ('4',		'2022-05-29', NULL, 	 'Miguel Ángel',	'1',             '1',            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla elementum velit vitae vestibulum.'),
					        ('5',		'2022-05-29', NULL, 	 'El chiras Pelas', '1',             '0',            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla elementum velit vitae vestibulum.')

";
if ($conn->query($sql) === TRUE) {echo "Tabla visistas llena ok<br>";} //else {echo "<font color=red>Error llenando visitas: " . $conn->error ."</font><br>$sql";}




//################################################### Crea tabla de usuarios
$sql= "CREATE TABLE IF NOT EXISTS usr (
	usr_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	usr_act ENUM('0','1') DEFAULT '1',
	usr_alias varchar(50) NOT NULL,
	usr_pass  varchar(50) NOT NULL,
	usr_name VARCHAR(250) NULL,
	usr_tipo varchar(50)
)";
if ($conn->query($sql) === TRUE) {echo "Tabla usr ok<br>";} else {echo "<font color=red>Error creando usr: " . $conn->error ."</font>$sql<br>";}
//################################################### Llenar catálogo de v
$sql="INSERT INTO `usr` (usr_id, usr_act, usr_alias, 	usr_pass, usr_name, usr_tipo)
				  VALUES('1',    '1',     'escheinvar', 'bla',    'Enrique', 'admin'),
				        ('2',    '1',     'elmagott', 	'bla',    'Elma',    'autora')
";
if ($conn->query($sql) === TRUE) {echo "Tabla usr llena ok<br>";} //else {echo "<font color=red>Error llenando usr: " . $conn->error ."</font><br>$sql";}

echo "<br><br>";
?>
