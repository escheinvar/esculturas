<?php session_start();?>
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
		.grupo{display: block; margin:1rem;padding: 1rem;}
		.campo1{display: inline-block; width: 150px; border: solid 0px black;vertical-align: top;font-size: 2rem;}
		.campo2{display: inline-block; border: solid 0px black;/*'display:inline-block; margin:1rem; padding:1rem; vertical-align:top;*/}
		input {font-size: 2rem;}
		select {font-size: 2rem;}
		textarea {font-size: 2rem;}
		
	</style>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>


<body>
<!--link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet"-->

<?php include("cabecera_elma.php"); ?>
<main>

<?php
include("conecta.php");
$autor='1';
echo "<form action='fichas_admin.php' method='post'>";
	echo "<div>";
		echo "<label style='font-size:2rem;'> Indica la obra que quieres editar: </label>";
		echo "<select name='obraID' id='obra'>";
			echo "<option value=''>Seleccionar opción</option>";
			echo "<option value='NuevoRegistro'>Ingresar Nueva Obra</option>";
			$sql="SELECT obra_id, obra_nombre from obra where obra_autor='".$autor."' ";
			$result=mysqli_query($conn,$sql);
			while($row=$result->fetch_assoc() ){
				if($row["obra_id"]==$_POST["obra_ID"]){$ja='selected';}else{$ja='';}
				echo "<option value='".$row["obra_id"]."' ".$ja." >".$row["obra_nombre"]."</option>";
			}
		echo "</select>";
		echo "<button type='submit' style='font-size:2rem;margin:1rem;'>Ver Datos</button>";
	echo "</div>";
echo "</form>";






