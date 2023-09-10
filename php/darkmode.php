<?php
include("database.php");

// Verificar si se recibió un valor válido a través de POST
if (isset($_POST['valor'])) {
    $valor = $_POST['valor'];

    // Preparar la consulta utilizando consultas preparadas
    $consulta = "UPDATE mode SET togglemode = ? WHERE id = 1";
    $stmt = $connection->prepare($consulta);
    $stmt->bind_param("i", $valor); // "i" indica que el valor es un entero

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Valor actualizado correctamente.";
    } else {
        echo "Error al actualizar el valor.";
    }


}


?>
