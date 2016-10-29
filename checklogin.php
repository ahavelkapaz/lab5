<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	$now = time();

	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado,
	<a href='login.php'>Necesita Hacer Login</a><br>";
	echo '<a href="layout.html">Pagina de Inicio</a>'; 
	
		include "logout.php";
	exit();
	}
	else{
		
		$_SESSION['expire'] = time() + (10 * 60);//Hay actividad,volvemos a los 10 minutos de la sesion
	}
} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.php'>Login</a>";
   echo "<br><br><a href='registro.html'>Registrarme</a>";

exit();
}

?>