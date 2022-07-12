<?php

$cnx = mysqli_connect("localhost","root","","fabis") or die("Error De Conexion");

$nombre=$_POST['nombre'];
$email=$_POST['email'];
$celular=$_POST['celular'];
$password=$_POST['password'];

$sql = "INSERT into usuarios
(nombre, email, celular, password) values ('$nombre','$email','$celular','$password')";
echo mysqli_query($cnx,$sql);

?>