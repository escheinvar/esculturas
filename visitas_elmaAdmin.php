<?php 
session_start();
if($_SESSION['tipo'] != '1'){echo "No tienes autorización para entrar"; die();}
?>
<html lang="es">
<head>
	<meta charset="utf-8">
    <title>Elma Gottdiener/Contacto</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">
</head>

<body>
<main>


<?php
include("cabecera_elma.php");
include("conecta.php");
//################################################## Agrega el nuevo

if($_POST["editar"]=="si" ){
	foreach($_POST as $key=>$value){
		//echo "-".$key."=".$value."<br>";
		if($value=='ver'){
			$sql="UPDATE visitas SET vis_publico='1' WHERE vis_id='$key' ";
			echo "Ver".$key." ";
		}else if($value=='NoVer'){
			$sql="UPDATE visitas SET vis_publico='0' WHERE vis_id='$key' ";
			echo "NoVer".$key." ";
		}
		$result=mysqli_query($conn,$sql);
	}
	$_POST=array();
}






//################################################## Muestra visitas previs
echo "<h1>Administración de Libro de visitas</h1>";
echo "<form action='visitas_elmaAdmin.php' method='post'>";
	echo "<table border=0 width=90%>";
		echo "<thead>";
		echo "<tr>";
			echo "<th>Borrar</th>";
			echo "<th>De</th>";
			echo "<th>Fecha</th>";
			echo "<th>Mensaje</th>";
		echo "</tr>";
		echo "</thead>";

		echo "<tbody>";
		$sql="SELECT * FROM visitas where vis_autor='1' order by vis_id DESC ";
		$result=mysqli_query($conn,$sql);
		while($row=$result->fetch_assoc() ){
			$id=$row["vis_id"];
			$publico=$row["vis_publico"];
			$fecha = $row["vis_fecha"];
			$nombre= $row["vis_nombre"];
			$texto= $row["vis_texto"];
			$verNombre=$row["vis_verNombre"];
			$verTexto=$row["vis_verTexto"];

			echo "<tr style='padding:1rem;'>";
				echo "<td style='padding:1rem;'>";
					if($publico=='0'){$ja1='checked';$ja2='';}else{$ja1='';$ja2='checked';}
					echo $id." ver<input type='radio' name='".$id."' value='ver' ".$ja2.">";
					echo " | NoVer<input type='radio' name='".$id."' value='NoVer' ".$ja1.">";
				echo "</td>";

				echo "<td style='padding:1rem;'>";
					if($verNombre=='0'){echo "<font color='blue'>";$ja=' <small>{oculto}</small>';}else{$ja='';}
					echo $nombre.$ja;

				echo "</td>";

				echo "<td style='padding:1rem;'>".$fecha."</td>";

				echo "<td style='padding:1rem;'>";
					if($verTexto=='0'){echo "<font color='blue'>";$ja=' <small>{oculto}</small>';}else{$ja='';}
					echo $texto.$ja;
				echo "</td>";
			echo "</tr>";
		}
		echo "<tbody>";
	echo "</table>";
	echo "<button type='submit' name='editar' value='si' style='font-size:2rem;margin:2rem;'> Editar </button>";
echo "</form>";

?>

</main>
