<?php
// Se realiza la conexión con la base de datos
require 'conexion.php';

//Recibir los datos y almacenarlos en variables
$cedula = $_POST["cedula"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$correo = $_POST["correo"];
$ciudad = $_POST["ciudad"];
$barrio = $_POST["barrio"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);


//Consultas para insertar 
$insertar_estudiante = "INSERT INTO `estudiante`( `uniqueid`, `nombres`, `apellidos`, `correo`, `ciudad`, `barrio`) VALUES ('$cedula', '$nombres', '$apellidos', '$correo', '$ciudad', '$barrio')"; 
$insertar_user_id = "INSERT INTO `usuario_id`( `uniqueid`,`correo`, `contrasena`) VALUES ('$cedula', '$correo', '$password' )";


//Se verifica que no se repita correo electrónico
$verificar_correo = mysqli_query($conexion, "SELECT * FROM estudiante WHERE correo = '$correo'");
if(mysqli_num_rows($verificar_correo) > 0){
	echo '<script>
			alert("El correo ya está registrado");
			window.history.go(-1);
		 </script>';
	exit;	//termina la consulta
}

//Ejecutar Consultas
$resultado_estudiante = mysqli_query($conexion, $insertar_estudiante);
$resultado_user_id = mysqli_query($conexion, $insertar_user_id);

if(!$resultado_estudiante){
	echo 'Error al registrarse';
} else{
	echo '<script>
			alert("Se ha registrado exitosamente");
		 </script>';
	header("Location: login.php");	 
}

//Cerrar Conexion
mysqli_close($conexion);



 ?>