<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Formación</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">

	<style>
		.grupo{display: block; margin:1rem;}
		.campo1{display: inline-block; width: 150px; border: solid 0px black;vertical-align: top;}
		.campo2{display: inline-block; border: solid 0px black;/*'display:inline-block; margin:1rem; padding:1rem; vertical-align:top;*/}
	</style>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

	<script>
	    window.onload = function(){
		  document.forms['EditaFicha'].submit();
		}
    </script>
</head>




<!--link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet"-->

<?php include("cabecera_elma.php"); ?>
<main>

<?php
include("conecta.php");

$obraID=$_POST["obraID"];
$autor=$_POST["autor"];
if($_POST["act"] == 'on' ){$act='1';}else{$act='0';} 
$tipo=$_POST["tipo"];
$nombre=$_POST["nombre"];
$material=$_POST["material"];
$anio=$_POST["anio"];
$metodo=$_POST["metodo"];
if($_POST["venta"]=='on'){$venta='1';}else{$venta='0';}
$precio=$_POST["precio"];
$existencias=$_POST["existencias"];
$largo=$_POST["largo"];
$ancho=$_POST["ancho"];
$fondo=$_POST["fondo"];
$peso=$_POST["peso"];
$ObsObra=$_POST["ObsObra"];
$ObsMet=$_POST["ObsMet"];
$ObsVenta=$_POST["ObsVenta"];
$prefijo=preg_replace('/ /', '',$nombre);


//################################################# Sube fotos

if($_FILES["fotoNueva"]["size"] > 0){
	//foreach ($_FILES["fotoNueva"] as $key=>$value){echo "-".$key."=".$value."<br>";}
	//echo "va".$_FILES["fotoNueva"]["name"];
    $extensions= array("jpeg","jpg","png","pdf","tif","tiff");  //poner extensiones en minúscula
    $MaxSizeAllow=104857600;         //bits máximo de carga
    $RutaFin="img/";              //ruta de depósito de archivos
    foreach($_FILES as $key=>$value){
        //(files)-------- Obtiene datos del $_FILE
        $FileName=$value['name']; 
        $FileType=$value['type'];
        $FileTmpName=$value['tmp_name'];
        $FileError=$value['error'];
        $FileSize=$value['size'];


        $errors=array();

        if($FileName != "" OR $FileName != NULL){
        	$FileExt=preg_replace('/.*\./','',$FileName);
        	$FileName=str_replace(".".$FileExt,     "_".date("ymdHis").".".$FileExt,      $FileName);//echo $FileName;
        	$FileRutaFin=$RutaFin.$FileName;
        	
        }else {
            $errors[]="No se adjuntó ningún archivo";
            $FileRutaFin=NULL;
            $FileExt=NULL;
        }

        //(files)------------- Revisa extensión y posibles errores
        $phpFileUploadErrors = array( 0 => 'There is no error, the file uploaded with success',  1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',  2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',   3 => 'The uploaded file was only partially uploaded',   4 => 'No file was uploaded',  6 => 'Missing a temporary folder', 7 => 'Failed to write file to disk.', 8 => 'A PHP extension stopped the file upload.',   );
        if($FileError > 0){$error[]=$phpFileUploadErrors[$FileError];}
        if(in_array($FileExt,$extensions)=== false){$errors[]="Extensión no permitida, selecciona un archivo de tipo ".implode(", ",$extensions);}
        if($FileSize > $MaxSizeAllow){$errors[]="El archivo es mayor al tamaño permitido (".$MaxSizeAllow.")";}

        //(files)-------------- Si no hay error, lo sube
        if(count($errors)=='0'  ){
            move_uploaded_file($FileTmpName, $FileRutaFin);
            chmod($FileRutaFin, 0666);
            $mensajeBien2='Se subió correctamente la foto '.$FileName;
        }else{
            echo "<br><br>Error al subir el archivo:".$FileName.implode("<br>",$errors);
            echo "<br><br><button style='font-size:24px' onclick=\"history.back();\"> Regresar </button></a><br><br>";
            die();
        }
    }
}else{
    $FileRutaFin=NULL;
    $FileName = NULL;

}





