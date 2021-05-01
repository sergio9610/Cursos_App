<?php
// Conexion a base de datos
require 'cursos_database.php';
$objData = new Database();
$connect = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");  

function fill_curso($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM docente";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["curso_id"].'">'.$row["curso"].'</option>';  
      }  
      return $output;  
 }  
 function fill_grupo($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM grupo_horario_aux";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {    
           $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["grupo_horario"].'';  
      }  
      return $output;  
 } 

// Petición para curso
$curso = $objData->prepare('SELECT nombre_curso FROM curso_presencial');
$curso->execute();
$result_curso = $curso->fetchAll();

// Petición para sede
$sede = $objData->prepare('SELECT barrio, nombre_sede FROM sedes');
$sede->execute();
$result_sede = $sede->fetchAll();

// Petición para Grupo y Horario
$gr_horario = $objData->prepare('SELECT grupo_horario FROM docente');
$gr_horario->execute();
$result_gr_horario = $gr_horario->fetchAll();

//echo $result_id_salon[1][0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programacion Curso</title>
	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Css Style -->
    <link rel="stylesheet" href="../css/styleProgramacion.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	
</head>
<body>
<header class="container">

	<!--- Logo --->
		<div class="container">
           <nav class="menuPrincipal navbar fixed-top navbar-expand-md">
                <a href="../php/home.php" class="logo navbar-brand mt-1"><img src="../img/logo.png" alt="Logo" class="logo"></a>
                <div id="menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                    <li class="dropdown active">
                            <a href="home.php" class="inicio btn-outline">Inicio</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> <br><br>

	<!--- Titulo Principal --->
		<div class="tituloPrincipal">
			<h1 id = "titulo_1" class="titulo_1 display-5 text-uppercase font-weight-bold">Programación de tu Curso</h1>
		</div>

	<!--- Formulario Elección Curso --->	
		<div class="formulario col-sm-6 text-center">
				
			<form method="post" class="formulario" id="formulario" onsubmit="return validar();" action="validarCupos.php">
                <table>
					<tr>
					<!--- Ocupación --->
						<th>
							<div class="formulario__grupo" id="grupo__ocupacion">
								<label for="correo" class="formulario__label formulario__label-ocupacion">Ocupación</label>
								<div class="formulario__grupo-input">
									<input type="text" id="ocupacion" class="formulario__input" name="ocupacion">
								</div>
							</div>
                        </th> 
						<!--- Correo --->
						<th>
							<div class="formulario__grupo" id="grupo__correo">
								<label for="correo" class="formulario__label formulario__label-correo">Correo</label>
								<div class="formulario__grupo-input">
									<input type="email" id="correo" class="formulario__input" name="correo">
								</div>
							</div>
                        </th>
					</tr>

                    <tr>
                        <!--- Curso --->
                        <th>
							<select name="curso[]" id="curso">  
                          		<option value=""></option>  
                          		<option><?php echo fill_curso($connect); ?></option>  
                    	 	</select>
                        </th>
                        
                        <!--- Horario --->
                        <th>
							<div class="row" id="show_grupo"> 
                         		<label for="horario" class="formulario__label formulario__label-horario">Horario</label>
				     			<select name="horario[]" id="horario">
                              		<option value=""></option>
					                <!-- Se llama el result de la consulta de db_ciudad -->
                              		<?php
					     			foreach ($result as $key => $value){?>
					     			<option><?php echo fill_grupo($connect);?></option>
					     			<?php
					     			}
					     			?>
                            	</select>
                     		
                            </div>
                        </th>

						<!--- Sede --->
                        <th>
			                <div class="formulario__grupo" id="grupo__sede">
				                <label for="sede" class="formulario__label formulario__label-sede">Sede</label>
				                <select name="sede[]" id="sede">
                                    <option value=""></option>
					                 
                                    <?php
					                foreach ($result_sede as $key => $value){?>
					                <option><?php echo $value['nombre_sede'];?></option>
					                <?php
					                }
					                ?>
                            	</select>
                            </div>
                        </th>
                    </tr>
                </table><br>

				<!--- Boton de Registro --->
				<button type="submit" class="btn rounded">
					<a class="btn_registrate text-uppercase font-weight-bold"> Registrate </a>
				</button>
			</form>

				<!--- Footer con Red Sociales --->
				<ul class="redes list-unstyled list-inline my-4">	<!-- Quita el esitlo que tiene por defecto la etiqueta ul -->
					<li class="list-inline-item"> <a href="https://www.facebook.com/" target="blank"> <!-- El href se puede llenar con la página que se desee -->
							<i class="fcbk fab fa-facebook-f"></i>	<!-- Etiqueta i de icon -->
						</a> 
					</li>
					<li class="list-inline-item"> <a href="https://api.whatsapp.com/send?phone=573126386300&text=%C2%BFEn%20que%20puedo%20ayudarte?" target="blank"> 
							<i class="wht fab fa-whatsapp"></i>	<!-- Etiqueta i de icon -->
						</a> 
					</li>
					<li class="list-inline-item"> <a href="https://www.instagram.com/?hl=es" target="blank"> 
							<i class="fab fa-instagram"></i>	<!-- Etiqueta i de icon -->
						</a> 
					</li>
				</ul>
		</div>
	
	</header><!-- /header -->
	<!-- Scripts -->
	<script src="../js/validacion_curso.js"></script>
</body>
</html>