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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="assets/icons/system.png" type="image/png">
	<title>SIVIGE | Inicio</title>

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
						// Mostrar el mensaje de bienvenida con el nombre de usuario y el rol
						echo "$user <br><small class='roboto-condensed-light'>$rol</small>";
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
									<a href="agresor-list.php"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Argresores</a>
								</li>
								<li>
									<a href="agresor-search.php"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Argresor</a>
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

<!-- 						<li>
							<a href="company.php"><i class="fa-solid fa-download fa-fade"></i> &nbsp; Copia de Seguridad</a>
						</li> -->

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
				<a href="#" class="btn-light-mode" id="light-mode">
            <i class="fa-solid fa-sun"></i>
        </a>
				<a href="#" class="btn-dark-mode" id="dark-mode">
            <i class="fa-solid fa-moon"></i>
        </a>






				




	
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

				<script src="js/darkmode.js" ></script>
			</nav>

			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fab fa-dashcube fa-fw"></i> &nbsp; PANEL DE CONTROL
				</h3>
				<p class="text-justify">
					Bienvenido al Sistema de Víctimas de Violencia de Genero, <strong><?php echo $user?></strong>. <?php if($rol == "Administrador"){?>Tu nivel de privilegios es <strong>"Administrador"</strong> tienes acceso total al sistema.<?php } if($rol == "Editor"){?>Tu nivel de privilegios es <strong>"Editor"</strong> puedes crear registros.<?php } if($rol == "Lector"){?>Tu nivel de privilegios es <strong>"Lector"</strong> solo puedes leer registros.<?php }?>
				</p>
			</div>

			<!-- Content -->
			<div class="full-box tile-container p-a">
				<a href="victim-list.php" class="tile">
				<?php
// Realizar la búsqueda del valor togglemode en la tabla mode y asignarlo a $toggleMode
$consulta = "SELECT togglemode FROM mode WHERE id = 1";
$resultado = mysqli_query($connection, $consulta);

if ($resultado && mysqli_num_rows($resultado) > 0) {
  $fila = mysqli_fetch_assoc($resultado);
  $toggleMode = $fila['togglemode'];
} else {
  // Valor predeterminado si no se encuentra en la tabla o hay un error en la consulta
  $toggleMode = 0;
}
?>
				<div class="tile-tittle titulos" style="<?php if ($toggleMode == 1) echo 'color: white;'; ?>">Víctimas</div>

					<div class="tile-icon">
						<i class="fa-solid fa-venus-mars p-icon"></i>
						<?php
						$consulta_total_victimas = "SELECT COUNT(*) AS total FROM victimas";
						$resultado_total_victimas = mysqli_query($connection, $consulta_total_victimas);
						$fila_total_victimas = mysqli_fetch_assoc($resultado_total_victimas);
						$total_registros_victimas = $fila_total_victimas['total'];
						echo "<p class='registros'>" . $total_registros_victimas . " Registros</p>";
						?>
					</div>
				</a>

				<a href="agresor-list.php" class="tile p-a">
				<div class="tile-tittle titulos" style="<?php if ($toggleMode == 1) echo 'color: white;'; ?>">Agresores</div>
					<div class="tile-icon">
						<i class="fa-solid fa-mars-and-venus-burst p-icon"></i>
						<?php
						$consulta_total_agresores = "SELECT COUNT(*) AS total FROM agresores";
						$resultado_total_agresores = mysqli_query($connection, $consulta_total_agresores);
						$fila_total_agresores = mysqli_fetch_assoc($resultado_total_agresores);
						$total_registros_agresores = $fila_total_agresores['total'];
						echo "<p class='registros'>" . $total_registros_agresores . " Registros</p>";
						?>
					</div>
				</a>



			
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
	<script src="js/darkmode.js" ></script>
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
	




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
		



    // Aquí puedes agregar cualquier otra lógica o funciones relacionadas con el modo oscuro
  });
</script>

    <?php
  } else {
    ?>
    <script>
      $(document).ready(function() {
        var btnLightMode = $('.btn-light-mode');
        var btnDarkMode = $('.btn-dark-mode');
        btnDarkMode.show();
        btnLightMode.hide();

				$('body').css('--color-one', '#fff');
				$('h1, h2, h3, h4, h5, h6, p').css('color', '#181818');
				$('body, h1, h2, h3, h4, h5, h6, p').css('background-color', '#fff');
				$('.tile:hover').css('color', '#181818');
				$('.tile-tittle').css('color', '#181818 !important');
				$('.tile').css('border', '1px solid #D8D8D8');
				$('.tile').css('background-color', '#fff');
				$('.p-icon').css('color', '#181818');
				$('.navbar-info a i').css('color', '#181818');

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


<script>
$(document).ready(function() {
  var btnLightMode = $('.btn-light-mode');
  var btnDarkMode = $('.btn-dark-mode');
	var titulos = $('.titulos');

  btnDarkMode.click(function() {
    btnDarkMode.hide();
    btnLightMode.show();


    $.ajax({
      url: 'php/darkmode.php',
      method: 'POST',
      data: { valor: 1 },
      success: function(response) {

				$('body').css('--color-one', '#181818');
				$('h1, h2, h3, h4, h5, h6, p').css('color', '#fff');
				$('body, h1, h2, h3, h4, h5, h6, p').css('background-color', '#181818');
				$('.tile:hover').css('color', '#fff');
				$('.tile-tittle').css('color', '#fff');
				$('.titulos').css('color', '#fff');
				$('.tile').css('border', '1px solid #272727');
				$('.tile').css('background-color', '#181818');
				$('.p-icon').css('color', '#fff');
				$('.navbar-info a i').css('color', '#fff');
				

      },
      error: function(xhr, status, error) {
        console.error('Error al enviar el valor:', error);
      }
    });
  });

  btnLightMode.click(function() {
    btnDarkMode.show();
    btnLightMode.hide();

    $.ajax({
      url: 'php/darkmode.php',
      method: 'POST',
      data: { valor: 0 },
      success: function(response) {
				$('body').css('--color-one', '#fff');
				$('h1, h2, h3, h4, h5, h6, p').css('color', '#181818');
				$('body, h1, h2, h3, h4, h5, h6, p').css('background-color', '#fff');
				$('.tile:hover').css('color', '#fff');
				$('.titulos').css('color', 'black');
				$('.titulos').css('font-weight', 'bolder');
				$('.tile').css('border', '1px solid #D8D8D8');
				$('.tile').css('background-color', '#fff');
				$('.p-icon').css('color', '#181818');
				$('.navbar-info a i').css('color', '#181818');


				
      },
      error: function(xhr, status, error) {
        console.error('Error al enviar el valor:', error);
      }
    });
  });

});



</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
