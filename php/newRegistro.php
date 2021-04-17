<!--- Se llama base de datos para las ciudades ---->
<?php
// Conexion a base de datos de ciudades
require 'ciudad_database.php';
$objData = new Database();

if(isset($_GET['opcion'])){
	$sth1 = $objData->prepare('	');
}

$sth = $objData->prepare('SELECT ciudad_id, ciudad_nombre FROM ciudad');
$sth->execute();
$result = $sth->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registro</title>
	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Css Style -->    
    <link rel="stylesheet" href="../css/styleRegistro.css">
</head>
<body>
	
	<header class="container">
		<!-- Logo -->
        <div class="container">
           <nav class="menuPrincipal navbar fixed-top navbar-expand-md">
                <a href="home_login.php" class="tituloPrincipal navbar-brand mt-1"><img src="../img/logo.png" alt="Logo" class="logo"></a>
                <div id="menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                        <li class="dropdown active">
                            <a href="home.php" class="home btn btn-outline">Inicio</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> <br><br>
		
		<!-- Título Principal -->
		<div class="principal">
			<div class="cuadro_1">
				<h1 class="titulo_1 display-4 font-weight-bold mt-5">Crea tu Usuario</h1>
			</div>

		<!---- Formulario ---->
		<form method="post" class="formulario" id="formulario" onsubmit="return validar();" action="validarRegistro.php">
			
			<!-- Cédula -->
			<div class="formulario__grupo" id="grupo__cedula">
				<label for="cedula" class="formulario__label formulario__label-cedula">Cédula</label>
				<div class="formulario__grupo-input">
					<input type="text" id="cedula" class="formulario__input rounded" name="cedula">
				</div>
				
			</div>		
			<!-- Nombres -->
			<div class="formulario__grupo" id="grupo__nombres">
				<label for="nombres" class="formulario__label formulario__label-nombres">Nombres</label>
				<div class="formulario__grupo-input">
					<input type="text" id="nombres" class="formulario__input rounded" name="nombres">
				</div>
			</div>
					
			<!-- Apellido -->
			<div class="formulario__grupo" id="grupo__apellido">
				<label for="apellido" class="formulario__label formulario__label-apellido">Apellidos</label>
				<div class="formulario__grupo-input">
					<input type="text" id="apellidos" class="formulario__input rounded" name="apellidos">
				</div>
			</div>
			
			<!-- Correo -->
			<div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label formulario__label-correo">Correo</label>
				<div class="formulario__grupo-input">
					<input type="email" id="correo" class="formulario__input rounded" name="correo">
				</div>
			</div>

            <!-- Contraseña -->
			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label formulario__label-password">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" id="password" class="formulario__input rounded" name="password">
				</div>
			</div>

            <!-- Confirmación de Contraseña -->
			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label formulario__label-password2">Confirmar Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" id="password2" class="formulario__input rounded" name="password2">
				</div>
			</div>

            <!-- Ciudad -->
			<div class="formulario__grupo" id="grupo__ciudad">
				<label for="ciudad" class="formulario__label formulario__label-ciudad">Ciudad</label>
				<select name="ciudad" id="ciudad">
                    <option value=""></option>
					<!-- Se llama el result de la consulta de db_ciudad -->
                    <?php

					foreach ($result as $key => $value){?>
					<option><?php echo $value['ciudad_nombre'];?></option>
					<?php
					}

					?>
                </select>
				<!--<div class="formulario__grupo-input">
					<input type="text" id="ciudad" class="formulario__input rounded" name="ciudad">
				</div>-->
			</div>

             <!-- Barrio -->
			<div class="formulario__grupo" id="grupo__barrio">
				<label for="barrio" class="formulario__label formulario__label-barrio">Barrio</label>
				<div class="formulario__grupo-input">
					<input type="text" id="barrio" class="formulario__input rounded" name="barrio">
				</div>
			</div>

			<!-- Terminos y Condiciones -->
			<div class="formulario__grupo" id="grupo__terminos">
				<label for="" class="formulario__label">
					<input type="checkbox" class="formulario__checkbox" name="terminos" id="terminos">
					<a href="terminosCondiciones.php" target="blank" title="Haz click para leer Terminos y Condiciones">Acepto Terminos y Condiciones</a>
				</label>
			</div>

			<!-- Mensaje de Warning -->
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor complete el formulario correctamente</p>
			</div>

			<!-- Boton -->
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn btn rounded">Crear usuario</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente</p>
			</div>
						
					
		</form>
	</header>
	<!-- Scripts -->
	<script src="../js/validacion_registro.js"></script>
    <script src="../js/ciudad.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>