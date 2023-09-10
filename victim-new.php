<?php 
include("php/database.php"); 
session_start();
$user = $_SESSION["username"];


// Verificar si el usuario está autenticado
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    // Redirigir al usuario a index.php
    header("Location: index.php");
    exit; // Asegurarse de que el script se detenga después de redirigir
}

$user = $_SESSION["username"];

$consulta = "SELECT rol FROM users WHERE user = '$user'";
$resultado = mysqli_query($connection, $consulta);
$datos = mysqli_fetch_assoc($resultado);
$rol = $datos['rol'];

if ($rol == "Lector") {
	header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="assets/icons/system.png" type="image/png">
	<title>SIVIGE | Agregar Víctima</title>

	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/42b5b848d1.js" crossorigin="anonymous"></script>
	
	<!-- Normalize V8.0.1 -->
	<link rel="stylesheet" href="css/normalize.css">

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet" href="css/bootstrap-material-design.min.css">

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet" href="css/all.css">

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet" href="css/sweetalert2.min.css">

	<!-- Sweet Alert V8.13.0 JS file-->
	<script src="js/sweetalert2.min.js" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	
	<!-- General Styles -->
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
		<section class="full-box nav-lateral">
			<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
			<figure class="full-box nav-lateral-avatar">
				<i class="far fa-times-circle show-nav-lateral"></i>

				<?php	
					if($resultado && mysqli_num_rows($resultado) > 0){
						if ($rol == "Administrador") {
							?><img src="assets/avatar/admin.png" class="img-fluid" alt="Avatar"><?php
						}
						if ($rol == "Editor") {
							?><img src="assets/avatar/edit.png" class="img-fluid" alt="Avatar"><?php
						}
						if ($rol == "Lector") {
							?><img src="assets/avatar/read.png" class="img-fluid" alt="Avatar"><?php
						}
					}
				?>
				<figcaption class="roboto-medium text-center">
					<?php
					if ($resultado && mysqli_num_rows($resultado) > 0) {


						// Mostrar el mensaje de bienvenida con el nombre de usuario y el rol
						echo "Bienvenido $user <br><small class='roboto-condensed-light'>$rol</small>";
					} else {
						// Mostrar un mensaje genérico si no se puede obtener el rol del usuario
						echo "Bienvenido $user <br><small class='roboto-condensed-light'>Rol desconocido</small>";
					}
					?>
				</figcaption>
			</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="home.php"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Panel de Control</a>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fa-solid fa-venus-mars"></i> &nbsp; Víctimas <i class="fas fa-chevron-down"></i></a>
							<ul>
							<?php 
								
								if($rol  != "Lector") {
									?>
									
									<li>
									<a href="victim-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Víctima</a>
									</li>
									
									<?php
								}

							?>
								<li>
									<a href="victim-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Víctimas</a>
								</li>
								<li>
									<a href="victim-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Víctima</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fa-solid fa-mars-and-venus-burst"></i> &nbsp; Agresores <i class="fas fa-chevron-down"></i></a>
							<ul>
							<?php 
								
								if($rol  != "Lector") {
									?>
									
									<li>
									<a href="agresor-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Agresor</a>
								</li>
									
									<?php
								}

							?>

								<li>
									<a href="agresor-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Agresores</a>
								</li>
								<li>
									<a href="agresor-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Agresor</a>
								</li>
							</ul>
						</li>

						<?php

if ($rol  == "Administrador") {
?>
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fa-solid fa-sliders"></i></i> &nbsp; Admin <i class="fas fa-chevron-down"></i></a>
							<ul>


								<li>
									<a href="user-new.php"><i class="fa-solid fa-user-plus"></i> &nbsp; Nuevo Usuario</a>
								</li>

								<li>
									<a href="user-list.php"><i class="fa-solid fa-users"></i> &nbsp; Lista de Usuarios</a>
								</li>




							</ul>
						</li>

						<?php
							}

							?>

						

						<li>
							<a href="#" class="btn-show-info"><i class="fa-solid fa-circle-info"></i> &nbsp; Informacíon</a>
						</li>
					</ul>
					<div class="container-fluid footer">
						<div class="row">
						<div class="col-12 text-center text-white">
								<a href="https://instagram.com/miltoncoronel__" class="mb-3 mb-md-0 text-body-secondary text-decoration-none lh-1">

								</a>
								<span class="mb-3 mb-md-0 text-body-secondary pr-5">© 2023 Milweb, Inc</span>
								<a class="text-body-secondary" href="https://www.facebook.com/miltonagustin.coroneldean/"><img class="bi" width="24" height="24" src="assets/img/facebook.png" alt=""></a>
								<a class="text-body-secondary" href="https://instagram.com/miltoncoronel__"><img class="bi" width="24" height="24" src="assets/img/instagram.png" alt=""></a>
								<a class="text-body-secondary" href="mailto:correo@example.com?subject=Consulta de Desarrollo Web"><img class="bi" width="24" height="24" src="assets/img/gmail.png" alt=""></a>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">

							</div>					
						</div>
					</div>
				</nav>
			</div>
		</section>

		<!-- Page content -->
		<section class="full-box page-content">
			<nav class="full-box navbar-info">
				<a href="#" class="float-left show-nav-lateral">
					<i class="fas fa-exchange-alt"></i>
				</a>
				<?php 

					if($rol == "Administrador") {
						?> 
						<a href="user-list.php">
							<i class="fas fa-user-cog"></i>
						</a>
						<?php
					}
				
				?>	
				<a href="#" class="btn-exit-system">
					<i class="fas fa-power-off"></i>
				</a>
			</nav>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR VÍCTIMA
				</h3>
				<p class="text-justify">

				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="victim-new.php" class="option"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR VÍCTIMA</a>
					</li>
					<li>
						<a href="victim-list.php" class="option"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VÍCTIMAS</a>
					</li>
					<li>
						<a href="victim-search.php" class="option"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VÍCTIMA</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form id="formulario" action="php/victim-reg.php" method="POST" enctype="multipart/form-data" class="form-neon" autocomplete="off">
					<fieldset>
						<legend id="info"><i class="fas fa-user"></i> &nbsp; Información De La Víctima</legend>
						<div class="container-fluid">
							<div class="row">
							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="img" class="bmd-label-floating">Foto</label>
									<input type="file" class="form-control" name="img" id="img" accept="image/*">
								</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="dni" class="bmd-label-floating">DNI</label>
										<input type="number" class="form-control" name="dni" id="dni" required>
										<small id="dniValidationMessage" class="form-text text-muted"></small>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" class="form-control" name="nombre" id="nombre" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="edad" class="bmd-label-floating">Edad</label>
										<input type="number"  class="form-control" name="edad" id="edad" maxlength="2" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="gender" class="bmd-label-floating">Genero</label>
										<input type="text"  class="form-control" name="gender" id="gender" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="contacto" class="bmd-label-floating">Contacto</label>
										<input type="number" class="form-control" name="contacto" id="contacto" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="direccion" class="bmd-label-floating">Dirección</label>
										<input type="text" class="form-control input-group" name="direccion" id="direccion" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="economia" class="bmd-label-floating">Ingresos:</label>
										<div class="input-group">
										<input type="text" class="form-control" name="economia" id="economia" required>
										</div>
									</div>
							</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="agresor" class="bmd-label-floating">Agresor</label>
										<input type="text"  class="form-control" name="agresor" id="agresor" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="denuncias" class="bmd-label-floating">Denuncias</label>
										<input type="number"  class="form-control" name="denuncias" id="denuncias" required> 
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="violencia" class="bmd-label-floating">T. de Violencia</label>
										<select class="form-control" name="violencia" id="violencia">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Física">Física</option>
											<option value="Psicológica">Psicológica</option>
											<option value="Sexual">Sexual</option>
											<option value="Económica">Económica</option>
											<option value="Simbólica">Simbólica</option>
											<option value="Obstétrica">Obstétrica</option>
											<option value="Patrimonial">Patrimonial</option>
											<option value="Laboral">Laboral</option>
											<option value="Institucional">Institucional</option>
											<option value="Mediática">Mediática</option>
											<option value="Doméstica">Doméstica</option>
											<option value="Pública">Pública</option>
											<option value="Política">Política</option>
											<option value="Libertad Reproductiva">Libertad Reproductiva</option>
										  </select>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="atencion" class="bmd-label-floating">Caso Atendido</label>
										<select class="form-control" name="atencion" id="atencion">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Si" required>Si</option>
											<option value="No" required>No</option>
										  </select>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="interviniente" class="bmd-label-floating">Institución Interviniente</label>
										<input type="text" class="form-control" name="interviniente" id="interviniente" required>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="estado" class="bmd-label-floating">Estado</label>
										<input type="text" class="form-control" name="estado" id="estado" required>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="vive" class="bmd-label-floating">Convive</label>
										<select class="form-control" name="vive" id="vive">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Si" required>Si</option>
											<option value="No" required>No</option>
										  </select>
									</div>
								</div>
								<div class="col-12 col-md-9">
									<div class="form-group">
										<label for="vivecon" class="bmd-label-floating">Convive Con:</label>
										<input type="text"  class="form-control" name="vivecon" id="vivecon">
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="familia" class="bmd-label-floating">Tiene Familia</label>
										<select class="form-control" name="familia" id="familia">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Si" required>Si</option>
											<option value="No" required>No</option>
										  </select>
									</div>
								</div>
								<div class="col-12 col-md-9">
									<div class="form-group">
										<label for="fliadata" class="bmd-label-floating">Datos Familiares (Resumen):</label>
										<input type="text" class="form-control" name="fliadata" id="fliadata">
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="form-group">
										<label for="antecedentes" class="bmd-label-floating">Tiene Antecedentes</label>
										<select class="form-control" name="antecedentes" id="antecedentes">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Si" required>Si</option>
											<option value="No" required>No</option>
										  </select>
									</div>
								</div>
								<div class="col-12 col-md-9">
									<div class="form-group">
										<label for="antecedentesvio" class="bmd-label-floating">Antecedentes de Violencia:</label>
										<input type="text" class="form-control" name="antecedentesvio" id="antecedentesvio">
									</div>
								</div>

							</div>
						</div>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm" name="guardar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
					</p>
				</form>
			</div>	

		</section>
	</main>
	
	
	<!-- jQuery V3.4.1 -->
	<script src="js/jquery-3.4.1.min.js" ></script>

	<!-- popper -->
	<script src="js/popper.min.js" ></script>

	<!-- Bootstrap V4.3 -->
	<script src="js/bootstrap.min.js" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>

	<!-- Bootstrap Material Design V4.0 -->
	<script src="js/bootstrap-material-design.min.js" ></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<script src="js/main.js" ></script>

	<script src="js/victim-reg.js"></script>
</body>
</html>



<?php

if($rol == "Administrador") {
	?> 
	<style>
	.footer {
		margin-top: 65%;
	}

	@media screen and (max-width: 1024px){
		.footer {
		margin-top: 35%;
		}	
	}
	</style>
	<?php
}
else {
	?> 
	<style>
	.footer {
		margin-top: 80%;
	}

	@media screen and (max-width: 1024px){
		.footer {
		margin-top: 110%;
		}	
	}
	</style>
	<?php
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	$(document).ready(function() {
  $(".ajax-link").click(function(e) {
    e.preventDefault(); // Evita que el enlace cargue una nueva página

    var url = $(this).data("url");

    $.ajax({
      url: url,
      method: "GET",
      success: function(response) {
        $(".page-content").html(response);
      }
    });
  });
});

</script>


<script>
  var familiaSelect = document.getElementById('familia');
  var fliadataInput = document.getElementById('fliadata');

	fliadataInput.disabled = true;

  familiaSelect.addEventListener('change', function() {
    if (familiaSelect.value === 'Si') {
      fliadataInput.disabled = false;
    } else {
      fliadataInput.disabled = true;
    }
  });

	var viveSelect = document.getElementById('vive');
  var viveconInput = document.getElementById('vivecon');

	viveconInput.disabled = true;
  viveSelect.addEventListener('change', function() {
    if (viveSelect.value === 'Si') {
      viveconInput.disabled = false;
    } else {
      viveconInput.disabled = true;
    }
  });


	var antecedentes = document.getElementById('antecedentes');
  var antecedentesvio = document.getElementById('antecedentesvio');

	antecedentesvio.disabled = true;
  antecedentes.addEventListener('change', function() {
    if (antecedentes.value === 'Si') {
      antecedentesvio.disabled = false;
    } else {
      antecedentesvio.disabled = true;
    }
  });
</script>





<script>
document.addEventListener("DOMContentLoaded", function() {
  const economiaInput = document.getElementById("economia");

  economiaInput.addEventListener("input", function() {
    const inputValue = economiaInput.value.replace(/\./g, ""); // Remover puntos existentes
    const formattedValue = formatNumber(inputValue); // Formatear número

    economiaInput.value = formattedValue;
  });

  function formatNumber(number) {
    // Agregar punto como separador de miles
    return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }
});
</script>

<script>
    // Función para limitar la longitud de un campo de entrada
    function limitarLongitud(input, maxLength) {
        if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
        }
    }

    // Configuración de longitud máxima para cada campo de entrada
    var campos = [
        { id: 'dni', maxLength: 9 },
        { id: 'nombre', maxLength: 60 },
        { id: 'edad', maxLength: 2 },
        { id: 'gender', maxLength: 10 },
        { id: 'contacto', maxLength: 10 },
        { id: 'direccion', maxLength: 50 },
        { id: 'economia', maxLength: 15 },
        { id: 'agresor', maxLength: 60 },
        { id: 'denuncias', maxLength: 5 },
        { id: 'interviniente', maxLength: 30 },
    ];

    // Agregar el evento oninput a cada campo de entrada
    campos.forEach(function (campo) {
        var input = document.getElementById(campo.id);
        var maxLength = campo.maxLength;

        if (input) {
            input.addEventListener('input', function () {
                limitarLongitud(this, maxLength);
            });
        }
    });
</script>




<script>
  var dniInput = document.getElementById('dni');
  var dniValidationMessage = document.getElementById('dniValidationMessage');

  dniInput.addEventListener('input', function() {
    var dniValue = dniInput.value;
    var dniLength = dniValue.length;

    if (dniLength > 0 && dniLength < 7) {
      dniValidationMessage.textContent = 'El número de DNI es demasiado corto.';
    } else if (dniLength > 8) {
      dniValidationMessage.textContent = 'El número de DNI es demasiado largo.';
    } else {
      dniValidationMessage.textContent = '';
    }
  });
</script>




<?php

include("php/database.php");

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
		$('#vivecon').css('background-color', '#060606');
		$('#fliadata').css('background-color', '#060606');
		$('#antecedentesvio').css('background-color', '#060606');
		$('input').css('color', '#fff');



		



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
