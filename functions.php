<?php

	require_once 'db_config.php';
	include 'checklogin.php';
	include 'log_f.php';
	
	$option=trim($_REQUEST['op']);
	
	if($option=="borrar"){ //Borrar Pregunta

	 $id_borrar=trim($_REQUEST['id']);
	 
	 $sql2="DELETE FROM quiz_questions WHERE id_quiz='$id_borrar'";
	 if(!mysqli_query($conn,$sql2)){
		die('Error borrar' . mysqli_error($conn));
	}
	else{ 
		registrarLog("Borrar pregunta" .$id_borrar);
		echo '<h5> Has borrado la pregunta ' . $id_borrar . ' con exito</h5>';
	}
	}
	else if($option=="complejidad"){//Modificar complejidad
	
	$id_q=trim($_REQUEST['id']);
	$rate=trim($_REQUEST['rate']);
	 
	 $sql2="UPDATE quiz_questions SET rate='$rate' WHERE id_quiz='$id_q'";
	 if(!mysqli_query($conn,$sql2)){
		die('Error actualizar' . mysqli_error($conn));
	}
	else{ 
		echo '<h5> Has actualizado la complejidad de ' . $id_q . ' a ' . $rate . '</h5>';
	}
		
	}
	else if($option=="numeropreguntas"){ //obtener numero de preguntas de usuario y totales
			$user=$_SESSION['user'];
			$sql="SELECT * FROM quiz_questions";
			$sql2="SELECT * FROM quiz_questions WHERE user_email='$user'";
			if($result=mysqli_query($conn,$sql)){
				$numtotal=mysqli_num_rows($result);
			}
			if($result=mysqli_query($conn,$sql2)){
				$numuser=mysqli_num_rows($result);
			}
			echo 'Mis preguntas/Todas las preguntas: [ ' .$numuser . '/' . $numtotal . ' ]';
	}
	else if($option=="insertarPregunta"){ //insertar pregunta en BD y XML
		
	$user_email = $_SESSION['user'];
	$user_quiz = $_REQUEST['question'];
	$user_answer = htmlspecialchars($_REQUEST['answer']);
	$user_rate = $_REQUEST['selectrate'];
	$user_subject=$_REQUEST['subject'];
	if((strlen($user_quiz)<1) || (strlen($user_answer)<1) || (strlen($user_subject)<1))
		die('Rellena todos los campos');
	
	$time=date("Y-m-d H:i:s");
	$sql="INSERT INTO quiz_questions VALUES(0,'$user_email','$user_quiz','$user_answer','$user_rate','$time','$user_subject')";

	if(!mysqli_query($conn,$sql)){
			die('Error' . mysqli_error($conn));

	}
	else{ 
		//Insercion en preguntas.xml
		if (file_exists('preguntas.xml')) {
		$preguntas=simplexml_load_file("preguntas.xml");
		//<assessmentItem>
		$pregunta = $preguntas->addChild('assessmentItem','');
			$pregunta->addAttribute('complexity',$user_rate);
			$pregunta->addAttribute('subject',$user_subject);
				//<itemBody>
				$item=$pregunta->addChild('itemBody');
					$item->addChild('p');
					$item->p=$user_quiz;
				//<correctResponse>
				$answer=$pregunta->addChild('correctResponse');
					$answer->addChild('value');
					$answer->value=$user_answer;
		$preguntas->asXML('preguntas.xml');
		}
		else{
			echo 'Error insertando en XML, Fichero no encontrado';
		}

		registrarLog("ver preguntas");
		echo '<h4>Pregunta registrada con Exito</h4>';
		
	}
	}
	 
	mysqli_close($conn);




?>