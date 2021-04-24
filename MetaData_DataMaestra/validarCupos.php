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
$curso = $_POST["curso"]; 
$sede = $_POST["sede"];
$grupo_horario = $_POST["horario"];
$modalidad = "Presencial";

// Petición id_salon 
$id_salon = $prueba->prepare("SELECT id_salon FROM salon WHERE nombre_sede = '$sede[0]'");
$id_salon->execute();
$result_id_salon = $id_salon->fetchAll();
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

//Ciclo para obtener capacidad en sedes
$tamanoSedes = sizeof($result_capacidad);
$capacidadSede = 0;
for($j=0; $j<$tamanoSedes; $j++){
    $capacidadSede = $capacidadSede + $result_capacidad[$j][0];
}
//echo $capacidadSede;

// Actualización de cupos 
$tamano = sizeof($result_id_salon); //valor de arreglo que recorre salones
if($result_cupos[0][0]>0){
    // Se verifica capacidad en sedes
    if($capacidadSede>0){
        // Actualización de capacidad en sedes (recorre salones)
        for($i=0; $i<$tamano; $i++){
            if($result_capacidad[$i][0]>0){
                $vaux = $result_id_salon[$i][0];
                $query_1 = "UPDATE `salon` SET `capacidad` = `capacidad` -1 WHERE `nombre_sede` = '$sede[0]' and `id_salon` = '$vaux'";
                $result_1=mysqli_query($conexion, $query_1);
                $query_2 = "UPDATE `curso_presencial` SET `cupos` = `cupos` -1 WHERE `nombre_curso` = '$curso[0]'";
                $result_2=mysqli_query($conexion, $query_2);
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


// Insertar info en metadata 
//$insertar_metadata = "INSERT INTO `metadata_datamaestra`( `curso`, `sede`, `grupo_horario`, `modalidad`) VALUES ('$curso[0]', '$sede[0]', '$grupo_horario[0]', '$modalidad' )";
//$result_insertar_metadata = mysqli_query($conexion, $insertar_metadata);

/*
if(!$result_1){
    echo 'Error al registrarse';
} else{
    header("Location: ../php/exito.php");	 
}
 */