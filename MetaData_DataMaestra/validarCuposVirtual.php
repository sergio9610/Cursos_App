<?php
// Actualizacion de Cupos
require 'cursos_database_2.php';
require '../php/conexion.php';

$obj = new base();

$curso = $_POST["curso"];      

// Petición Capacidad
$cupos = $obj->prepare('SELECT cupos FROM curso_virtual');
$cupos->execute();
$result_cupos = $cupos->fetchAll();
$cp1 = $result_cupos[0][0];
// Actualización de cupos
if($result_cupos[0][0]>0){
    $query_1 = "UPDATE `curso_virtual` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso[0]'";
    $result_1=mysqli_query($conexion, $query_1);
}
else{
?>
<?php
	include("programacion_virtuales.php")
?>
<p class="loginError fas fa-exclamation-triangle">Lo sentimos, no hay cupos disponibles </p><br>
<?php
}


// if(!$result_1){
// 	echo 'Error al registrarse';
// } else{
// 	header("Location: ../php/exito.php");	 
// }
 