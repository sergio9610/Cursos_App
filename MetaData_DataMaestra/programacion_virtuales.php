<?php
// Conexion a base de datos
require 'cursos_database.php';
$objData = new Database();
$connect = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");  
function fill_curso($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM curso_virtual";  
      $result = mysqli_query($connect, $sql);  
	 
	  //Peticion para nombre_curso
	  $objData = new Database();
	  $sql_nombre_curso = $objData->prepare('SELECT nombre_curso FROM curso_virtual');  
	  $sql_nombre_curso->execute(); 
	  $result_nombre_curso = $sql_nombre_curso->fetchAll();
	  $nombre_curso_aux  = $result_nombre_curso[0][0];
      
	  //Peticion para cupos
	  $sql_cupos = $objData->prepare('SELECT cupos  FROM curso_virtual');  
	  $sql_cupos->execute(); 
	  $result_cupos = $sql_cupos->fetchAll();

	  //Peticion para curso_id
	  $sql_curso_id = $objData->prepare('SELECT curso_id  FROM curso_virtual');  
	  $sql_curso_id->execute(); 
	  $result_curso_id = $sql_curso_id->fetchAll();
	  $curso_id_aux = $result_curso_id[0][0];

	  //Ciclo para obtener capacidad 
	  $tamanoCupos = sizeof($result_cupos);
	  $capacidad = 0;
	  //$capacidadNombreCurso = 0;
	  for($j=0; $j<$tamanoCupos; $j++){
		  $capacidad =  $result_cupos[$j][0];
		  $curso_id_aux = $result_curso_id[$j][0];
		  $nombre_curso_aux = $result_nombre_curso[$j][0];
		  if($capacidad > 0){
			$output .= '<option value="'.$curso_id_aux.'">'.$nombre_curso_aux.'</option>';
		  }
		  else{
			$output .= '';
		  }
	  }
	  return $output;

	  /*while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$curso_id_aux.'">'.$nombre_curso_aux.'</option>';  
      }*/  
        
 } 
 function fill_grupo($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM grupo_horario_virtual_aux";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {    
           $output = $row["grupo_horario"];  
      }  
      return $output;  
 } 

 function fill_cupos($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM grupo_horario_aux";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {    
           $output = $row["cupos"];  
      }  
      return $output;  
 }

// Petici??n para curso
$curso = $objData->prepare('SELECT nombre_curso FROM curso_presencial');
$curso->execute();
$result_curso = $curso->fetchAll();

// Petici??n para sede
$sede = $objData->prepare('SELECT barrio, nombre_sede FROM sedes');
$sede->execute();
$result_sede = $sede->fetchAll();

// Petici??n para Grupo y Horario
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
    <title>Programacion Curso Virtual</title>
	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Css Style -->
    <link rel="stylesheet" href="../css/style_virtual.css">
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
			<h1 id = "titulo_1" class="titulo_1 display-5 text-uppercase font-weight-bold">Programaci??n Curso Virtual</h1>
		</div>

	<!--- Formulario Elecci??n Curso --->	
		<div class="formulario col-sm-6 text-center">
				
			<form method="post" class="formulario" id="formulario" onsubmit="return validar();" action="validarCuposVirtual.php">
                <table>
					<tr>
					<!--- Ocupaci??n --->
						<th>
							<div class="formulario__grupo" id="grupo__ocupacion">
								<label for="correo" class="formulario__label formulario__label-ocupacion">Ocupaci??n</label>
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
							<div>
								<label for="curso" class="formulario__label formulario__label-curso">Curso</label>
								<select name="curso[]" id="curso">
                          			<option><?php echo fill_curso($connect); ?></option>  
                    	 		</select>
							</div>
                        </th>
                        
                        <!--- Horario --->
                        <th>
							<div class="row" id="show_grupo"> 
                         		<label for="horario" class="">Horario</label>
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
                    </tr>
                </table><br>

				<!--- Boton de Registro --->
				<button type="submit" class="btn rounded">
					<a class="btn_registrate text-uppercase font-weight-bold"> Registrate </a>
				</button>
			</form>

				<!--- Footer con Red Sociales --->
				<ul class="redes list-unstyled list-inline my-4">	<!-- Quita el esitlo que tiene por defecto la etiqueta ul -->
					<li class="list-inline-item"> <a href="https://www.facebook.com/" target="blank"> <!-- El href se puede llenar con la p??gina que se desee -->
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
	<script src="../js/validacionVirtual.js"></script>
</body>
</html>