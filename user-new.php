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

if ($rol != "Administrador") {
header("Location: home.php");
}



if (isset($_GET['success'])) {
    $success = $_GET['success'];
    if ($success === 'true') {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Usuario Registrado Correctamente.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    if (window.history.replaceState) {
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    }
                });
            });
        </script>
        ';
    }
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="assets/icons/system.png" type="image/png">
	<title>SIVIGE | Nuevo Usuario</title>

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
					<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO
				</h3>
				<p class="text-justify">
					Agregue usuarios para la operación del sistema, se recomienda añadir máximo 3 Administradores y añadir Editores segun sea necesario.
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a class="active" href="user-new.php" class="option"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
					</li>
					<li>
						<a href="user-list.php" class="option"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
					</li>

				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<form action="php/user-reg.php" method="POST" class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="dni" class="bmd-label-floating">DNI</label>
										<input type="number" class="form-control" name="dni" id="dni" maxlength="20" required>
									</div>
									<?php 
										if (isset($_GET['error'])) {
											$error = $_GET['error'];
										
											if ($error === 'dni_exists') {
												?>
											
												<p>El DNI ya se encuentra entre los registros.</p>
										
												<?php
											}
										}
									?>
								</div>
								
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" class="form-control" name="nombre" id="nombre" maxlength="35" required>
									</div>
								</div>
						
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="usuario" class="bmd-label-floating">Nombre de usuario</label>
										<input type="text" class="form-control" name="usuario" id="usuario" maxlength="35" required>
									</div>
									<?php 
										if (isset($_GET['error'])) {
											$error = $_GET['error'];
										
											if ($error === 'username_exists') {
												?>
											
												<p>El Usuario ya se encuentra entre los registros.</p>
										
												<?php
											}
										}
									?>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="password" class="bmd-label-floating">Contraseña</label>
										<input type="password" class="form-control" name="password" id="password" maxlength="200" required>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<p><span class="badge badge-info">Administrador</span> Permisos para registrar, editar, y eliminar usuarios. Permisos para crear y leer registros. (Se recomienda Max. 3)</p>
									<p><span class="badge badge-success">Editor</span> Permisos para crear y leer registros.</p>
									<p><span class="badge badge-dark">Lector</span> Solo permisos para leer registros.</p>
									<div class="form-group">
										<select class="form-control" name="rol">
											<option value="undefined">Seleccione una Opción</option>
											<option value="Administrador">Administrador</option>
											<option value="Editor">Editor</option>
											<option value="Lector">Lector</option>
										</select>
									</div>

									<?php 
										if (isset($_GET['error'])) {
											$error = $_GET['error'];
										
											if ($error === 'invalid_role') {
												?>
											
												<p>Seleccione un Rol valido.</p>
										
												<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" name="guardar" class="btn btn-raised btn-info btn-sm save-btn"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
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