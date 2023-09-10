<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Host de la base de datos
$usuario = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$db = "sivige"; // Nombre de la base de datos

// Crear conexión
$connection  = new mysqli($host, $usuario, $password, $db);

// Verificar la conexión
if ($connection ->connect_error) {
    die("Error de conexión: " . $connection ->connect_error);
}

// Si la conexión se realizó correctamente, puedes ejecutar consultas a la base de datos aquí

// Cerrar la conexión

?>
