<?php
// Conexión a la base de datos
include("database.php");


$idUsuario = $_POST['id'];

  // Realizar la eliminación del usuario
  $consulta = "DELETE FROM users WHERE id='$idUsuario'";
  $resultado = mysqli_query($connection, $consulta);

  if($resultado) {
    header("Location: ../user-list.php?success=true");
  } else {
    // Manejar el error de eliminación
    header("Location: ../user-list.php?error=delete_failed");
  }



// Cierra la conexión a la base de datos
mysqli_close($connection);
?>
