<?php
// Actualizacion de Cupos
require '../php/conexion.php';
require 'cursos_database_2.php';
// ******************
//$connect = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");
/*$output = '';  
 if(isset($_POST["curso_id"]))  
 {  
      if($_POST["curso_id"] != '')  
      {  
           $sql = "SELECT * FROM grupo_horario_aux WHERE curso_id = '".$_POST["curso_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM grupo_horario_aux";  
      }  
      $result = mysqli_query($conexion, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["grupo_horario"].'</div></div>';  
      }  
      echo $output;  
 } */


$prueba = new base();

// Variables 
$ocupacion = $_POST["ocupacion"];
$correo = $_POST["correo"];
$curso = $_POST["curso"]; 
$sede = $_POST["sede"];
$grupo_horario = $_POST["horario"];
$modalidad = "Presencial";

$sede_aux = $sede[0];
$curso_aux = $curso[0];
$grupo_horario_aux = $grupo_horario[0];

// Petición id_salon 
$id_salon = $prueba->prepare("SELECT id_salon FROM salon WHERE nombre_sede = '$sede[0]'");
$id_salon->execute();
$result_id_salon = $id_salon->fetchAll();
$salon_aux = $result_id_salon[0][0];
//echo $result_id_salon[0][0];

// Petición Capacidad
$capacidad = $prueba->prepare("SELECT capacidad FROM salon WHERE nombre_sede = '$sede[0]'");
$capacidad->execute();
$result_capacidad = $capacidad->fetchAll();
//echo ' '.$result_capacidad[0][0];
//echo ' valor arreglo: '.$tamano;

// Petición de Cupos
$cupos = $prueba->prepare("SELECT cupos FROM curso_presencial WHERE nombre_curso = '$curso[0]'");
$cupos->execute();
$result_cupos = $cupos->fetchAll();

// Petición Docente
//Nombre
$docente_nombre = $prueba->prepare("SELECT nombre FROM docente WHERE curso = '$curso[0]'");
$docente_nombre->execute();
$result_docente_nombre = $docente_nombre->fetchAll();
$docente_nombre_aux =  $result_docente_nombre[0][0];
//Apellido
$docente_apellido = $prueba->prepare("SELECT apellido FROM docente WHERE curso = '$curso[0]'");
$docente_apellido->execute();
$result_docente_apellido = $docente_apellido->fetchAll();
$docente_apellido_aux =  $result_docente_apellido[0][0];

$docente_aux = $docente_nombre_aux.' '.$docente_apellido_aux;

//Ciclo para obtener capacidad en sedes
$tamanoSedes = sizeof($result_capacidad);
$capacidadSede = 0;
for($j=0; $j<$tamanoSedes; $j++){
    $capacidadSede = $capacidadSede + $result_capacidad[$j][0];
}
//echo $capacidadSede;

//Verificación de correo y curso (que no se repita el curso)
$verificar_correo = mysqli_query($conexion, "SELECT * FROM metadata_datamaestra WHERE correo = '$correo'");
$verificar_curso = mysqli_query($conexion, "SELECT * FROM metadata_datamaestra WHERE curso = '$curso[0]'");


if(mysqli_num_rows($verificar_correo) > 0 && mysqli_num_rows($verificar_curso) > 0){
	?>
        <?php
            include("programacion_cursos.php")
        ?>
        <p class="loginError fas fa-exclamation-triangle">Este curso ya está inscrito </p><br>
        <?php	//termina la consulta
        
}

else{
    // Actualización de cupos 
    $tamano = sizeof($result_id_salon); //valor de arreglo que recorre salones
    if($result_cupos[0][0]>0){
        // Se verifica capacidad en sedes
        if($capacidadSede>0){
            // Actualización de capacidad en sedes (recorre salones)
            for($i=0; $i<$tamano; $i++){
                if($result_capacidad[$i][0]>0){
                    $vaux = $result_id_salon[$i][0];
                    $query_1 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede_aux' and `id_salon` = '$vaux'";
                    $result_1=mysqli_query($conexion, $query_1);
                    $query_2 = "UPDATE `curso_presencial` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso_aux'";
                    $result_2=mysqli_query($conexion, $query_2);
                    // Insertar info en metadata 
                    $insertar_metadata = "INSERT INTO `metadata_datamaestra`(`ocupacion`, `correo`, `curso`, `sede`, `salon`, `docente`, `grupo_horario`, `modalidad`) VALUES ('$ocupacion', '$correo', '$curso_aux', '$sede_aux', '$salon_aux', '$docente_aux', '$grupo_horario', '$modalidad' )";
                    $result_insertar_metadata = mysqli_query($conexion, $insertar_metadata);
                    header("Location: ../php/exito.php");
                    break;
            }
        }
    }
        else{
            ?>
            <?php
            include("programacion_cursos.php")
            ?>
            <p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay capacidad en la sede </p><br>
            <?php
        }
    
    }
    else{
        ?>
        <?php
	    include("programacion_cursos.php")
        ?>
        <p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay cupos disponibles </p><br>
        <?php
    }
}
