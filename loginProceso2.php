<?php
ob_start() ;
?>
<?php 
session_start();
include_once 'cnn.php';

$email = $_POST['email'];
$contrasena = $_POST['password'];
$sentencia = $cnnPDO->prepare('select * from usuarios where 
	password = ? and email = ?;');
$sentencia->execute([$contrasena,$email]);
$datos = $sentencia->fetch(PDO::FETCH_OBJ);





if($email == "admin@gmail.com" AND $contrasena == "admin"){
	
	$_SESSION['email'] = $datos->email;
	$_SESSION['password'] = $datos->password;
	$_SESSION['nombre'] = $datos->nombre;
	$_SESSION['celular'] = $datos->celular;

	header('Location: admin.php');

}

elseif ($datos === FALSE) {

	$message = "Error! Verifica  tu  Usuario o Contraseña";
	echo "<script type='text/javascript' >alert('$message');
	window.location.href = 'index.php';
	</script>";

}


elseif($sentencia->rowCount() == 1){
	$_SESSION['email'] = $datos->email;
	$_SESSION['password'] = $datos->password;
	$_SESSION['nombre'] = $datos->nombre;
	$_SESSION['id'] = $datos->id;
	$_SESSION['celular'] = $datos->celular;
	
	header('Location: user.php');

}


?>
<?php
ob_end_flush();
?>
