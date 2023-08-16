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
</head>


<body>


<?php include("cabecera_elma.php"); ?>

<main>

<center>
<div style='font-size: 2rem; margin:2rem;width:90%;'>
	<h3>Déjanos un mensaje:</h3>
	<div class='clearfix'>
		<!-- form action='visitas_elma.php' method='post' -->
			<div style='padding: 1rem; display:inline-block; vertical-align: top;text-align: left;'>
				<label>Nombre:</label><br>
				<input type='text' name='nombre' style='font-size: 3rem; margin:2rem;padding: 1rem;' disabled/><br>
				<input type="radio" name="verNombre" value="1" checked disabled>		<label>Publicar mi Nombre</label><br>
				<input type="radio" name="verNombre" value="0" disabled>				<label>No publicar mi Nombre</label>
			</div>

			<div style='padding: 1rem; display:inline-block; vertical-align: top;text-align: left;'>
				<label>Mensaje:</label><br>
				<textarea name='mensaje' cols="80" rows="3"  style='font-size: 2rem; margin:2rem;padding: 1rem;' disabled></textarea><br>
				<input type="radio" name="verMensaje" value="1" checked disabled>		<label>Publicar mi Mensaje</label><br>
				<input type="radio" name="verMensaje" value="0" disabled>				<label>No publicar mi Mensaje</label>
			</div>

			<div style='padding: 1rem; display:inline-block; vertical-align: bottom;'>
				<button type='submit' name='nuevo' value='si' style='font-size: 3rem;' disabled> Enviar </button>
			</div>

		<!--/form -->
	</div>
</div>	

<div style='border:0px solid black;'><center>
<table style='width:80%;' class='tbl-row'>
	<tr style='font-size: 3rem;background-color:gray;'>
		<th>De</th>
		<th>Mensaje</th>
		<th>Fecha</th>
	</tr>

	<?php
	include("conecta.php");
	//################################################## Agrega el nuevo
	if($_POST["nuevo"]=="si" and $_POST["mensaje"]!= ""){ //echo "entra"; 
		$_SESSION['conteo']++;
	
		$NvoNombre=$_POST["nombre"];
		$NvoVerNombre=$_POST["verNombre"];
		$NvoMensaje=$_POST["mensaje"];
		$NvoVerMensaje=$_POST["verMensaje"];
		$fecha=date("Y-m-d");
		$hora=date("H:i");

		$sql="INSERT INTO visitas (vis_autor, vis_publico, vis_fecha, vis_hora, vis_nombre,  vis_texto,     vis_verNombre,  vis_verTexto)
							VALUES('1',		  '0',         '$fecha',  '$hora',  '$NvoNombre','$NvoMensaje', '$NvoVerNombre','$NvoVerMensaje')";
		if($_SESSION['conteo']=='1'){
			$result=mysqli_query($conn,$sql);
			//echo $sql;
			if(!$result){echo "Error al generar el nuevo registro en el libro de visitas";}
		}
		$_POST["nuevo"]="no";
	}
	$_POST["nuevo"]="no";


	//################################################## Muestra visitas previs
	$sql="SELECT * FROM visitas where vis_autor='1' and vis_publico='1' order by vis_id DESC";
	$result=mysqli_query($conn,$sql);
	while($row=$result->fetch_assoc() ){
		$fecha = $row["vis_fecha"];
		$nombre= $row["vis_nombre"];
		$texto= $row["vis_texto"];
		$verNombre=$row["vis_verNombre"];
		$verTexto=$row["vis_verTexto"];

		echo "<tr style='padding:1rem;font-size:2rem;' class='tbl-row'>";
			echo "<td style='padding:1rem;'>";
				
				if($verNombre=='1'){echo $nombre;}else{echo " --------- ";}
			echo "</td>";

			echo "<td style='padding:1rem;'>";
				if($verTexto=='1'){echo $texto;}else{echo " --------- ";}
			echo "</td>";

			echo "<td style='padding:1rem;'>".$fecha."</td>";
		echo "</tr>";
	}	
	
	?>
</table>
</div>
	</main>