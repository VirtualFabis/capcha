<?php 

ob_start();

?>

<?php 
require_once 'cnn.php';

require_once 'cdn.html';

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
if (isset($_POST['enviar'])){

$cnx = mysqli_connect("localhost","root","","fabis") or die("Error De Conexion");


$id = $_SESSION['id'];
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$celular=$_POST['celular'];

$imgFile = $_FILES['imagen']['name'];
 $tmp_dir = $_FILES['imagen']['tmp_name'];
 $imgSize = $_FILES['imagen']['size'];
  
  
   $upload_dir = 'images/'; 
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
  
   $imagen = rand(1000,1000000).".".$imgExt;

       $url="images/".$imagen;


    
     if (move_uploaded_file($tmp_dir, $upload_dir . '/' . $imagen))
            {
               

               $sql = "INSERT into contactos
(id, nombre, email, celular, imagen) values ('$id','$nombre','$email','$celular','$url')";
 mysqli_query($cnx,$sql);




            }

}




?>

<?php
if (isset($_POST['buscar'])) 
{
	if (!empty($_POST['email'])|| $_POST['email']!="Ingresa el correo")
	{
				$cnx = mysqli_connect("localhost","root","","fabis") or die("Error De Conexion");

		$sql="SELECT * from contactos where email='$_POST[email]'";
		$registro=mysqli_query($cnx,$sql);
		$campo=mysqli_fetch_array($registro);
	}
}
?>


<?php 

//se verifica si se presiona el botón llamado validar
if (isset($_POST['eliminar'])) 
{
	if (!empty($_POST['email']))
	{
		$cnx = mysqli_connect("localhost","root","","fabis") or die("Error De Conexion");

		$sql="DELETE from contactos where email='$_POST[email]'";
		$registro=mysqli_query($cnx,$sql);
		header("location:user.php");
	}
}

?>

