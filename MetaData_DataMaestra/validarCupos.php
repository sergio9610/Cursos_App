<?php
// Actualizacion de Cupos
require '../php/conexion.php';
//require '../php/validarLogin.php';
$curso = $_POST["curso"]; 
$sede = $_POST["sede"];     
//echo "<br> Curso: " . $curso[0];

// Actualización de cupos
$query_1 = "UPDATE `curso_presencial` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso[0]'";
$result_1=mysqli_query($conexion, $query_1);  

//echo "<br> sede: " . $sede[0];

// Actualización de capacidad en sedes
$query_2 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]'";
$result_2=mysqli_query($conexion, $query_2);  

// if(!$result_1){
// 	echo 'Error al registrarse';
// } else{
// 	header("Location: ../php/exito.php");	 
// }
 