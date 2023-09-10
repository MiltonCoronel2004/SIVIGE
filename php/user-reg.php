<?php
include("database.php");

if (isset($_POST['guardar'])) {
    $dni = $_POST["dni"];
    $name = $_POST["nombre"];
    $user = $_POST["usuario"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];

    // Verificar si el DNI ya existe en la base de datos
    $consulta_dni = "SELECT * FROM users WHERE dni = '$dni'";
    $resultado_dni = mysqli_query($connection, $consulta_dni);

    if (mysqli_num_rows($resultado_dni) > 0) {
        header('Location: ../user-new.php?error=dni_exists');
        exit;
    } else {
        // Verificar si el nombre de usuario ya existe en la base de datos
        $consulta_usuario = "SELECT * FROM users WHERE user = '$user'";
        $resultado_usuario = mysqli_query($connection, $consulta_usuario);

        if (mysqli_num_rows($resultado_usuario) > 0) {
            header('Location: ../user-new.php?error=username_exists');
            exit;
        } else {
            if ($rol == "undefined") {
                header('Location: ../user-new.php?error=invalid_role');
                exit;
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña

                $consulta = "INSERT INTO users (dni, nombre, user, pass, rol) VALUES ('$dni', '$name','$user', '$hashedPassword', '$rol')";
                $resultado = mysqli_query($connection, $consulta);

                if ($resultado) {
                    header('Location: ../user-new.php?success=true');
                    exit;
                } else {
                    header('Location: ../user-new.php?error=create_user');
                    exit;
                }
            }
        }
    }
}
?>