//#################################################################### Inicia página
if($_POST["obraID"] !='' ){
	//foreach($_POST as $key=>$value){echo "-".$key."=".$value."<br>";}
	$obraID=$_POST["obraID"];
	if($obraID != 'NuevoRegistro'){
		$sql="SELECT * FROM obra WHERE obra_id='".$obraID."' AND obra_autor='".$autor."' ";
		$result=mysqli_query($conn,$sql);
		while($row=$result->fetch_assoc() ){
			$act=$row["obra_act"];
			$tipo=$row["obra_tipo"];
			$prefijo=$row["obra_prefijo"];
			$nombre=$row["obra_nombre"];
			$material=$row["obra_material"];
			$anio=$row["obra_anio"];
			$metodo=$row["obra_metodo"];
			$venta=$row["obra_venta"];
			$existencias=$row["obra_existencia"];
			$largo=$row["obra_largoCm"];
			$ancho=$row["obra_anchoCm"];
			$fondo=$row["obra_fondoCm"];
			$peso=$row["obra_pesoGr"];
			$precio=$row["obra_precio"];
			$obsObra=$row["obra_obs_Obra"];
			$obsMetodo=$row["obra_obs_Metodo"];
			$obsVenta=$row["obra_obs_Venta"];
			$fotos=$row["obra_fotos"];
			$titulo="Editando la obra ";
		}
	}else{
		$nombre="Registrando Nueva obra";$titulo="";
	}
	echo "<h1>".$titulo.$nombre."</h1>";
	$w1='150px;';
	


	//############################################ inicia formulario
	echo "<form action='fichas_admin1.php' method='post' enctype='multipart/form-data'>";
		echo "<input type='hidden' name='obraID' value='".$obraID."'>";
		echo "<input type='hidden' name='autor' value='".$autor."'> ";

		//------------------------ Ocultar
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Ocultar al público:</label>";
			echo "</div>";
			echo "<div class='campo2'>\n";
		        if($act=='1'){$ja='checked';$je='Activo';$ji="Ocultar";}else{$ja='';$je='Activar';$ji="Oculto";}
		        //echo "<b>Ocultar al público:</b>\n";
		        
		        echo $ji."<label class='switch'>\n";
		        echo "<input type='checkbox' ".$ja." id='act' name='act'>\n";
		        echo "<span class='slider round'></span>\n";
		        echo "</label>\n".$je;
		    echo "</div>\n";
	    echo "</div>";
		
		//---------------------------- Tipo General   
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Típo general:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				if($tipo=='Mad'){$ja="selected";$je=$ji='';}else if($tipo=='Bro'){$je="selected";$ja=$ji='';}else if($tipo=='Cer'){$ji="selected";$je=$ja='';}
				echo "<select name='tipo' id='tipo'>";
					echo "<option value='Mad' ".$ja.">Madera</option>";
					echo "<option value='Bro' ".$je.">Bronce</option>";
					echo "<option value='Cer' ".$ji.">Cerámica</option>";
				echo "</select>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Nombre   
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Nombre de la obra:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
			if($obraID == 'NuevoRegistro'){$nombre='';}
				echo "<input type='text' name='nombre' id='nombre' value='".$nombre."' required>";
			
			echo "</div>";
		echo "</div>";

		//---------------------------- Material
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Material:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='text' name='material' id='material' value='".$material."'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- año
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Año:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='anio' id='anio' value='".$anio."'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- método
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Método:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='text' name='metodo' id='metodo' value='".$metodo."'>";
			echo "</div>";
		echo "</div>";

		//------------------------ Venta
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Ofrecer en venta:</label>";
			echo "</div>";
			echo "<div class='campo2'>\n";
		        if($venta=='1'){$ja='checked';$je='Si está a la venta';$ji='Dejar de vender';}else{$ja='';$je='ofrecer a venta';$ji='No está a la venta';}
		        //echo "<b>Ocultar al público:</b>\n";
		        echo $ji."<label class='switch'>\n";
		        echo "<input type='checkbox' ".$ja." id='venta' name='venta'>\n";
		        echo "<span class='slider round'></span>\n";
		        echo "</label>\n".$je;
		    echo "</div>\n";
	    echo "</div>";


		//---------------------------- Precio
		echo "<div class='grupo'>";
			echo "<div class='campo1' id='verPrecio'>";
				echo "<label>Precio:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='precio' id='precio' min='0' value='".$precio."' step='any'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Existencias
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Existencias:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='existencias' id='existencias' min='0' value='".$existencias."'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Largo
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Largo (cm):</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='largo' id='largo' value='".$largo."' step='any'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Ancho
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Ancho (cm):</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='ancho' id='ancho' value='".$ancho."' step='any'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Fondo
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Alto (cm):</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='fondo' id='fondo' value='".$fondo."' step='any'>";
			echo "</div>";
		echo "</div>";

		//---------------------------- peso
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Peso (gr):</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<input type='number' name='peso' id='peso' value='".$peso."' step='any'>";
			echo "</div>";
		echo "</div>";
		//---------------------------- Obse obra
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Observaciones a la Obra:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<textarea name='ObsObra' id='ObsObra' rows='3' cols='35'>".$obsObra."</textarea>";
			echo "</div>";
		echo "</div>";

		//---------------------------- Obs metodo
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>observaciones al método: </label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<textarea name='ObsMet' id='ObsMet' rows='3' cols='35'>".$obsMetodo."</textarea>";
			echo "</div>";
		echo "</div>";
		//---------------------------- Obs venta
		echo "<div class='grupo'>";
			echo "<br>";
			echo "<div class='campo1'>";
				echo "<label>Observaciones a la venta:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				echo "<textarea name='ObsVenta' id='ObsVenta' rows='3' cols='35'>".$obsVenta."</textarea>";
			echo "</div>";
		echo "</div>";
		//---------------------------- fotos
		echo "<div class='grupo'>";
			echo "<div class='campo1'>";
				echo "<label>Fotos:</label>";
			echo "</div>";
			echo "<div class='campo2'>";
				$fotillos=explode('@',$fotos);
				if($fotos != ""){
					foreach($fotillos as $key=>$value){
						echo "<div style='display:inline-block;text-align:center; border:solid 1px gray; margin:1rem;padding:1rem;' >";
							echo $key + 1;
							if($key=='0'){echo " Portada";}
							echo "<br>";
							echo "<a href='img/".$value."' target='new'><img src='img/".$value."' style='max-width:200px; max-height:200px;'></a>";

							echo "<input type='hidden' name='foto.".$key."' value='".$value."'>";
							echo "<br>".$value."<br><i class='far fa-trash-alt'></i><input type='checkbox' id='foto_".$key."' name='fotoBorra_".$key."' value='".$value."'>";
						echo "</div>";
					}
				}	
				echo "<i class='fas fa-camera-retro'></i> <input type='file' name='fotoNueva'> ";
			echo "</div>";
		echo "</div>";

		echo "<br>";
		echo "<div style='text-align:center;'> <button type='submit' style='font-size:2rem;'> Guardar cambios </button> </div>";
	echo "</form>";
	echo "<br>";
	echo "<br>";
}

?>

