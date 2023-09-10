<?php 

include("database.php");

$dni = $_POST["dni"];
$value = $_POST["value"];


if($value == 1) {
  $sql = "DELETE FROM victimas WHERE dni = '$dni'";
  $resultado = mysqli_query($connection,$sql);
}
else {
  $sql = "DELETE FROM agresores WHERE dni = '$dni'";
  $resultado = mysqli_query($connection,$sql);
}







?>