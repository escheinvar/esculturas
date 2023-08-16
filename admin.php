<!-- html lang="es"-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Admin</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">
</head>

<body>
<?php include("cabecera_elma.php"); ?>


<main>
<center>
<br><br>
<form action='admin1.php' method='post' id='formularioObra'>
	<div style='font-size: 2rem;'>
		<div style='padding:1rem;'>
			<label>Nombre de usuario:</label><br>
			<input type='text' name='nombre' style='font-size: 2rem; padding:.5rem;'>
		</div>

		<div style='padding:1rem;'>
			<label>Clave de acceso:</label><br>
			<input type='password' name='pass' style='font-size: 2rem; padding:.5rem;'>
		</div>

		<div style='padding:1rem;'>
			<button type='submit'  style='font-size: 2rem; padding:.5rem;'> Ingresar </button>
		</div>
	</div>
</form>
<br><br>
