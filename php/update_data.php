<?php
// Conexión a la base de datos
include("database.php");

// Obtén los datos del formulario de edición
$idUsuario = $_POST['id'];
$nuevoDni = $_POST['dni'];
$nuevoNombre = $_POST['nombre'];
$nuevoUser = $_POST['user'];
$nuevoRol = $_POST['rol'];

// Actualiza los datos en la base de datos
if(isset($_POST["save"])) {
  $consulta = "UPDATE users SET dni='$nuevoDni', nombre='$nuevoNombre', user='$nuevoUser', rol='$nuevoRol' WHERE id='$idUsuario'";
  $resultado = mysqli_query($connection, $consulta);

  // Recarga la página
  echo "<script>location.reload();</script>";
}

// Cierra la conexión a la base de datos
mysqli_close($connection);
?>
