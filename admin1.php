<?php session_start();?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Admin</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">


</head>

<body>
<?php 

include("conecta.php");
include("cabecera_elma.php"); 

$pass=$_POST["pass"];
$nombre=$_POST["nombre"];


$sql="SELECT * FROM usr where usr_alias='$nombre' and usr_pass ='$pass' and usr_act='1'  ";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
if($num != '1'){
	$_SESSION['tipo']='0';
	$_SESSION['usr']=NULL;
	session_destroy();

	echo "<br><br><br><div style='font-size:2rem;color:red;'><center>";
		echo "Nombre de usuario o password no válido<br><br>";
		echo "<a href='admin.php'><button type='button'  style='font-size:2rem;'> Regresar</button></a>";
	echo "</div>";
	
}else{
	while($row=$result->fetch_assoc() ){
		
		$_SESSION['tipo']='1';
		$_SESSION['usr']=$row["usr_name"];
		
		echo "<br><br><br><div style='font-size:2rem;'><center>";
		echo "Hola ".$_SESSION['usr'].",<br>!! Bienvenid@ ¡¡ <br><br>";
		echo "<a href='visitas_elmaAdmin.php'><button type='button' style='font-size:2rem; margin:1rem;padding:1rem;'> Ingresar al módulo de Administración </button></A><br>";
		//echo "Sesion: ".$_SESSION["tipo"];	
		
	}
}

?>



<main>
<center>
<?php
?>
<br><br>

<br><br>
