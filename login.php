<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo 'Hola ' . $_SESSION['user'] . 'Sid= ' . session_id() . '! <br>';
		echo '<a href="verPreguntas.php">Ver preguntas</a><br>';
		echo '<a href="insertarPregunta.php">Registrar una nueva pregunta</a><br>';
		echo '<a href="logout.php">Cerrar Sesion</a>';
		exit();
	}

?>

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
<div class="container">
	<div class="row">
        <div class="col-sm-6">
            <div class="login">
        		<div class="panel panel-default">
                  <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Acceso Usuarios</div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" method="POST">
                             <div class="form-group">
                                <label class="sr-only" for="Uemail">Email address</label>
                                <input type="text" class="form-control" id="Uemail" name= "Uemail" placeholder="Email"  pattern ="([a-zA-Z]{2,})\d{3}@(ikasle\.){0,1}ehu\.(eus|es)" required title="El correo debe tener el formato de la UPV/EHU"">
                              </div>                        
                             <div class="form-group">
                                <label class="sr-only" for="Uemail">Password</label>
                                <input type="password" class="form-control" id="Upassword" name= "Upassword" placeholder="Password" required>
                              </div>
                              <button type="submit" class="btn btn-success">Login</button>
                        </form>                        
                    </div>
                  </div>
                </div>

            </div>
        </div>
	</div>
</body>


<?php
require_once 'db_config.php';

if(isset($_REQUEST['Uemail'])){
	
//Recibimos las dos variables
$usuario=mysqli_real_escape_string($conn,$_REQUEST["Uemail"]);
$password=mysqli_real_escape_string($conn,sha1($_REQUEST["Upassword"]));

$users = mysqli_query($conn,"SELECT * FROM users WHERE email = '$usuario' AND password = '$password'");


if(mysqli_num_rows($users) > 0) 
{

    session_start();
	session_regenerate_id();
	
		$_SESSION['user']="$usuario";
	    $_SESSION['loggedin'] = true;
		$row = mysqli_fetch_array( $users);
	    $_SESSION['rol'] = $row['role'];
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);//minutos
		$_SESSION['sid']=session_id();
		echo "Bienvenido! " . $_SESSION['user'];
		
		//log login connection
		$time=date("Y-m-d H:i:s");
		$sid=session_id();
		$sql="INSERT into connections VALUES('$sid','$usuario','$time')";
		if(!mysqli_query($conn,$sql)){
		die('Error' . mysqli_error($conn));
		}
		
		mysqli_close($conn); 
		header("Location: GestionPreguntas.php");
 
    exit(); 
}
 
else 
{

   $mensajeaccesoincorrecto = "El usuario o la contraseña son incorrectos, por favor vuelva a introducirlos.<br>";
   echo $mensajeaccesoincorrecto . '<a href="registro.html">Registrate</a><br>'; 
   echo '<a href="layout.html">Vuelve a la pagina principal</a>'; 
}

mysqli_close($conn); 
}


		
?>
