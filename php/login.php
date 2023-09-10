<?php
include("database.php");
session_start();

$user = $_POST["user"];
$pass = $_POST["pass"];

if (empty($user) || empty($pass)) {
    header('Location: ../index.php?error=empty_fields');
    exit;
}

$consulta = "SELECT * FROM users WHERE user = '$user'";
$resultado = mysqli_query($connection,$consulta);

if(mysqli_num_rows($resultado) > 0) {
    $registro = mysqli_fetch_assoc($resultado);
    $hashedPassword = $registro['pass'];

    if (password_verify($pass, $hashedPassword)) {
        $_SESSION["username"] = $user;
        header('Location:../home.php');
    } else {
        header('Location: ../index.php?error=invalid_credentials');
        exit;
    }
} else {
    header('Location: ../index.php?error=invalid_credentials');
    exit;
}
?>
