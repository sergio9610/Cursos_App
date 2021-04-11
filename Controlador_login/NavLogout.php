<?php 

if(isset($_SESSION['correo'])){
	$name = $_SESSION['correo'];
}

 ?>

<li class="nav-item dropdown active">
    <a href="../php/usuario.php" class="nombre_usuario nav-link btn"> <?php  echo $name;?></a>
</li>

<li>
	<img class="foto_usuario" src="../img/usuario.png" alt="">
</li>

<li class="nav-item dropdown active">
    <a href="../Controlador_Login/logout.php" class="cerrar nav-link btn">cerrar sesión</a>
</li>