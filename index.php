<?php include("php/database.php"); 

session_start();

// Verificar si la sesión está activa
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="assets/icons/system.png" type="image/png">
	<title>Inicio | SIVIGE</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/fade.css">

	<!-- CSS --> 
	<style>
		body {
			background: #ffe259;
			background: linear-gradient(to right, #ffa751, #ffe259);	
		}
		.bg {
			background-image: url(assets/img/towers.jpg);
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}		
	</style>

</head>
<body>

	<div class="container w-75 bg-primary mt-5 rounded shadow">
		<div class="row align-items-stretch">

			<div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded-start"></div>

			<div class="col bg-white p-5 rounded-end">
				<div class="text-center fade-in-top">
					<img src="assets/avatar/woman.png" width="48" alt="Logo" class="mt-lg-5">
				</div>
				<h2 class="fw-bold text-center py-5 display-4 fade-in-top">SIVIGE</h2>

				<!-- LOGIN -->
				
				<form action="php/login.php" method="post" class="mb-5 pb-lg-2">
					<div class="mb-4">
						<Label for="username" class="form-label">Usuario</Label>
						<input type="text" class="form-control" name="user" autocomplete="off">
					</div>
					<div class="mb-4">
						<Label for="password" class="form-label">Contraseña</Label>
						<input type="password" class="form-control" name="pass">
					</div>
<!-- 					<div class="mb-4 form-check">
						<input type="checkbox" name="connected" class="form-check-input" id="connected">
						<label for="connected" class="form-check-label">¿Mantener Sesión Iniciada?</label>
					</div> -->

					<?php
						if (isset($_GET['error'])) {
							$error = $_GET['error'];

							if ($error === 'empty_fields') {
								?>
							
								<p class="text-center">Hay uno o mas camos incompletos.</p>
	
								<?php
							}
							if ($error === 'invalid_credentials') {
								?>
							
								<p class="text-center">Datos incorrectos. Verifique los datos.</p>
	
								<?php
							}


						}
					?>


					<div class="d-grid">
						<button type="submit" class="btn btn-primary">Iniciar Sesíon</button>
					</div>


				</form>
			</div>
		</div>
	</div>

	
</body>
</html>