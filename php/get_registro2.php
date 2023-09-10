<?php
include("database.php");

if (isset($_POST['dni'])) {
  $dni = $_POST['dni'];

  // Realizar la consulta para obtener los datos del registro con el DNI especificado
  $consulta = "SELECT * FROM agresores WHERE dni = '$dni'";
  $resultado = mysqli_query($connection, $consulta);

  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);

    ?>

    <div class="container-fluid style="vertical-align: middle">
      <div class="row">
        <div class="col-12 text-center">
        <h2 class="title">Datos del registro</h2>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12 col-lg-6">
          <p>Nombre: <?php echo $fila['nombre']; ?></p>
          <p>DNI: <?php echo $fila['dni']; ?></p>
          <p>Edad: <?php echo $fila['edad']; ?></p>
          <p>Genero: <?php echo $fila['genero']; ?></p>
          <p>Contacto: <?php echo $fila['contacto']; ?></p>
          <p>Dirección: <?php echo $fila['direccion']; ?></p>
          <p>Víctima: <?php echo $fila['victima']; ?></p>
          <p>Denuncias: <?php echo $fila['denuncias']; ?></p>
          <p>Violencia ejercida: <?php echo $fila['violencia']; ?></p>
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
          <a href="" class="btn btn-primary d-block mt-3" id="delReg">Eliminar Registro</a>
  <?php
}

?>



          <script>
  $(document).ready(function() {




    $('#delReg').click(function(e) {
      e.preventDefault(); // Evita que el enlace redireccione

      var dni = '<?php echo $fila["dni"]; ?>';
      var nombre = '<?php echo $fila["nombre"]; ?>';
      var confirmacion = confirm("¿Seguro que desea eliminar el Registro? Acción irreversible.")
      if(confirmacion) {
        value = 2;
        $.ajax({
        url: 'php/delReg.php', // Ruta al archivo PHP que actualiza la columna
        type: 'POST',
        data: { dni: dni, value: value },
        success: function(response) {
          alert("Registro: " + dni + ", " + nombre + " Eliminado Correctamente");
          window.location.href = "agresor-list.php";
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
mysqli_close($connection);
?>





