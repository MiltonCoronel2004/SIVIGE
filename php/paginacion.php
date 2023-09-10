<?php
include("database.php");

$registros_por_pagina = 10;

$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

$consulta = "SELECT * FROM victimas ORDER BY nombre ASC LIMIT $inicio, $registros_por_pagina";
$resultado = mysqli_query($connection, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    echo '<table class="table table-light table-striped table-sm">
            <thead>
                <tr class="text-center roboto-medium table-active bg-dark">
                    <th>Foto</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Genero</th>
                    <th>Contacto</th>
                    <th>Caso Atendido</th>
                    <th>Agresor</th>
                    <th>T. de Violencia</th>
                    <th>Denuncias</th>
                </tr>
            </thead>
            <tbody class="text-center">';

    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr class='fila-tabla text-center' data-dni='" . $fila['dni'] . "' id='" . $fila['dni'] . "'>";
        echo "<td><img src='php/files/" . $fila['img'] . "' width='45'></td>";
        echo "<td style='vertical-align: middle;'>" . $fila['dni'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['nombre'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['edad'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['gender'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['contacto'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['atencion'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['agresor'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['violencia'] . "</td>";
        echo "<td style='vertical-align: middle;'>" . $fila['denuncias'] . "</td>";
        echo "</tr>";
    }

    echo '</tbody></table>';

  // Calcular el número total de páginas
  $consulta_total = "SELECT COUNT(*) AS total FROM victimas";
  $resultado_total = mysqli_query($connection, $consulta_total);
  $fila_total = mysqli_fetch_assoc($resultado_total);
  $total_registros = $fila_total['total'];
  $total_paginas = ceil($total_registros / $registros_por_pagina);

// Calcular los números de página a mostrar
$numeros_pagina = [];
$numeros_a_mostrar = 4;

if ($total_paginas <= $numeros_a_mostrar) {
    // Si hay menos o igual cantidad de páginas que la cantidad a mostrar, se muestran todas las páginas disponibles
    $inicio_numeros = 1;
    $fin_numeros = $total_paginas;
} elseif ($pagina_actual <= ceil($numeros_a_mostrar / 2)) {
    // Si la página actual está cerca del principio, se muestran las primeras páginas hasta alcanzar la cantidad deseada
    $inicio_numeros = 1;
    $fin_numeros = $numeros_a_mostrar;
} elseif ($pagina_actual >= $total_paginas - floor($numeros_a_mostrar / 2)) {
    // Si la página actual está cerca del final, se muestran las últimas páginas hasta alcanzar la cantidad deseada
    $inicio_numeros = $total_paginas - $numeros_a_mostrar + 1;
    $fin_numeros = $total_paginas;
} else {
    // Si la página actual está en el medio, se muestran las páginas alrededor de la página actual
    $inicio_numeros = $pagina_actual - floor($numeros_a_mostrar / 2);
    $fin_numeros = $pagina_actual + floor($numeros_a_mostrar / 2);
}

// Ajustar el rango si es necesario
if ($fin_numeros - $inicio_numeros + 1 > $numeros_a_mostrar) {
    $fin_numeros--;
}

for ($i = $inicio_numeros; $i <= $fin_numeros; $i++) {
    $numeros_pagina[] = $i;
}

// Mostrar la paginación
echo '<div class="pagination-container" style="overflow-x: auto;">
<nav aria-label="Paginación">
    <ul class="pagination justify-content-center">';

if ($pagina_actual > 1) {
    echo '<li class="page-item"><a class="page-link" style="width: 120px;" href="?pagina=' . ($pagina_actual - 1) . '">Anterior</a></li>';
} else {
    echo '<li class="page-item" style="visibility: hidden;"><a class="page-link" style="width: 120px;"></a></li>';
}

foreach ($numeros_pagina as $numero_pagina) {
  if ($numero_pagina === $pagina_actual) {
      echo '<li class="page-item active"><span class="page-link current-page">' . $numero_pagina . '</span></li>';
  } else {
      echo '<li class="page-item"><a class="page-link" href="?pagina=' . $numero_pagina . '">' . $numero_pagina . '</a></li>';
  }
}

if ($pagina_actual < $total_paginas) {
    echo '<li class="page-item"><a class="page-link" style="width: 120px;" href="?pagina=' . ($pagina_actual + 1) . '">Siguiente</a></li>';
} else {
    echo '<li class="page-item" style="visibility: hidden;"><a class="page-link" style="width: 120px;"></a></li>';
}

echo '</ul></nav>
</div>';

echo '<div class="current-page-indicator">Página actual: ' . $pagina_actual . '</div>


<style>
.current-page-indicator {
  text-align: center;
  margin-top: 10px;
  font-weight: bold;
}
</style>';



} else {
    echo '
    <table class="table table-light table-striped table-sm">
            <thead>
              <tr class="text-center roboto-medium table-active bg-dark">
                <th>Foto</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Genero</th>
                <th>Contacto</th>
                <th>Caso Atendido</th>
                <th>Agresor</th>
                <th>T. de Violencia</th>
                <th>Denuncias</th>
              </tr>
            </thead>
    <tr><td colspan="10" class="nodata text-center text-white bg-dark">No se encontraron datos.</td></tr>';
}

// Función para actualizar el estilo de la página según el modo
function updatePageStyle($toggleMode) {
    if ($toggleMode == 1) {
      ?>
     <script>
    $(document).ready(function() {
      var btnLightMode = $('.btn-light-mode');
      var btnDarkMode = $('.btn-dark-mode');
      btnDarkMode.hide();
      btnLightMode.show();
          $('body').css('--color-one', '#181818');
          $('h1, h2, h3, h4, h5, h6, p').css('color', '#fff');
          $('body, h1, h2, h3, h4, h5, h6, p').css('background-color', '#181818');
          $('.tile:hover').css('color', '#fff');
          $('.tile-tittle').css('color', '#fff !important');
          $('.tile').css('border', '1px solid #272727');
          $('.tile').css('background-color', '#181818');
          $('.p-icon').css('color', '#fff');
          $('.navbar-info a i').css('color', '#fff');
          $('form').css('background-color', '#181818');
          $('form label').css('color', '#fff');
          $('form input').css('border-bottom', '1px solid #fff');
          $('form legend').css('color', '#fff');
          $('form select').css('color', '#fff');
          $('form select').css('background-color', '#181818');
          $('form select').css('background-color', '#181818');
          $('.option').css('color', '#fff');
          $('.save-btn').css('color', 'black');
          $('.save-btn').css('font-weight', 'bolder');
          $('table').css('background-color', '#181818');
          $('table tr').css('color', '#fff');
          
  
          
  
  
  
      // Aquí puedes agregar cualquier otra lógica o funciones relacionadas con el modo oscuro
    });
  </script>
  
      <?php
    } 
  }
  
  // Verificar el valor actual de "togglemode" en la tabla "mode"
  $consulta = "SELECT togglemode FROM mode WHERE id = 1";
  $resultado = mysqli_query($connection, $consulta);
  
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $toggleMode = $fila['togglemode'];
    updatePageStyle($toggleMode);
  }
  

mysqli_close($connection);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  // Manejador de eventos para las filas de la tabla
  $(document).on("click", ".fila-tabla", function() {
    // Remueve la clase "selected" de todas las filas de la tabla
    $(".fila-tabla").removeClass("selected");
    // Agrega la clase "selected" a la fila que se hizo clic
    $(this).addClass("selected");

    // Remueve el borde de todas las filas
    $(".fila-tabla").css("border", "none");
    // Agrega el borde a la fila seleccionada actual
    $(this).css("border", "2px solid black");
  });

  // Manejador de eventos para hacer clic fuera de la tabla
  $(document).click(function(event) {
    // Verificar si se hizo clic fuera de la tabla
    if (!$(event.target).closest(".fila-tabla").length) {
      // Remover la clase "selected" de todas las filas de la tabla
      $(".fila-tabla").removeClass("selected");
      // Remover el borde de todas las filas
      $(".fila-tabla").css("border", "none");
    }
  });
});
</script>


