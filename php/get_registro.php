<?php
include("database.php");

if (isset($_POST['dni'])) {
  $dni = $_POST['dni'];

  // Realizar la consulta para obtener los datos del registro con el DNI especificado
  
  $consulta = "SELECT * FROM victimas WHERE dni = '$dni'";
  $resultado = mysqli_query($connection, $consulta);
  $fila = mysqli_fetch_assoc($resultado);
  if (mysqli_num_rows($resultado) > 0) {


    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    

    <div class="container-fluid style="vertical-align: middle">
      <div class="row">
        <div class="col-12 text-center">
        <h2 style="font-size: 30px;">Datos del registro</h2>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-lg-3">
          <p>Nombre: <?php echo $fila['nombre']; ?></p>
          <p>DNI: <?php echo $fila['dni']; ?></p>
          <p>Edad: <?php echo $fila['edad']; ?></p>
          <p>Genero: <?php echo $fila['gender']; ?></p>
          <p>Contacto: <?php echo $fila['contacto']; ?></p>
          <p>Dirección: <?php echo $fila['direccion']; ?></p>
          <p>Ingresos: <?php echo $fila['economia']; ?></p>
          <?php if ($fila['vive'] == "Si"): ?>
            <p>Vive con: <?php echo $fila['vivecon']; ?></p>
          <?php endif; ?>
          <?php if ($fila['familia'] == "Si"): ?>
            <p>Datos Familiares: <?php echo $fila['fliadata']; ?></p>
          <?php endif; ?>
        </div>
        <div class="col-12 col-lg-3">

        
          <p>Agresor: <?php echo $fila['agresor']; ?></p>
          <p>Denuncias: <?php echo $fila['denuncias']; ?></p>
          <p>Tipo de Violencia: <?php echo $fila['violencia']; ?></p>
          <p id="casoAtendido">Caso Atendido: <?php echo $fila['atencion']; ?></p>
          <p>Estado del Caso: <?php echo $fila['estado']; ?></p>
        </div>
        <div class="col-12 col-lg-6 text-center">
          <img src="php/files/<?php echo $fila['img']; ?>" class="modal-img" width="250" alt="Imagen No Cargada">
<?php 
session_start();
$user = $_SESSION["username"];
$consulta = "SELECT rol FROM users WHERE user = '$user'";
$resultado = mysqli_query($connection, $consulta);
$datos = mysqli_fetch_assoc($resultado);
$rol = $datos['rol'];

            if($rol != "Lector") {
              ?>
<a href="php/files/<?php echo $fila['img']; ?>" download class="btn btn-primary d-block mt-3">Descargar imagen</a>
          <?php 
          
            if($fila['atencion'] == "No") {
              ?> <a href="#" class="btn btn-primary d-block mt-3" id="atender">Atender Caso</a> <?php
            }

  
          
          ?>
          <a href="" class="btn btn-primary d-block mt-3" id="updateState">Actualizar Estado del Caso</a>

          <a href="" class="btn btn-primary d-block mt-3" id="delReg">Eliminar Registro</a>
              <?php 
            }
?>

          


          <script>
  $(document).ready(function() {
    $('#atender').click(function(e) {
      e.preventDefault(); // Evita que el enlace redireccione

      var dni = '<?php echo $fila["dni"]; ?>';

      // Realizar una solicitud AJAX para ejecutar el script PHP
      $.ajax({
        url: 'php/stateTrue.php', // Ruta al archivo PHP que actualiza la columna
        type: 'POST',
        data: { dni: dni },
        success: function(response) {
          window.location.href = "victim-list.php";
          alert("Caso Atendido Correctamente");
        },
        error: function(xhr, status, error) {
          // Si hay un error en la solicitud, muestra un mensaje de error
          console.log(error);
          alert('Error al actualizar el estado del caso.');
          
        }
      });
    });


    $('#updateState').click(function(e) {
  e.preventDefault(); // Evita que el enlace redireccione

  var dni = '<?php echo $fila["dni"]; ?>';

  var confirmacion = confirm("¿Desea actualizar el estado del caso?");

  if (confirmacion) {
    var infoUpdate = prompt("Ingrese Actualización de Estado:");

    if (infoUpdate !== null) {
      value = 1;
      $.ajax({
        url: 'php/updateState.php', // Ruta al archivo PHP que actualiza la columna
        type: 'POST',
        data: { dni: dni, infoUpdate: infoUpdate, value: value },
        success: function(response) {
          alert("Informacion Actualizada Correctamente");
          window.location.href = "victim-list.php";
        },
        error: function(xhr, status, error) {
          // Si hay un error en la solicitud, muestra un mensaje de error
          console.log(error);
          alert('Error al actualizar el estado del caso.');
        }
      });
    }
  }
});


    $('#delReg').click(function(e) {
      e.preventDefault(); // Evita que el enlace redireccione

      var dni = '<?php echo $fila["dni"]; ?>';
      var nombre = '<?php echo $fila["nombre"]; ?>';
      var confirmacion = confirm("¿Seguro que desea eliminar el Registro? Acción irreversible.")
      if(confirmacion) {
        value = 1;
        $.ajax({
        url: 'php/delReg.php', // Ruta al archivo PHP que actualiza la columna
        type: 'POST',
        data: { dni: dni, value: value },
        success: function(response) {
          alert("Registro: " + dni + ", " + nombre + " Eliminado Correctamente");
          window.location.href = "victim-list.php";
        },
        error: function(xhr, status, error) {
          // Si hay un error en la solicitud, muestra un mensaje de error
          console.log(error);
          alert('Error al eliminar el registro.');
        }
      });
      }
    });
  });
</script>

        </div>
      </div>
    </div>
 

    <?php
  } else {
    echo 'No se encontró el registro.';
  }
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
		$('.table').css('background-color', '#181818');
		$('.table tr').css('color', '#fff');
		$('input').css('color', '#fff');
		$('#modal').css('color', '#fff');
		$('.modal-content').css('background-color', '#181818');
    $('.modal').css('background-color', 'rgba(0, 0, 0, 0.4)');


		

		



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



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


