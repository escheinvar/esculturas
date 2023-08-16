<!-- html lang="es"-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Bronces</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">

	<script type="text/javascript">

		function VerObra(valorID){
			console.log("dato:"+valorID);
			document.getElementById('obraID').value = valorID
			document.getElementById('formularioObra').submit()
		}
	</script>
</head>

<body>
<?php include("cabecera_elma.php"); ?>
<div style='text-align: center; color:gray;'><i><small>Selecciona la escultura que deseas ver</i></small></div>


<main>
<form action='mod_obra.php' method='post' id='formularioObra'>
	<input type='hidden' name='obraID' id='obraID'>
</form>
<br><br>

<?php
include("conecta.php");
echo "<div class='clearfix' style='width:90%; margin: 0 auto; text-align:center; '>\n";
	$sql="SELECT * FROM obra WHERE obra_act='1' AND obra_autor='1' AND obra_tipo='Mad' ";
	$result=mysqli_query($conn,$sql);
	while($row=$result->fetch_assoc() ){ 
		$obraID=$row["obra_id"];
		$prefi=$row["obra_prefijo"];
		$nombre=$row["obra_nombre"];
		$fotos=$row["obra_fotos"]; //echo "va:".$fotos;
		if($fotos=="" OR $fotos==NULL ){
			$fotos=array('talla.png');
		}else if(preg_match('/@/', $fotos) == TRUE) {
			$fotos=explode("@",$fotos);
		} else {
			$fotos=array($fotos);
		}

		//echo "\n<!-- ------------------------------------------ $prefi ------------------------------------ -->\n";
		echo "<div class='escultura'><center>\n";
			echo "<a href='#' name='$obraID' onclick=\"VerObra('".$obraID."');\"> <img src='img/".$fotos[0]."' style='max-height:300px;' /><br><font color='gray'><big>".$nombre."</font></big> </a>\n";
		echo "</div>\n";
	}
echo "</div>\n";
?>


</main>

