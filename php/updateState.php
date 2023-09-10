<?php
include("database.php");

if (isset($_POST['dni'])) {
  $dni = $_POST['dni'];
  $infoUpdate = $_POST['infoUpdate'];
  $value = $_POST["value"];


  if($value == 1) {
  // Actualizar el valor de "atencion" a "Si" para el registro con el DNI especificado
  $actualizarConsulta = "UPDATE victimas SET estado = '$infoUpdate' WHERE dni = '$dni'";
  $actualizarResultado = mysqli_query($connection, $actualizarConsulta);
  }
  else {
  // Actualizar el valor de "atencion" a "Si" para el registro con el DNI especificado
  $actualizarConsulta = "UPDATE agresores SET informe = '$infoUpdate' WHERE dni = '$dni'";
  $actualizarResultado = mysqli_query($connection, $actualizarConsulta);
  }




} 
?>
