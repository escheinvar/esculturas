<?php 
session_start();
?>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Contacto</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
</head>


<body>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet">

<?php include("cabecera_elma.php"); ?>




<main>

<div style='font-size: 3rem; margin:2rem;'>
	<img src='img/Expectativa.jpeg' width=50% border=0 style='float:right; vertical-align:center; margin-right:5rem;'>

	<h3>Contacto</h3>
	<div class='clearfix'>
		<p>Envía un mensaje a la escultora Elma Gottdiener:
		<form action='mod_correo.php' method='post'>
			<div style='margin:1rem;'>
				<label style='vertical-align: top'>Nombre:</label><br>
				<input type='text' name='nombre' style='font-size: 2rem;  padding:1rem; ' required value='' />
			</div>

			<div style='margin:1rem;'>
				<label style='vertical-align: top'>Correo:</label><br>
				<input type='mail' name='correo' style='font-size: 2rem;  padding:1rem;' value=''/>
			</div>

			<div style='margin:1rem;'>
				<label style='vertical-align: top'>Mensaje:</label><br>
				<textarea name='mensaje' cols="40" rows="2" style='font-size: 2rem;  padding:1rem;' required ></textarea>
			</div>

			<div style='margin:1rem;'>
				<button type='submit' name='tipo' value='contacto' style='font-size: 3rem;'> Enviar </button>
			</div>
		</form>
		<p>O si prefieres, envíale un correo a <a href='mailto:elma@esculturas.org.mx'>elma@esculturas.org.mx</a>
	</div>
</div>	

<div style='font-size: 2rem;'>
<?php $_SESSION['conteo']='0';?>
