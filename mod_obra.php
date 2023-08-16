<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elma Gottdiener/Obra</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="elma.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


	<style>
		.carousel {
		    max-width: 1200px;
		    margin: 0 auto;
		    display: flex;
		}
		#imagen {
		    max-width: 100%;
		    height: 900px;
		    background-size: contain;
		    background-repeat: no-repeat;
		    border: 0px solid black;
		}
	</style>

	<?php
	//foreach ($_POST as $key => $value) {echo "-".$key."=".$value."<br>";
	include("conecta.php");
	$obraID=$_POST["obraID"];

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
		
		if($fotos=="" OR $fotos==NULL ){
			$fotos=array('talla.png');
		}else if(preg_match('/@/', $fotos) == TRUE) {
			$fotos=explode("@",$fotos);
		} else {
			$fotos=array($fotos);
		}
		
	}
	?>
	<!-- ///////////////////////////////////////////////// CARRUSEL ////////////////////////////////////////
	-- https://programadorwebvalencia.com/javascript-carousel-sencillo-con-controles-y-autoreproduccion/ -->
	<script type="text/javascript">
		
	    function VerNoVer() {
			var ofrece = document.getElementById('DivOfrece');
			var venta = document.getElementById('DivMuestra');
			var icono = document.getElementById('IconoOfrece');

			if (venta.style.display == "none") {
				venta.style.display = "inline-block";
				//icono.className = "fas fa-minus-circle";
				icono.innerHTML = "ver -";
			} else {
				venta.style.display = "none";
				//icono.className= "fas fa-plus-circle";
				icono.innerHTML = "	ver +";
			}
		}
	
		window.onload = function () {
		    // Variables
		    var ObtieneImagenes = document.getElementById('ImgsPaVer').innerHTML; //OBTIENE IMAGENES DESDE PHP
		    const IMAGENES = ObtieneImagenes.split(",");
		    console.log("VarIMAGENES:"+IMAGENES)
		    //const IMAGENES = [ 'img/bronce2.jpeg', 'img/bronce2_1.jpeg', 'img/bronce2_2.jpeg', 'img/bronce2_3.jpeg' ];

		    const TIEMPO_INTERVALO_MILESIMAS_SEG = 2000;
		    let posicionActual = 0;
		    let $botonRetroceder = document.querySelector('#retroceder');
		    let $botonAvanzar = document.querySelector('#avanzar');
		    let $imagen = document.querySelector('#imagen');
		    let $botonPlay = document.querySelector('#play');
		    let $botonStop = document.querySelector('#stop');
		    let intervalo;

		    
		    /**Funcion que cambia la foto en la siguiente posicion */
		    function pasarFoto() {
		        if(posicionActual >= IMAGENES.length - 1) {
		            posicionActual = 0;
		        } else {
		            posicionActual++;
		        }
		        renderizarImagen();
		    }

		    /** Funcion que cambia la foto en la anterior posicion */
		    function retrocederFoto() {
		        if(posicionActual <= 0) {
		            posicionActual = IMAGENES.length - 1;
		        } else {
		            posicionActual--;
		        }
		        renderizarImagen();
		    }

		    /**Funcion que actualiza la imagen de imagen dependiendo de posicionActual */
		    function renderizarImagen () {
		        $imagen.style.backgroundImage = `url(${IMAGENES[posicionActual]})`;
		        $imagen.style.backgroundPosition = 'center center';

		    }

		    /** Activa el autoplay de la imagen */
		    function playIntervalo() {
		        intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
		        // Desactivamos los botones de control
		        $botonAvanzar.setAttribute('disabled', true);
		        $botonRetroceder.setAttribute('disabled', true);
		        $botonPlay.setAttribute('disabled', true);
		        $botonStop.removeAttribute('disabled');
		    }

		    /*** Para el autoplay de la imagen */
		    function stopIntervalo() {
		        clearInterval(intervalo);
		        // Activamos los botones de control
		        $botonAvanzar.removeAttribute('disabled');
		        $botonRetroceder.removeAttribute('disabled');
		        $botonPlay.removeAttribute('disabled');
		        $botonStop.setAttribute('disabled', true);
		    }

		    // Eventos
		    $botonAvanzar.addEventListener('click', pasarFoto);
		    $botonRetroceder.addEventListener('click', retrocederFoto);
		    $botonPlay.addEventListener('click', playIntervalo);
		    $botonStop.addEventListener('click', stopIntervalo);
		    // Iniciar
		    renderizarImagen();
		} 
	</script>
