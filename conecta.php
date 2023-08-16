<?php
// ###############################################  Conexión localhost
$servername = "localhost";
$username = "c2470538_elma";  
$password = "ru64roVAro";     
$dbname = "c2470538_elma";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
date_default_timezone_set('America/Mexico_City');
if ($conn->connect_error) {echo "Error de conexión general con la base!!!";die();}



/*
//variables generales
$mes=array("cero", "enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre","enero");
$mes2=array("cero", "ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic","ene");
//variables parametrizables
$RutaArchivo="./recibos/"; //Carpeta donde ser van a guardar y leer todos los recibos
*/
?>
