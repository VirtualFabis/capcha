<meta charset="utf-8">

<?php 
# CDN de MDB 4.19.0
require_once 'cdn.html';
?>

<?php

/* Conectar a una base de datos de MySQL Local */
$db_host = 'mysql:dbname=fabis;host=localhost';
$usuario = 'root';
$contrasena = '';

//$db_host = 'mysql:dbname=id14249956_db_web;host=localhost';
//$usuario = 'id14249956_fabis';
//$contrasena = 'Samdog88****';

try {
	$cnnPDO = new PDO($db_host, $usuario, $contrasena);
} catch (PDOException $e) {

	echo "<br><br><center>
	<div class='card text-white bg-danger mb-3' style='max-width: 50rem;'>
	<div class='card-header'><h3>Error de Conexión</h3></div>
	<div class='card-body'>
	<h4 class='card-title'>Ha surgido un error y no se puede conectar a la base de datos!</h4>
	<h5 class='card-title'>Detalle:</h5>
	<p class='card-text text-white'>". $e->getMessage()."</p>
	</div>
	</div>
	";




}

?>


