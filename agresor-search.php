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

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="assets/icons/system.png" type="image/png">
	<title>Buscar Agresor</title>

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
	<script src="js/sweetalert2.min.js"></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">

	<!-- General Styles -->
	<link rel="stylesheet" href="css/style.css">

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">


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
					if ($resultado && mysqli_num_rows($resultado) > 0) {
						$datos = mysqli_fetch_assoc($resultado);
						$rol = $datos['rol'];
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
							$datos = mysqli_fetch_assoc($resultado);


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

								if ($rol  != "Lector") {
								?>

									<li>
										<a href="victim-new.php"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Víctima</a>
									</li>

								<?php
								}

								?>
								<li>
									<a href="agresor-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Víctimas</a>
								</li>
								<li>
									<a href="agresor-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Víctima</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fa-solid fa-mars-and-venus-burst"></i> &nbsp; Agresores <i class="fas fa-chevron-down"></i></a>
							<ul>
								<?php

								if ($rol  != "Lector") {
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
						<div class=" row">
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
					<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR AGRESOR
				</h3>

			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="agresor-new.php" class="option"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR AGRESOR</a>
					</li>
					<li>
						<a href="agresor-list.php" class="option"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE AGRESORES</a>
					</li>
					<li>
						<a class="active" href="agresor-search.php" class="option"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR AGRESOR</a>
					</li>
				</ul>
			</div>

			<!-- Content here-->
			<div class="container-fluid">
				<form class="form-neon" action="">
					<div class="container-fluid">
						<div class="row justify-content-md-center">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="inputSearch" class="bmd-label-floating">¿Qué Agresor estas buscando?</label>
									<input type="text" class="form-control" name="busqueda-" id="searchInput" maxlength="30" onkeyup="buscarVictima()" autocomplete="off">

								</div>
							</div>
						</div>
					</div>
				</form>
			</div>



			<link rel="stylesheet" href="css/modal.css">

			<div class="container-fluid">
				<div id="modal" class="modal">
					<div class="modal-content">
						<span class="close">&times;</span>
						<div id="modal-body"></div>
					</div>
				</div>

				<div class="table-responsive mb-5 custom-scrollbar" style="max-height: 550px; overflow-y: scroll;">
					<div class="table-responsive" id="tabla-victimas">
						<table class="table text-center" id="table" style="border: 1px solid #303436;">
							<tbody>
								<?php
								include("php/database.php");


								$consulta = "SELECT * FROM agresores ORDER BY nombre ASC";
								$resultado = mysqli_query($connection, $consulta);

								if (mysqli_num_rows($resultado) > 0) {
									echo '<table class="table table-light table-striped table-sm">
					<thead>
						<tr class="text-center roboto-medium table-active bg-dark">
							<th>Foto</th>
							<th>DNI</th>
							<th>Nombre</th>
							<th>Edad</th>
							<th>Víctima</th>
							<th>T. de Violencia</th>
							<th>Dirección</th>
							<th>Contacto</th>
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
										echo "<td style='vertical-align: middle;'>" . $fila['victima'] . "</td>";
										echo "<td style='vertical-align: middle;'>" . $fila['violencia'] . "</td>";
										echo "<td style='vertical-align: middle;'>" . $fila['direccion'] . "</td>";
										echo "<td style='vertical-align: middle;'>" . $fila['contacto'] . "</td>";
										echo "<td style='vertical-align: middle;'>" . $fila['denuncias'] . "</td>";
										echo "</tr>";
									}

									echo '</tbody></table>';
								} else {
									echo "<p class='text-center'>No se encontraron registros.</p>";
								}

								mysqli_close($connection);
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</section>
	</main>


	<!-- jQuery V3.4.1 -->
	<script src="js/jquery-3.4.1.min.js"></script>

	<!-- popper -->
	<script src="js/popper.min.js"></script>

	<!-- Bootstrap V4.3 -->
	<script src="js/bootstrap.min.js"></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Bootstrap Material Design V4.0 -->
	<script src="js/bootstrap-material-design.min.js"></script>
	<script>
		$(document).ready(function() {
			$('body').bootstrapMaterialDesign();
		});
	</script>

	<script src="js/main.js"></script>

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

<script>
	$(function() {
		$("#searchInput").on("input", function() {
			var searchValue = $(this).val().toLowerCase();
			$(".fila-tabla").each(function() {
				var dni = $(this).find("td:eq(1)").text().toLowerCase();
				var nombre = $(this).find("td:eq(2)").text().toLowerCase();
				if (dni.indexOf(searchValue) !== -1 || nombre.indexOf(searchValue) !== -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		});
	});
</script>


<script>
	$(document).ready(function() {
		// Manejador de eventos para las filas de la tabla
		$(document).on("dblclick", ".fila-tabla", function() {
			// Obtener el valor del atributo "data-dni" de la fila
			var dni = $(this).data("dni");

			// Realizar una solicitud AJAX para obtener los datos del registro
			$.ajax({
				url: "php/get_registro2.php",
				method: "POST",
				data: {
					dni: dni
				},
				success: function(response) {
					// Mostrar los datos del registro en la ventana modal
					$("#modal-body").html(response);
					$("#modal").show();
				}
			});
		});

		// Manejador de eventos para cerrar la ventana modal
		$(".close").click(function() {
			$("#modal").hide();
		});

		// Manejador de eventos para hacer clic fuera de la ventana modal
		$(window).click(function(event) {
			if (event.target == $("#modal")[0]) {
				$("#modal").hide();
			}
		});
	});
</script>

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



<?php

include("php/database.php");

// Función para actualizar el estilo de la página según el modo
function updatePageStyle($toggleMode) {
  if ($toggleMode == 1) {
    ?>
   <script>
  $(document).ready(function() {
		$('.btn-show-info').on('click', function(e){
    e.preventDefault();
		
    $('*').css('background-color', '#181818');
		});

		$('.btn-exit-system').on('click', function(e){
			e.preventDefault();
			$('*').css('background-color', '#181818');

		});

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
		$('table tr').css('color', '#fff');
		$('table').css('background-color', '#181818');
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


<style>
	/* Estilos personalizados para el scrollbar */
.custom-scrollbar::-webkit-scrollbar {
  width: 10px;
  background-color: #333;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: #666;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background-color: #888;
}

</style>
