<?php
include("database.php");

if (isset($_POST['guardar'])) {
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $direccion = $_POST["direccion"];
    $contacto = $_POST["contacto"];
    $gender = $_POST["gender"];
    $img = $_FILES['img']['name'];

    // Verificar si el número de documento ya existe en la base de datos
    $consultaExistencia = "SELECT * FROM agresores WHERE dni = '$dni'";
    $resultadoExistencia = mysqli_query($connection, $consultaExistencia);

    if (mysqli_num_rows($resultadoExistencia) > 0) {
        ?>
        <script>
            alert("El número de documento ya existe. Por favor, ingrese un número de documento diferente.");
            window.location.href = "../agresor-new.php";
        </script>
        <?php
        exit;
    }

    // Verificar si el nombre de la imagen ya existe en la tabla de agresores
    $consultaExistenciaImagenAgresor = "SELECT * FROM agresores WHERE img = '$img'";
    $resultadoExistenciaImagenAgresor = mysqli_query($connection, $consultaExistenciaImagenAgresor);

    // Verificar si el nombre de la imagen ya existe en la tabla de víctimas
    $consultaExistenciaImagenVictima = "SELECT * FROM victimas WHERE img = '$img'";
    $resultadoExistenciaImagenVictima = mysqli_query($connection, $consultaExistenciaImagenVictima);

    if (mysqli_num_rows($resultadoExistenciaImagenAgresor) > 0 || mysqli_num_rows($resultadoExistenciaImagenVictima) > 0) {
        $extension = pathinfo($img, PATHINFO_EXTENSION); // Obtener la extensión del archivo
        $img = time() . '_' . rand(100, 999) . '.' . $extension; // Agregar número al nombre de la imagen
    }

    if (isset($img) && $img != "") {
        $tipo = $_FILES['img']['type'];
        $temp = $_FILES['img']['tmp_name'];

        // Obtener los datos de la víctima usando el campo "dnivictim" ingresado por POST
        $dnivictim = $_POST["dnivictim"];
        $consultaVictima = "SELECT violencia, nombre, denuncias FROM victimas WHERE dni = '$dnivictim'";
        $resultadoVictima = mysqli_query($connection, $consultaVictima);

        if (mysqli_num_rows($resultadoVictima) > 0) {
            $datosVictima = mysqli_fetch_assoc($resultadoVictima);
            $violencia = $datosVictima['violencia'];
            $victima = $datosVictima['nombre'];
            $denuncias = $datosVictima['denuncias'];

            $consulta = "INSERT INTO agresores (img, dni, nombre, edad, direccion, contacto, genero, violencia, victima, denuncias) 
            VALUES ('$img', '$dni', '$nombre', '$edad', '$direccion', '$contacto', '$gender', '$violencia', '$victima', '$denuncias')";            
            $resultado = mysqli_query($connection, $consulta);

            if ($resultado) {
                header('Location: ../agresor-new.php');
                exit;
            } else {
                echo "Error en la consulta: " . mysqli_error($connection);
            }
      
        } else {
            ?>
            <script>
                alert("Víctima inexistente o datos faltantes de la misma.");
                window.location.href = "../agresor-new.php";
            </script>
            <?php
            exit;
        }


        move_uploaded_file($temp, 'files/' . $img);
        
        if ($resultado) {
            header('Location: ../agresor-new.php');
            exit;
        } else {
            echo "Error en la consulta: " . mysqli_error($connection);
        }

        

    }
}
?>



