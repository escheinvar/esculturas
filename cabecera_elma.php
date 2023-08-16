<?php session_start();?>
<html lang="es">



<header>
	<div class='cabecera'>Elma Gottdiener esculturas</div>
	<script>
		
	</script>
</header>



<nav class='clearfix' style='font-size: 1rem;'>
	<center>
	<div class='menu1'><a href='elma.php'>Inicio</a></div>
	<div class='menu1'><a href='formacion_elma.php'>Formaci&oacute;n</a></div>
	<div class='menu1'><a href='criticas_elma.php'>Críticas</a></div>
	<div class='menu1'><a href='maderas_elma.php'>Maderas</a></div>
	<div class='menu1'><a href='bronces_elma.php'>Bronces</a></div>
	<div class='menu1'><a href='contacto_elma.php'>Contacto</a></div>
	<div class='menu1'><a href='visitas_elma.php'>Libro de visitas</a></div>
	<div class='menu1'><a href='ventas_elma.php'>Ventas</a></div>
	<?php
	if($_SESSION["tipo"] =='1'){
		echo "<br><font color=red>";
		echo "<div class='menu1'><a href='visitas_elmaAdmin.php'>Libro de visitas</a></div>";
		echo "<div class='menu1'><a href='fichas_admin.php'>Editar Obra</a></div>";
		echo "<div class='menu1'><a href='salir.php'>Salir</a></div>";
		echo "</font>";
	}
	?>
	</center>
</nav>