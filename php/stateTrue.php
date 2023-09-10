<?php
include("database.php");

if (isset($_POST['dni'])) {
  $dni = $_POST['dni'];

  // Actualizar el valor de "atencion" a "Si" para el registro con el DNI especificado
  $actualizarConsulta = "UPDATE victimas SET atencion = 'Si' WHERE dni = '$dni'";
  $actualizarResultado = mysqli_query($connection, $actualizarConsulta);


} 
?>
