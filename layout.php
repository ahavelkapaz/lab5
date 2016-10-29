<?php
		session_start();
		$user='anonimo';
	if(isset($_SESSION['loggedin']))
		$user=$_SESSION['user'];

?>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		  	<script src="js/jquery-3.1.1.min.js"></script>
			<script>
			$(document).ready(function(){
				
				var x=$('#userh p').text();

			if(x=='anonimo'){
				$('#logged').hide();
				$('#notlogged').show();
			}
			else{
				
				$('#notlogged').hide();
				$('#logged').show();
			}
			
			});
			</script>
		 <!--	<script> 
			$(document).ready(function(){
				$("a#h_login").on('click', function(e){
					e.preventDefault(); 
					$("#contenido").load("login.php", function(response, status, xhr) {});
				}); 
								$("a#h_register").on('click', function(e){
					e.preventDefault(); 
					$("#contenido").load("registro.html", function(response, status, xhr) {});
				}); 
						$("a#h_logout").on('click', function(e){
					e.preventDefault(); 
					$("#contenido").load("logout.php", function(response, status, xhr) {});
				}); 
								$("a#h_questions").on('click', function(e){
					e.preventDefault(); 
					$("#contenido").load("verPreguntas.php", function(response, status, xhr) {});
				}); 
						$("a#h_credits").on('click', function(e){
					e.preventDefault(); 
					$("#contenido").load("creditos.html", function(response, status, xhr) {});
				}); 
			});
			</script> -->
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<div id="userh" hidden><p><?php echo $user; ?></p></div>
		<span class="right"><a id="h_register" href="registro.html">Registrarse</a></span>
			<div id="notlogged">
      		<span class="right"><a id="h_login" href="login.php">Login</a></span>
			</div>
			<div id="logged">
			<p id="saludo">Hola <?php echo $user; ?></p>
			<span class="right"><a id="h_logout" href="logout.php">Logout</a></span>
      		<span class="right" style="display:none;">
			</div>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a id="h_questions" href='verPreguntas.php'>Ver preguntas</a></span>
		<span><a id="h_registerQuestion" href='insertarPregunta.php'>Registrar una pregunta</a></span>		
		<span><a id="h_users" href='verUsuarios.php'>Ver Usuarios</a></span>
		<span><a id="h_credits" href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div id="contenido" name="contenido">
	Aqui se visualizan las preguntas y los creditos ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/ahavelkapaz/'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

