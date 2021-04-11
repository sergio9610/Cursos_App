<?php
$correo = $_POST['correo'];
$password = $_POST['password'];
//Conexion a la base de datos
session_start();
//$_SESSION['correo']=$correo;
  require 'database.php';
  
  if (!empty($correo) && !empty($password)) {
    $conn = conexionSQL();
    $consulta = "SELECT * FROM usuario_id WHERE correo ='$correo'";
    $var = $conn->query($consulta);
    $resultado = $var->fetch_assoc();

    //$filas = mysqli_num_rows($resultado);
    
    if (!empty($resultado) && password_verify($password, $resultado['contrasena'])) {
      $_SESSION['user_id'] = $resultado['id'];
	    $_SESSION['correo'] = $_POST['correo'];
      header("Location: home.php");
    }
	else{
	?>
	<?php
	include("login.php")
	?>
	<p class="loginError fas fa-exclamation-triangle">Error en la autentificación</p><br>
	<?php
	}

}

//Se libera el resultado y se cierra la conexion
mysqli_free_result($var);
mysqli_close($conn);
