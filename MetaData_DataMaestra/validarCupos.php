<?php
// Actualizacion de Cupos
require '../php/conexion.php';
require 'cursos_database.php';
$objData = new Database();

$curso = $_POST["curso"]; 
$sede = $_POST["sede"];

// Petición id_salon 
$id_salon = $objData->prepare('SELECT id_salon FROM salon');
$id_salon->execute();
$result_id_salon = $id_salon->fetchAll();
//echo $result_id_salon[0][0];
// Salones Aranjuez
$s101 = $result_id_salon[0][0];
$s102 = $result_id_salon[1][0];
$s103 = $result_id_salon[2][0];
// Salones Rionegro
$A12 = $result_id_salon[3][0];  
$A13 = $result_id_salon[4][0];
$A14 = $result_id_salon[5][0];
$A15 = $result_id_salon[6][0];
// Salones Manrique
$M1 = $result_id_salon[7][0];
$M2 = $result_id_salon[8][0];
// Salon Sabaneta
$s202 = $result_id_salon[9][0];

// Petición Capacidad
$capacidad = $objData->prepare('SELECT capacidad FROM salon');
$capacidad->execute();
$result_capacidad = $capacidad->fetchAll();
$c101 = $result_capacidad[3][0];
//$c102 = $result_capacidad[1][0];
//$c103 = $result_capacidad[2][0];
//echo $c101;

// Actualización de capacidad en sedes
// Salones Aranjuez
if($result_capacidad[0][0]>0){
    $query_2 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$s101";
    $result_2=mysqli_query($conexion, $query_2);
}
elseif($result_capacidad[1][0]>0){
    $query_3 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$s102";
    $result_3=mysqli_query($conexion, $query_3);
}
elseif($result_capacidad[2][0]>0){
    $query_4 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$s103";
    $result_4=mysqli_query($conexion, $query_4);
}

// Salones Rionegro
/*
elseif($result_capacidad[3][0]>0)
    $query_5 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$A12";
    $result_5=mysqli_query($conexion, $query_5);


elseif($result_capacidad[4][0]>0){
    $query_6 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$A13";
    $result_6=mysqli_query($conexion, $query_6);
}
elseif($result_capacidad[5][0]>0){
    $query_7 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$A14";
    $result_7=mysqli_query($conexion, $query_7);
}
elseif($result_capacidad[6][0]>0){
    $query_8 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$A15";
    $result_8=mysqli_query($conexion, $query_8);
}
// Salones Manrique
elseif($result_capacidad[7][0]>0){
    $query_9 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$M1";
    $result_9=mysqli_query($conexion, $query_9);
}
elseif($result_capacidad[8][0]>0){
    $query_10 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$M2";
    $result_10=mysqli_query($conexion, $query_10);
}
// Salon Sabaneta
else{
    $query_11 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` =$s202";
    $result_11=mysqli_query($conexion, $query_11);
}*/


// Actualización de cupos
//$query_1 = "UPDATE `curso_presencial` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso[0]'";
//$result_1=mysqli_query($conexion, $query_1);  

//echo "<br> sede: " . $sede[0];


/*if(!$result_1){
    echo 'Error al registrarse';
} else{
    header("Location: ../php/exito.php");	 
}
 */