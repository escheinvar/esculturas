<?php
session_start();
?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Obra</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>


<?php
include("cabecera_elma.php");
include("conecta.php");
//foreach ($_POST as $key => $value) {echo "-".$key."=".$value."<br>";}

$obraID=$_POST["ObraID"];

$sql="SELECT * FROM obra   LEFT JOIN autores ON obra.obra_autor = autores.aut_id   where obra_id='".$obraID."' "; 
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=$result->fetch_assoc() ){
	$tipo = $row["obra_tipo"];
	$prefijo = $row["obra_prefijo"];
	$nombre = $row["obra_nombre"];
	$anio = $row["obra_anio"];
	$metodo = $row["obra_metodo"];
	$material = $row["obra_material"];
	$venta = $row["obra_venta"];
	$existencia = $row["obra_existencia"];
	$largo = $row["obra_largoCm"];
	$ancho = $row["obra_anchoCm"];
	$fondo = $row["obra_fondoCm"];
	$peso = $row["obra_pesoGr"];
	$precio = $row["obra_precio"];
	$nombreAut = $row["aut_nombre"];
	$ap1 =$row["aut_apellido1"];
	$ap2=$row["aut_apellido2"];
	$fotos=$row["obra_fotos"]; //echo "va:".$fotos;
	if(preg_match('/@/', $fotos) == TRUE) {
		$fotos=explode("@",$fotos);
	} else {$fotos=array($fotos);}

}
echo "<form action='mod_correo.php' method='post'>";
echo "<div style='font-size:2rem;'>";
	echo "<div style='display:inline-block; border:solid 0px black;'>";
		echo "Gracias por mostrar interés en <b>".$nombre."</b>:<br>";
		echo "<img src='img/".$fotos[0]."' style='max-width:500px;'>";
		echo "<input type='hidden' name='obra' value='".$nombre."'>";
	echo "</div>";

	echo "<div style='display:inline-block;vertical-align:top;margin:2rem;padding:1rem;'>";
		echo $nombre." tiene un costo de $".number_format($precio, 2, ".", ",")." pesos más gastos de envío<br>";

		echo "Por favor, indícanos tus datos para cotizar el envío:<br>";
		
		echo "<div style='padding:1rem;'>";
			echo "<label>Nombre: *</label><br>";
			echo "<input type='text' name='nombre' style='font-size:2rem; padding:0.7rem;' required>";
		echo "</div>";

		echo "<div style='padding:1rem;'>";
			echo "<label>Correo electrónico: *</label><br>";
			echo "<input type='text' name='correo' style='font-size:2rem; padding:0.7rem;' required>";
		echo "</div>";

		echo "<div style='padding:1rem;'>";
			echo "<label>Teléfono: </label><br>";
			echo "<input type='text' name='tel' style='font-size:2rem; padding:0.7rem;'>";
		echo "</div>";

		echo "<div style='padding:1rem;'>";
			echo "<label>Dirección de envío: *</label><br>";
			echo "<input type='text' name='dir' style='font-size:2rem; padding:0.7rem;' required>";
		echo "</div>";

		echo "<div style='padding:1rem;'>";
			echo "<label>Observaciones:</label><br>";
			echo "<textarea name='observa' cols=50 rows=3  style='font-size:2rem; padding:0.7rem;'></textarea>";
		echo "</div>";

		echo "<div style='padding:1rem;'>";
			echo "<button type='submit'  name='tipo' value='obra' style='font-size:2rem;'> Solicitar </button>";
		echo "</div>";
	echo "</div>";
	echo "<div>En breve, la autora se pondrá en contacto contigo para acordar la entrega</div>";
echo "<div>";
echo "<br><br>";
$_SESSION['conteo']='0';
?>