</head>
<?php
include("cabecera_elma.php");
echo "<div id='ImgsPaVer' style='display:none;'>'img/".implode("', 'img/",$fotos)."'</div>";




echo "<div class='clearfix' style='width:90%; border:solid 0px black; margin:0 auto; text-align:center;padding:2rem;'>";
	echo "<div>";
		echo "<h1>".$nombre."</h1>";	
		//---------------- INICIA CARRUSEL
		echo "<div class='carousel'>";
	    	echo "<button id='retroceder' style='background-color:white;border:0px;color:gray;'> << </button>";
	    	echo "<div id='imagen' style='width:100%;border:solid 0px black;' class='center'></div>";
	    	echo "<button id='avanzar' style='background-color:white;border:0px;color:gray;'> >> </button>";
		echo "</div>";
		echo "<div class='controles'>";
		    echo "<button id='play' style='color:gray;'>Rotar</button>";
		    echo "<button id='stop' style='color:gray;' disabled>Alto</button>";
		echo "</div>";
		//---------------- TERMINA CARRUSEL
	echo "</div>";
	

echo "<form action='mod_obra01.php' method='post'>";
	//############################################## Ficha técnica
	echo "<br><br>";	
	echo "<div style='border:solid 2px black; float:right; border-radius:1rem; text-align:left; font-size:2rem; padding:1rem;'>";
		echo "<div style='padding:0.5rem;'><big><b>".$nombre."</b></big></div>";
		echo "<div style='padding:0.5rem;'>Año: ".$anio."</div>";
		echo "<div style='padding:0.5rem;'>Técnica: ".$metodo."</div>";
		echo "<div style='padding:0.5rem;'>Material: ".$material."</div>";
		echo "<div style='padding:0.5rem;'>Medidas: ".$largo."cm x".$ancho."cm x ".$fondo."cm</div>";
		echo "<div style='padding:0.5rem;'>Autor: ".$nombreAut." ".$ap1." ".$ap2."</div>";

		if($venta=='1'){
				echo "<div style='padding:0.5rem;'>Precio: $".number_format($precio, 2, ".", ",")." pesos</div>";
				echo "<div style='padding:0.5rem; text-align:right;'>";
					echo "<input type='hidden' name='ObraID' value='".$obraID."' >";
					echo "<button type='submit' style='padding:0.5rem; font-size:1.5rem; border-radius:0.5rem;'> ! Quiero tenerla ! </button>";
				echo "</div>";
			}
		
		//################################################### Datos extra
		/*
		echo "<div id='DivMuestra' style='border:solid 0px black; text-align:left; width:100%; display:none;'><br>";
			//echo "<div style='padding:0.5rem;'>Largo: ".$largo." cm</div>";
			//echo "<div style='padding:0.5rem;'>Ancho: ".$ancho." cm</div>";
			//echo "<div style='padding:0.5rem;'>Fondo: ".$fondo." cm</div>";
			echo "<div style='padding:0.5rem;'>Peso: ".$peso." gr</div>";
			//################################################### Datos de venta
		
			if($venta=='1'){
				echo "<div style='padding:0.5rem;'>Precio: $".number_format($precio, 2, ".", ",")." pesos</div>";
				echo "<div style='padding:0.5rem; text-align:right; font-weight:bold; color:gray;'>";
					echo "<input type='hidden' name='ObraID' value='".$obraID."' >";
					echo "<button type='submit' style='padding:0.3rem; font-size:1rem; border-radius:0.5rem;'> ! qQuiero tenerla ! </button>";
				echo "</div>";
			}else{
				echo "<div style='padding:0.5rem;'> No a la venta </div>";
			}
		echo "</div>";	
		
		echo "<div id='DivOfrece' style='float:right;' onclick=\"VerNoVer();\"	 >";
			echo "<i id='IconoOfrece' >ver +</i>";
		echo "</div></a>";
		*/
	echo "</div>";
echo "</div>";
echo "</form>";




echo "<br><br><br>";
?>

