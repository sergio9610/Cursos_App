<?php
// Conexion a base de datos
require 'cursos_database_2.php';
require '../php/conexion.php';

// Variables
$ocupacion = $_POST["ocupacion"];
$correo = $_POST["correo"];
$curso = $_POST["curso"]; 
$modalidad = "Virtual";
$noAplica = "No aplica";

$obj = new base();     

// Petición Cupos
$cupos = $obj->prepare("SELECT cupos FROM curso_virtual WHERE `curso_id` = '$curso[0]'");
$cupos->execute();
$result_cupos = $cupos->fetchAll();
//$cp1 = $result_cupos[0][0];

// Petición Curso
$nombre_curso = $obj->prepare("SELECT nombre_curso FROM curso_virtual WHERE curso_id = '$curso[0]'");
$nombre_curso->execute();
$result_nombre_curso = $nombre_curso->fetchAll();
$nombre_curso_aux  = $result_nombre_curso[0][0];

// Petición Docente
//Nombre
$docente_nombre = $obj->prepare("SELECT nombre FROM docente WHERE curso_id = '$curso[0]'");
$docente_nombre->execute();
$result_docente_nombre = $docente_nombre->fetchAll();
$docente_nombre_aux =  $result_docente_nombre[0][0];

//Apellido
$docente_apellido = $obj->prepare("SELECT apellido FROM docente WHERE curso_id = '$curso[0]'");
$docente_apellido->execute();
$result_docente_apellido = $docente_apellido->fetchAll();
$docente_apellido_aux =  $result_docente_apellido[0][0];
$docente_aux = $docente_nombre_aux.' '.$docente_apellido_aux;   //nombre y apellido

// Petición grupo_horario
$grupo_horario = $obj->prepare("SELECT grupo_horario FROM docente WHERE curso_id = '$curso[0]'");
$grupo_horario->execute();
$result_grupo_horario = $grupo_horario->fetchAll();
$grupo_horario_aux = $result_grupo_horario[0][0];

//Verificación de correo y curso (que no se repita el curso)
$verificar_correo = mysqli_query($conexion, "SELECT * FROM metadata_datamaestra WHERE correo = '$correo'");
$verificar_curso = mysqli_query($conexion, "SELECT * FROM metadata_datamaestra WHERE curso = '$nombre_curso_aux'");


if(mysqli_num_rows($verificar_correo) > 0 && mysqli_num_rows($verificar_curso) > 0){
	?>
        <?php
            include("programacion_virtuales.php")
        ?>
        <p class="loginError fas fa-exclamation-triangle">Este curso ya está inscrito </p><br>
        <?php	//termina la consulta
        
}


else{
    // Actualización de cupos
    if($result_cupos[0][0]>0){
        $query_1 = "UPDATE `curso_virtual` SET `cupos` = `cupos` -1 WHERE `curso_id` = '$curso[0]'";
        $result_1=mysqli_query($conexion, $query_1);
        $insertar_metadata = "INSERT INTO `metadata_datamaestra`(`ocupacion`, `correo`, `curso`, `sede`, `salon`, `docente`, `grupo_horario`, `modalidad`) VALUES ('$ocupacion', '$correo', '$nombre_curso_aux', '$noAplica', '$noAplica', '$docente_aux', '$grupo_horario_aux', '$modalidad' )";
        $result_insertar_metadata = mysqli_query($conexion, $insertar_metadata);
        header("Location: ../php/exito.php");
    }
    else{
    ?>
    <?php
        include("programacion_virtuales.php")
    ?>
    <p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay cupos disponibles </p><br>
    <?php
    }
}