<?php
if (isset($_POST['actualizar'])){

$cnx = mysqli_connect("localhost","root","","fabis") or die("Error De Conexion");


$id = $_SESSION['id'];
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$celular=$_POST['celular'];

$imgFile = $_FILES['imagen']['name'];
 $tmp_dir = $_FILES['imagen']['tmp_name'];
 $imgSize = $_FILES['imagen']['size'];
  
  
   $upload_dir = 'images/'; 
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
  
   $imagen = rand(1000,1000000).".".$imgExt;

       $url="images/".$imagen;


    
     if (move_uploaded_file($tmp_dir, $upload_dir . '/' . $imagen))
            {
               

             mysqli_query($cnx, "UPDATE contactos set
			email='$_POST[email]',
			nombre='$_POST[nombre]',
			celular='$_POST[celular]',
			imagen='$url'
						where email='$_POST[email]'");




            }

}




?>

<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	
	<title>Usuario</title>
	<link rel="icon" href="images/xd.png" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>

    <!-- Libreria de sweetalert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>


	<style>

		@media screen (max-width:1024px) and (min-width: 600px){

		} 

		html {
			min-height: 100%;
			position: relative;
		}
		body {
			margin: 0;
			margin-bottom: 40px;
		}
		footer {
			position: absolute;
			bottom: 0;
			width: 100%;
			height: 50px;

		}

	</style>

</head>
<body>
	<section>	

		<!--Navbar -->
		<nav class="mb-1 navbar navbar-expand-lg navbar-dark  blue-gradient">


			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
			aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="#"><?php 

					echo " <h5> <i class='far fa-user-circle'></i> Bienvenido ",  $_SESSION['nombre'],"</h5> "  
					?>
					<span class="sr-only"></span>
				</a>
			</li>

		</ul>
		<ul class="navbar-nav ml-auto nav-flex-icons">
			<li class="nav-item">
				<a class="nav-link waves-effect waves-light">
					<i class="fab fa-twitter" ></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link waves-effect waves-light">
					<i class="fab fa-facebook"></i>
				</a>
			</li>
			<li class="nav-item">
			</li>
			
			<li>
			</li>

			<li><a href="cerrar.php"><button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">Cerrar sesion</button> </a></li>
		</ul>
	</div>
</nav>
</section>


<div class="container">

	<div class="row">
		<div class="col-md-4">
							<form class="login" method="post" enctype="multipart/form-data" id="frm-alumno" a>

				<h4 class="login-title"><i class="fas fa-list-ul fa-flip-horizontal"></i> Registra tus contactos</h4>

				<div class="md-form input-with-post-icon">
					<i class="fas fa-at input-prefix"></i>
					<input type="email" id="email" class="form-control" name="email"  value="<?php if (isset($_POST['buscar'])) echo $campo['email']?>">
					<label for="email">Email</label>
				</div>



				<div class="md-form input-with-post-icon">
					<i class="fas fa-user input-prefix"></i>
					<input type="text" id="nombre" class="form-control" name="nombre" autofocus  value="<?php if (isset($_POST['buscar'])) echo $campo['nombre']?>" >
					<label for="nombre">Nombre</label>
				</div>

				<!-- Email -->

				<!-- Celular -->
				<div class="md-form input-with-post-icon">
					<i class="fas fa-mobile-alt input-prefix"></i>
					<input type="number" id="celular" class="form-control" name="celular"  value="<?php if (isset($_POST['buscar'])) echo $campo['celular']?>">
					<label for="celul">Celular</label>
				</div>

				<div class="md-form input-with-post-icon">

					<i class="fas fa-images input-prefix"></i>
                <input type="hidden" name="imagen" value="<?php if (isset($_POST['buscar'])) echo $campo['imagen']?>" />


					<input type="file" class="form-control" id="imagen" name="imagen" >
				</div>


				<button type="submit" class="btn-floating btn-lg btn-default aqua-gradient" id="enviar" name="enviar"><i class="fas fa-plus"></i></button>



				<button type="submit" class="btn-floating btn-lg btn-default aqua-gradient" id="eliminar" name="eliminar"><i class="far fa-trash-alt"></i></button>

				<button type="submit" class="btn-floating btn-lg btn-default aqua-gradient" id="buscar" name="buscar"><i class="fas fa-search"></i></i></button>

				<button type="submit"class="btn-floating btn-lg btn-default aqua-gradient" id="actualizar"  name="actualizar"><i class="fas fa-retweet"></i></button>

			</form>
		</div>




		<div class="col-md-8">



			<br>					

			<table class="table table-striped table-responsive-md btn-table">

				<thead>
					<tr>
						<th>Foto</th>
						<th>Correo</th>
						<th>Nombre</th>
						<th>Celular</th>
					</tr>
				</thead>
				<?php
				$sql = "SELECT * FROM contactos  where id='$_SESSION[id]'"; 
				$query = $cnnPDO -> prepare($sql); 
				$query -> execute(); 
				$results = $query -> fetchAll(PDO::FETCH_OBJ); 

        
      
				if($query -> rowCount() > 0)   { 

					foreach($results as $result) { 
        
						?>
						<tbody>
							<tr class="small">
                              <td> <img src='<?php echo "".$result -> imagen.""; ?>'width="50" height="50" /> </td>
								<td><?php echo "".$result -> email."";?></td>
								<td><?php echo "".$result -> nombre."";?></td>
								<td><?php echo "".$result -> celular."";?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>

		</div>	
	</div>

</div>

</div>


<footer class="page-footer font-small blue-gradient py-3">

	<!-- Footer Elements -->
	<div class="container">

		<div class="row">
			<div class="col-md-6 d-flex justify-content-start">
				<!-- Copyright -->
				<div class="footer-copyright text-center bg-transparent">© 2021 Copyright:
					<a href="#"> Sandra</a>
				</div>
				<!-- Copyright -->
			</div>
			<div class="col-md-6 d-flex justify-content-end">

				<ul class="list-unstyled d-flex mb-0">
					<li>
						<a class="mr-3" role="button" href="https://www.facebook.com/fabis.ibarra.71/"><i class="fab fa-facebook-f"></i></a>
					</li>
					<li>
						<a class="mr-3" role="button" href=""><i class="fab fa-twitter"></i></a>
					</li>
					<li>
						<a class="mr-3" role="button"><i class="fab fa-instagram"></i></a>
					</li>
					<li>
						<a class="" role="button"><i class="fab fa-youtube"></i></a>
					</li>
				</ul>
			</div>
		</div>

	</div>
	<!-- Footer Elements -->

</footer>
</body>
</html>


<script type="text/javascript">
$(document).ready(function() {
    let emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $("#enviar").click(function() {

         if ($("#email").val() == "" || !emailreg.test($("#email").val())) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'email incorrecto, utilice un email válido '
            })
            return false;

        }

        else if ($("#nombre").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                //  Aqui pones el mensaje donde diga tittle
                title: 'Advertiencia!, por favor Debe de ingresar su nombre'
            })
            return false;

        }     else if ($("#celular").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                //  Aqui pones el mensaje donde diga tittle
                title: 'Advertiencia!, por favor Debe de ingresar su celular'
            })
            return false;

        }  else if ($("#imagen").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Debe de Seleccionar una imagen, llena este campo'
            })
            return false;

        } 

        

    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
    let emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $("#eliminar").click(function() {

         if ($("#email").val() == "" || !emailreg.test($("#email").val())) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Debes ingresar un email si deseas borrar un contacto'
            })
            return false;

        }
        

    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    let emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $("#buscar").click(function() {

         if ($("#email").val() == "" || !emailreg.test($("#email").val())) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Debes ingresar un email si deseas buscar un contacto'
            })
            return false;

        }
        

    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
    let emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $("#actualizar").click(function() {

         if ($("#email").val() == "" || !emailreg.test($("#email").val())) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'email incorrecto, utilice un email válido '
            })
            return false;

        }

        else if ($("#nombre").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                //  Aqui pones el mensaje donde diga tittle
                title: 'Advertiencia!, por favor Debe de ingresar su nombre'
            })
            return false;

        }     else if ($("#celular").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                //  Aqui pones el mensaje donde diga tittle
                title: 'Advertiencia!, por favor Debe de ingresar su celular'
            })
            return false;

        }  else if ($("#imagen").val() == "") {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Debe de Seleccionar una imagen, llena este campo'
            })
            return false;

        } 

        

    });

});
</script>


<?php
ob_end_flush();
?>