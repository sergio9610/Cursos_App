<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cursos Cunati</title>
	<link rel="stylesheet" href="">
	<!-- Bootstrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Css Style -->    
    <link rel="stylesheet" href="../css/style_home.css">
</head>

<body>

	<!-- Logo y Menú Cabecera -->
	<div class="container">
           <nav class="menuPrincipal navbar navbar-expand-md">
                <a href="home.php" class="tituloPrincipal navbar-brand mt-1"><img src="../img/logo.png" alt="Logo" class="logo"></a>
                <div id="menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown active">
                            <a href="home.php" class="inicio nav-link btn">Inicio</a>
                        </li>

                        <?php
                            session_start();
                            require_once "../Controlador/controlador_login.php";
                            if(isset($_SESSION['user_id'])){
                                $mvc = new MvcController();
                                $mvc -> NavLogout();
                            }
                            else{
                                $mvc = new MvcController();
                                $mvc -> NavLogin();
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>

		<!----- Título Principal ---->
		<div id="tituloPrincipal" class="tituloPrincipal">
			<li><h1 class="mensajeBienvenida display-3 text-uppercase font-weight-bold">Cursos Cunati</h1></li>
		</div>

	<!-- Texto Introductorio -->
	<div class="textoIntroductorio">
		<p class="texto_1 mt-3">A continuación encontraras cursos formativos en diferentes areás del conocimiento, algunos con diferentes niveles.<br>
			Los cursos están ofertados tanto en modalidad presencial como virtual.</p>
	</div><br>

 <!--- Cursos con AJAX --->
<h1 class="cursosPresenciales">Cursos Presenciales y Virtuales</h1>
<section id="cursos" class="cursos"></section>
<template id="curso-template">
	<figure class="curso">
		<img>
		<figcaption></figcaption>
	</figure>
</template>
<script src="https://js.stripe.com/v3/"></script>
<script src="../js/stripe-checkout.js" type="module"></script> 


<!----- Controlador de cursos ---- >
<! Si el usuario se encuentra logeado, pasara a pagar cursos, de lo contrario se tendrá que logear o registrar --> 
<?php
    //session_start();
    require_once "../Controlador/controlador_cursos.php";
    if(isset($_SESSION['user_id'])){
        $mvc = new MvcControllerCursos();
        $mvc -> NavCursosOut();
    }
    else{
        $mvc = new MvcControllerCursos();
        $mvc -> NavCursos();
    }
?>


</body>
</html>