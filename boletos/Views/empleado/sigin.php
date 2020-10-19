<?php
//Para iniciar una sesion
session_start();

if (isset($_SESSION["user"])) {
	header("location:?e=Empleados&a=Index1");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Boletos</title>
</head>
<body>
<!-- Inicio contenedor padre -->
<div class="modal-dialog text-center">
	<!-- le decimos que utilize un 3/4 de la panalla -->
	<div class="col-slm-8 main-section">
		<!-- Contenido del modal -->
		<div class="modal-content">
			<!-- Imagen del avatar -->
			<div class="col-12 user-img">
				<img src="assets/img/picture.jpg" style="text-align:center;" class="rounded float-right">
			</div>
			<!-- Fin imagen del avatar -->
			<!-- Inicio del formulario -->
			<form class="col-12" action="" method="post">
				<div class="form-group" id="user-group">
					<input type="text" placeholder="Usuario"  name="user" id="user" class="form-control">
				</div>

				<div class="form-group" id="pass-group">
					<input type="password" placeholder="Contraseña" name="pass" id="pass" class="form-control">
				</div>

				<input type="button" name="login" id="login"  value="Ingresar" class="btn btngris">
				
				<div>
					
					<a  href="?e=Empleados&a=crearUsuario">Crear cuenta</a>
				</div>

				<div class="col-12 text-center">
					<span id="Resultado"></span>
				</div>
			</form>
			<!-- Fin del formulario -->
		</div>
		<!-- Fin contenido del modal -->
	</div>
	<!-- FIn 3/4 Pantalla -->
</div>
<!-- Fin contenedor padre -->
</body>
</html>