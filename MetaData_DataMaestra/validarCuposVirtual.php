<?php
// Actualizacion de Cupos
require 'cursos_database_2.php';
require '../php/conexion.php';

// Variables
$curso = $_POST["curso"]; 
$grupo_horario = $_POST["horario"];
$modalidad = "Virtual";
$noAplica = "No aplica";

$obj = new base();     

// Petición Capacidad
$cupos = $obj->prepare("SELECT cupos FROM curso_virtual WHERE `nombre_curso` = '$curso[0]'");
$cupos->execute();
$result_cupos = $cupos->fetchAll();
$cp1 = $result_cupos[0][0];
echo $cp1;
// Actualización de cupos
if($result_cupos[0][0]>0){
    $query_1 = "UPDATE `curso_virtual` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso[0]'";
    $result_1=mysqli_query($conexion, $query_1);
    /*if(!$result_1){
        echo 'Error al registrarse';
    } else{
        header("Location: ../php/exito.php");	 
    }*/
}
else{
?>
<?php
	include("programacion_virtuales.php")
?>
<p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay cupos disponibles </p><br>
<?php
}

//$insertar_metadata = "INSERT INTO `metadata_datamaestra`( `curso`, `sede`, `salon`, `grupo_horario`, `modalidad`) VALUES ('$curso[0]', '$noAplica', '$noAplica', '$grupo_horario[0]', '$modalidad' )";
//$result_insertar_metadata = mysqli_query($conexion, $insertar_metadata);
/*else{
    ?>
    <?php
        include("programacion_virtuales.php")
    ?>
    <p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay cupos disponibles </p><br>
    <?php
    }*/