<?php
include("database.php");

if (isset($_POST['guardar'])) {
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $contacto = $_POST["contacto"];
    $direccion = $_POST["direccion"];
    $vive = $_POST["vive"];
    $agresor = $_POST["agresor"];
    $violencia = $_POST["violencia"];
    $denuncias = $_POST["denuncias"];
    $atencion = $_POST["atencion"];
    $economia = $_POST["economia"];
    $interviniente = $_POST["interviniente"];
    $estado = $_POST["estado"];
    $familia = $_POST["familia"];
    $gender = $_POST["gender"];
    $antecedentes = $_POST["antecedentes"];
    $img = $_FILES['img']['name'];

    // Verificar si el número de documento ya existe en la base de datos
    $consultaExistencia = "SELECT * FROM victimas WHERE dni = '$dni'";
    $resultadoExistencia = mysqli_query($connection, $consultaExistencia);

    if (mysqli_num_rows($resultadoExistencia) > 0) {
        ?>
        <script>
            alert("El número de documento ya existe. Por favor, ingrese un número de documento diferente.");
            window.location.href = "../victim-new.php";
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

        $tipo = $_FILES['img']['type'];
        $temp = $_FILES['img']['tmp_name'];


        if ($atencion != "undefined") {
            if ($familia != "undefined") {
                if ($violencia != "undefined") {
                    if ($vive != "undefined") {
                        if ($antecedentes != "undefined") {
                            if ($familia == "Si") {
                                $fliadata = $_POST["fliadata"];
                            } else {
                                $fliadata = "-";
                            }
                            if ($vive == "Si") {
                                $vivecon = $_POST["vivecon"];
                            } else {
                                $vivecon = "-";
                            }
                            if ($antecedentes == "Si") {
                                $antecedentesvio = $_POST["antecedentesvio"];
                            } else {
                                $antecedentesvio = "-";
                            }
                            $dni = $_POST["dni"];
                            $nombre = $_POST["nombre"];
                            $edad = $_POST["edad"];
                            $contacto = $_POST["contacto"];
                            $direccion = $_POST["direccion"];
                            $vive = $_POST["vive"];
                            $agresor = $_POST["agresor"];
                            $violencia = $_POST["violencia"];
                            $denuncias = $_POST["denuncias"];
                            $atencion = $_POST["atencion"];
                            $economia = $_POST["economia"];
                            $interviniente = $_POST["interviniente"];
                            $estado = $_POST["estado"];
                            $familia = $_POST["familia"];
                            $gender = $_POST["gender"];

                            $consulta = "INSERT INTO victimas (img, dni, nombre, edad, contacto, direccion, vive, vivecon, agresor, violencia, denuncias, atencion, economia, interviniente, estado, familia, fliadata, gender, antecedentes, antecedentesvio) 
                            VALUES ('$img', '$dni', '$nombre', $edad, '$contacto', '$direccion', '$vive', '$vivecon', '$agresor', '$violencia', '$denuncias', '$atencion', '$economia', '$interviniente', '$estado', '$familia', '$fliadata', '$gender', '$antecedentes', '$antecedentesvio')";

                            $resultado = mysqli_query($connection, $consulta);

                            move_uploaded_file($temp, 'files/' . $img);

                            if ($resultado) {
                                header('Location: ../victim-new.php');
                                exit;
                            } else {
                                echo "Error en la consulta: " . mysqli_error($connection);
                            }
                        } else {
                            ?>
                            <script>
                                alert("Antecedentes: Por favor, seleccione una opción válida (Si o No)");
                                window.location.href = "../victim-new.php";
                            </script>
                            <?php
                        }
                    } else {
                        ?>
                        <script>
                            alert("Convive: Por favor, seleccione una opción válida (Si o No)");
                            window.location.href = "../victim-new.php";
                        </script>
                        <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Tipo de Violencia: Por favor, seleccione una opción válida.");
                        window.location.href = "../victim-new.php";
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert("Familia: Por favor, seleccione una opción válida (Sí o No)");
                    window.location.href = "../victim-new.php";
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Caso Atendido: Por favor, seleccione una opción válida (Sí o No)");
                window.location.href = "../victim-new.php";
            </script>
            <?php
        }
    
}
?>