//################################################# Prepara Array de nombre de fotos
$fotos=array();
foreach($_POST as $key=>$value){ 
	//-- si hay foto, la agrega 
	if(preg_match('/foto_/', $key)){
		//echo "va:".$key."=".$value."<br>";
		$fotos[]=$value;
	}
	//-- si se pidió borrar, se quita
	if(preg_match('/fotoBorra_/', $key)){
		//echo "------".$key."=".$value."<br>";
		if (($clave = array_search($value, $fotos)) !== false) {
		    unset($fotos[$clave]);
		    unlink("img/".$value);
		}
	}
}
if($FileName != NULL ){$fotos[]=$FileName;}
$textoFotos=implode('@',$fotos);



//################################################ Genera cambio en base
//echo $obraID;
if($obraID == 'NuevoRegistro'){
	//echo "Insertando<br>";
	$sql="INSERT INTO obra (obra_autor, obra_act, 	obra_tipo, 	obra_prefijo, 	obra_nombre, 	obra_material,  obra_anio, 	obra_metodo, 	obra_venta, obra_existencia, 	obra_largoCm, 	obra_anchoCm, 	obra_fondoCm, 	obra_pesoGr, obra_precio, obra_obs_Obra, obra_obs_Metodo, obra_obs_Venta, obra_fotos)
					VALUES ('$autor', 	'$act', 	'$tipo',	'$prefijo',		'$nombre', 		'$material', 	'$anio',	'$metodo', 		'$venta', 	'$existencias', 	'$largo', 		'$ancho',  		'$fondo', 		'$peso', 	'$precio', 	  '$ObsObra', 	 '$ObsMet', 	  '$ObsVenta',	 '$textoFotos') ";
	$result=mysqli_query($conn,$sql);
	if(!$result){echo "Error de base de datos. No se pudo generar el nuevo registro";$mensajeBien1='Error!!!'.$sql;die();}else{$mensajeBien1='Se generó nuevo registro correctamente';}

}else{
	//echo "Editando<br>";
	$sql="UPDATE obra set  obra_autor='$autor', obra_act='$act', obra_tipo='$tipo', obra_prefijo='$prefijo',
	      obra_nombre='$nombre', obra_material='$material', obra_anio='$anio', obra_metodo='$metodo', 
	      obra_venta='$venta', obra_existencia='$existencias', obra_largoCm='$largo', obra_anchoCm='$ancho', 
	      obra_fondoCm='$fondo', obra_pesoGr='$peso', obra_precio='$precio', obra_obs_Obra='$ObsObra', 
	      obra_obs_Metodo='$ObsMet', obra_obs_Venta='$ObsVenta', obra_fotos='$textoFotos'
	      WHERE obra_id='$obraID'" ;
	$result=mysqli_query($conn,$sql);
	if(!$result){echo "Error de base de datos. No se pudo subir la información".$sql;$mensajeBien1='Error!!!';}else{$mensajeBien1='Obra editada correctamente';}
	
}
//echo $sql."<br>";






//##################### INICIA PÁGINA
//foreach ($_POST as $key => $value) {echo "-".$key."=".$value."<br>";}
ECHO "<BR><BR>";
echo "<div style='font-size:5rem;text-align:center;'>".$mensajeBien1."<br>".$mensajeBien2."</div>";;

$autor='1';
echo "<form action='fichas_admin.php' method='post' id='EditaFicha'>";
	echo "<div>";
		echo "<label> Indica la obra que quieres editar:</label>";
		echo "<select name='obraID' id='obra'>";
			echo "<option value=''>Seleccionar opción</option>";
			echo "<option value='NuevoRegistro'>Ingresar Nueva Obra</option>";
			$sql="SELECT obra_id, obra_nombre from obra where obra_autor='".$autor."' ";
			$result=mysqli_query($conn,$sql);
			while($row=$result->fetch_assoc() ){
				if($row["obra_id"]==$obraID){$ja='selected';}else{$ja='';}
				echo "<option value='".$row["obra_id"]."' ".$ja." >".$row["obra_nombre"]."</option>";
			}
		echo "</select>";
		echo "<button type='submit'>Editar</button>";
	echo "</div>";
echo "</form>";




?>

