<?php
session_start();
$_SESSION['conteo']++;
require("./PHPMailer/src/PHPMailer.php");
require("./PHPMailer/src/Exception.php");
require("./PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
?>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Contacto</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">
</head>


<body>
<mail>
<?php 
include("cabecera_elma.php"); 
$hoy=date("Y-m-d");
$hora=date("H:i");
$tipo=$_POST["tipo"];
$correoEnvio="escheinvar@gmail.com";
//$correoEnvio2="elmagott@gmail.com";


echo $hoy." ".$hora;
//##################################### Mailer
$mail = new PHPMailer();
require("conecta-mail.php");

//############################################# Prepara el correo
if($tipo=='contacto'){
	$nombre=$_POST["nombre"];
	$correo=$_POST["correo"];
	$mensaje=$_POST["mensaje"];

	$mail->setFrom('sistema@esculturas.org.mx', 'Esculturas contacto');
	$mail->addAddress($correoEnvio);
	if($correoEnvio2 !='') {$mail->addAddress($correoEnvio2);}
	$mail->CharSet = 'UTF-8';
	$mail->isHTML(true);
	$mail->Subject = "Esculturas-Contacto nuevo";
	$mail->Body    = "Un usuario envió datos de contacto desde el link de contacto en esculturas.org.mx/<br>Fecha: ".$hoy." a las ".$hora."hrs.<br><br>Nombre: ".$nombre."<br>Correo: ".$correo."<br>Mensaje: ".$mensaje;
	//$mail->AltBody = 'Cuerpo alternativo';
	//$mail->AddAttachment($Archivo);  //Adjunta archivo

}else if($tipo=='obra'){
	$obra=$_POST["obra"];
	$comprador=$_POST["nombre"];
	$correo=$_POST["correo"];
	$tel=$_POST["tel"];
	$dir=$_POST["dir"];
	$obs=$_POST["observa"];
	
	$mail->setFrom('sistema@esculturas.org.mx', 'Esculturas interés de compra');
	$mail->addAddress($correoEnvio);
	if($correoEnvio2 != '') {$mail->addAddress($correoEnvio2);}
	$mail->CharSet = 'UTF-8';
	$mail->isHTML(true);
	$mail->Subject = "Esculturas-Interés de compra";
	$mail->Body    = "Interés de compra de ".$obra."<br>".$hoy." a las ".$hora." hrs.<br>Comprador: ".$comprador."<br>Correo:".$correo."<br>Tel:".$tel."<br>Dirección:".$dir."<br>Observaciones:".$obs."<br><br>";
	//$mail->AltBody = 'Cuerpo alternativo';	
	//$mail->AddAttachment($Archivo);  //Adjunta archivo
}



//############################################# Envía el correo
if($_SESSION['conteo']=='1'){
	if($mail->Send() == TRUE) {
		echo "<br><br><big><center>Tu mensaje fue entregado. <br>";  
	}else{
		echo "<br><br><br><big><center>No se pudo enviar mensaje";
	}

}else{
	echo "<br><br><center>-página finalizada-<br><br>";
}




?>

</main>
