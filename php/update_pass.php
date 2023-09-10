<?php
// Conexión a la base de datos
include("database.php");

// Verifica si el campo "password" del POST no está vacío
if (!empty($_POST['password'])) {
  $idUsuario = $_POST['id'];
  $nuevaPass = $_POST['password'];

  // Encriptar la contraseña utilizando password_hash
  $hashPass = password_hash($nuevaPass, PASSWORD_DEFAULT);

  $consulta = "UPDATE users SET pass='$hashPass' WHERE id='$idUsuario'";
  $resultado = mysqli_query($connection, $consulta);

  // Verifica si la consulta se ejecutó correctamente
  if ($resultado) {
    echo "success"; // Envía una respuesta de éxito al JavaScript
  } else {
    echo "error: " . mysqli_error($connection); // Envía una respuesta de error con el mensaje de error de MySQL
  }
}

// Cierra la conexión a la base de datos
mysqli_close($connection);
?>
