<?php 

if(isset($_SESSION['correo'])){
	$name = $_SESSION['correo'];
}

 ?>



<details class="usuario">
    <summary><img class="foto_usuario" src="../img/usuario.png" alt=""></summary>
    <li><a href="../php/usuario.php" class="nombre_usuario nav-link btn"> <?php  echo $name;?></a></li>
    <li><a href="../Controlador/logout.php" class="cerrar nav-link btn">cerrar sesión</a></li>
</details>