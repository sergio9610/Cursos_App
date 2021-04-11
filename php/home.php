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
           <nav class="menuPrincipal navbar fixed-top navbar-expand-md">
                <a href="home.php" class="tituloPrincipal navbar-brand mt-1"><img src="../img/logo.png" alt="Logo" class="logo"></a>
                <div id="menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown active">
                            <a href="home.php" class="inicio nav-link btn">Inicio</a>
                        </li>

                        <?php
                            session_start();
                            require_once "../Controlador_Login/controlador_login.php";
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
        </div><br><br>

		<!----- Título Principal ---->
		<div id="tituloPrincipal" class="tituloPrincipal">
			<li><h1 class="mensajeBienvenida display-3 text-uppercase font-weight-bold">Cursos Cunati</h1></li>
		</div>

	<!-- Texto Introductorio -->
	<div class="textoIntroductorio">
		<p class="texto_1 mt-3">A continuación encontraras cursos formativos en diferentes areás del conocimiento, algunos con diferentes niveles.<br>
			Los cursos están ofertados tanto en modalidad presencial como virtual.</p>
	</div><br>

 <!--- Cursos --->
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

<!-- Cursos Presenciales 
<h1 class="cursosPresenciales">Cursos Presenciales</h1>
<table class="presenciales">
	<tr>
		<th><button class="btn rounded">
					<a class="btn_ingles_1 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 1 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_ingles_2 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 2 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_ingles_3 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 3 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_frances_1 text-uppercase font-weight-bold rounded" href="pago.php"> Francés 1 </a>
			</button></th>
	</tr>

	<tr>
		<th><button class="btn rounded">
					<a class="btn_frances_avc text-uppercase font-weight-bold rounded" href="pago.php"> Francés Avanzado </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_aleman_bas text-uppercase font-weight-bold rounded" href="pago.php"> Alemán Básico </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_cocina_1 text-uppercase font-weight-bold rounded" href="pago.php"> Cocina 1 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_cocina_itl text-uppercase font-weight-bold rounded" href="pago.php"> Cocina Italiana </a>
			</button></th>
	</tr>

	<tr>
		<th><button class="btn rounded">
					<a class="btn_arte_1 text-uppercase font-weight-bold rounded" href="pago.php"> Arte 1 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_arte_2 text-uppercase font-weight-bold rounded" href="pago.php"> Arte 2 </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_dibujo text-uppercase font-weight-bold rounded" href="pago.php"> Dibujo </a>
			</button></th>
		<th><button class="btn rounded">
					<a class="btn_carpinteria text-uppercase font-weight-bold rounded" href="pago.php"> Carpinteria </a>
			</button></th>
	</tr>

	<tr>
		<th><button class="btn rounded">
					<a class="btn_macrame text-uppercase font-weight-bold rounded" href="pago.php"> Macrame </a>
			</button></th>
	</tr>
</table><br>

	Cursos Virtuales 
	<h1 class="cursosVirtuales">Cursos Virtuales</h1>

	<table class="virtuales">
		<tr>
			<th><button class="btn rounded">
						<a class="btn_inglesV_1 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 1 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_inglesV_2 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 2 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_inglesV_3 text-uppercase font-weight-bold rounded" href="pago.php"> Inglés 3 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_francesV_1 text-uppercase font-weight-bold rounded" href="pago.php"> Francés 1 </a>
				</button></th>
		</tr>

		<tr>
			<th><button class="btn rounded">
						<a class="btn_francesV_avc text-uppercase font-weight-bold rounded" href="pago.php"> Francés Avanzado </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_alemanV_bas text-uppercase font-weight-bold rounded" href="pago.php"> Alemán Básico </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_cocinaV_1 text-uppercase font-weight-bold rounded" href="pago.php"> Cocina 1 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_cocinaV_itl text-uppercase font-weight-bold rounded" href="pago.php"> CocinaV Italiana </a>
				</button></th>
		</tr>

		<tr>
			<th><button class="btn rounded">
						<a class="btn_arteV_1 text-uppercase font-weight-bold rounded" href="pago.php"> ArteV 1 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_arteV_2 text-uppercase font-weight-bold rounded" href="pago.php"> ArteV 2 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_dibujoV text-uppercase font-weight-bold rounded" href="pago.php"> DibujoV </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_carpinteriaV text-uppercase font-weight-bold rounded" href="pago.php"> CarpinteriaV </a>
				</button></th>
		</tr>

		<tr>
			<th><button class="btn rounded">
						<a class="btn_macrameV text-uppercase font-weight-bold rounded" href="pago.php"> MacrameV </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_portuguesV_1 text-uppercase font-weight-bold rounded" href="pago.php"> PortuguésV 1 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_portuguesV_2 text-uppercase font-weight-bold rounded" href="pago.php"> PortuguésV 2 </a>
				</button></th>
			<th><button class="btn rounded">
						<a class="btn_portuguesV_3 text-uppercase font-weight-bold rounded" href="pago.php"> PortuguésV 3 </a>
				</button></th>
		</tr>

		<tr>
			<th><button class="btn rounded">
						<a class="btn_musicaV text-uppercase font-weight-bold rounded" href="pago.php"> Música </a>
				</button></th>
		</tr>
	</table> -->


</body>
</html>