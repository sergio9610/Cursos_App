<?php 
require 'conexion.php';
//$db = new conexion();
$num = '0';
$name = 'hola';
session_start();
if(isset($_SESSION['usuario_id'])){
	$num=($_SESSION['correo']);
	$name=($_SESSION['correo']);
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Actualizar Usuario </title>
	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Css Style -->    
    <link rel="stylesheet" href="../Css/style_usuario.css">
    <script src="../js/validacion_registro.js"></script>
</head>

<body>
	<header class="container">
		<div class="container">
           <nav class="menuPrincipal navbar fixed-top navbar-expand-md">
                <a href="home_login.php" class="tituloPrincipal navbar-brand mt-1"><img src="../img/balon_1.png" alt="Logo" class="logo"></a>
                <div id="menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown active">
                            <a href="home.php" class="home">Inicio</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> <br><br>


		<div class="row">
			<div class="col-sm-12 my-4">
				<h1 class="titulo_1 display-6 text-uppercase font-weight-bold mt-5">Actualizar Usuario</h1>
			</div>
			<div class="col-sm-6">
				<img src="../img/cavani.png" alt="cavani" class="cavani">
			</div>

			<div class="col-sm-6 text-center">

				<form action="registro_usuario.php" method="post" class="form-register" onsubmit="return validar_usuario();">
					<!-- <input type="hidden" class="form-control rounded-0 my-4 text-center" value="" name="id"> -->	
					<p class="text-description">Nombre</p>
					<input type="text" id="nombre" class="form-control rounded-0 my-4 text-center" name="nombre"  placeholder="Cambia tu Nombre" required>
					<p class="text-description">Apellido</p>
					<input type="text" id="apellido" class="form-control rounded-0 my-4 text-center" name="apellido" placeholder="Cambia tu Apellido" required>
					<p class="text-description">Celphone</p>
					<input type="text" id="celular" class="form-control rounded-0 my-4 text-center" name="celular" placeholder="Cambia tu # de Celular" required>
					<p class="text-description">Contraseña</p>
					<input type="password" id="contrasena" class="form-control rounded-0 my-4 text-center" name="clave" placeholder="Cambia tu Contraseña" required>
					<p class="text-description">Confirmar Contraseña</p>
					<input type="password" id="confirmar_contrasena" class="form-control rounded-0 my-4 text-center" name="confirmar_contrasena" placeholder="Confirma tu cambio de  contraseña" required><br>
					<input type="submit" value="Actualizar" class="btn-enviar">
					
				</form>

				<ul class="list-unstyled list-inline my-4">	<!-- Quita el esitlo que tiene por defecto la etiqueta ul -->
					<li class="list-inline-item"> <a href="https://www.facebook.com/Pollas3P/"> <!-- El href se puede llenar con la página que se desee -->
							<i class="fcbk fab fa-facebook-f"></i>	<!-- Etiqueta i de icon -->
						</a> 
					</li>
					<li class="list-inline-item"> <a href="https://api.whatsapp.com/send?phone=3148136859&text=%C2%BFEn%20que%20puedo%20ayudarte"> <!-- El href se puede llenar con la página que se desee -->
							<i class="wht fab fa-whatsapp"></i>	<!-- Etiqueta i de icon -->
						</a> 
					</li>
				</ul>
			</div>
		</div>
	</header><!-- /header -->
</body>
</html>