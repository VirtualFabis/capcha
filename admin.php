<?php
ob_start() ;
?>
<?php  
session_start();
if (!isset($_SESSION['email'])) {
	header('Location: index.php');
}elseif(isset($_SESSION['email'] )){
	include 'cnn.php';

	$sentencia = $cnnPDO->query("SELECT * FROM usuarios;");
	$alumnos = $sentencia->fetchAll(PDO::FETCH_OBJ);


}else{
	echo "Error en el sistema";
}



?>
<?php
     //Valida que el usuario hizo clik en el Boton 
if (isset($_POST['actualizar'])) 
{
    //Trae datos del formulario
	$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	$celular=$_POST['celular'];
	$password=$_POST['password'];

        //Validar que las cajas no esten vacias
	if (!empty($nombre) && !empty($email) && !empty($celular) && !empty($password))
	{
               //Actualizamod los datos en la tabla de la db  
		$sql = $cnnPDO->prepare(
			'UPDATE user SET nombre = :nombre, email = :email, celular = :celular, password = :password WHERE email = :email'
		);

              //Asignar las variables a los campos de la tabla
		$sql->bindParam(':nombre',$nombre);
		$sql->bindParam(':email',$email);
		$sql->bindParam(':celular',$celular);
		$sql->bindParam(':password',$password);

              //Ejecutar la variable $sql
		$sql->execute();
		unset($sql);
		unset($cnnPDO);


	session_start();
	session_destroy();
	
	header('Location: index.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	
	<title>Bienvenido</title>
	<link rel="icon" href="images/xd.png" />
	<!-- MDB 4.19.0 -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">

	<!-- JavaScrip -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>


 <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script > 


<style type="text/css">
	@media screen (max-width:1024px) and (min-width: 600px){

} 
	
	a {
  font-size: 25px;
  line-height: 50px;
  text-align: center;
  width: 100px;
  height: 50px;
}
</style>

</head>
<body>
	<body background="images/neg.jpg">
		<!--Navbar-->
		<nav class="navbar navbar-expand-lg navbar-dark unique-color-dark">
			<!-- Navbar brand -->
			<a class="navbar-brand" href="">Bienvenido Administrador</a>
			<!-- Collapse button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
			aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- Collapsible content -->
		<div class="collapse navbar-collapse" id="basicExampleNav">
			


	</ul>
	<ul class="navbar-nav ml-auto nav-flex-icons">


		<form method="POST" action="cerrar.php">


			<button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">Cerrar sesion</button>

		</form>

	</ul>

</div>
<!-- Collapsible content -->
</nav>

<div class=" my-11 p-5 z-depth-10 unique-color-dark">
<center>
	
<br>
		<div class="row">
			<div class="col-md-5">
				<!-- Card -->
				<div class="card">

					<!-- Card image -->
					<div class="view overlay">
						<img class="card-img-top" src="https://conastec.es/wp-content/uploads/2018/07/250130-P48MNV-852.jpg" width="200" height="250" 
						alt="Card image cap">
						<a href="#!">
							<div class="mask rgba-white-slight"></div>
						</a>
					</div>

					<!-- Card content -->
					<div class="card-body">
						<center>
							<!-- Title -->
							<h4 class="card-title">Ver  usuarios</h4>
							<!-- Text -->
							<p class="card-text"><h6>Podras ver a todos los usuarios registrados.</h6></p>
							<!-- Button -->
							<a href="usuarios.php" class="btn btn-primary">Ir</a>

						</center>
					</div>

				</div>
				<!-- Card -->
			</div>

						<div class="col-md-2">
						</div>

		<div class="col-md-5">
				<!-- Card -->
				<div class="card">

					<!-- Card image -->
					<div class="view overlay">
						<img class="card-img-top" src="https://conceptodefinicion.de/wp-content/uploads/2020/11/usuario.jpg" width="200" height="250" 
						alt="Card image cap">
						<a href="#!">
							<div class="mask rgba-white-slight"></div>
						</a>
					</div>

					<!-- Card content -->
					<div class="card-body">
						<center>
							<!-- Title -->
							<h4 class="card-title">Ver  contactos</h4>
							<!-- Text -->
							<p class="card-text"><h6>Podras ver a todos los contactos de los usarios.</h6></p>
							<!-- Button -->
							<a href="contactos.php" class="btn btn-primary">Ir</a>

						</center>
					</div>

				</div>
				<!-- Card -->
			</div>


</body>
</html>


<?php
ob_end_flush();
?>
