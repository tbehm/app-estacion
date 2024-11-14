<?php

	/* index.php funciona como un router, redirecciona al controlador especificado en slug */

	// se inicia o se continua con la sesion
	session_start();

	/*< se incluyen las variables de entorno*/
	include_once 'env.php';

	/*< se incluyen las librerias para el envio de correo electrónico*/
	
	// Se incluyen los modelos que se van a usar
	// include_once 'models/User.php';

	// Carga del motor de plantillas en todos los controladores
	include_once 'lib/Tini/Tini.php';

	// por defecto se presenta landing
	$seccion = "landing";

	// Si slug tiene valor
	if(strlen($_GET['slug'])>0){
		$seccion = $_GET['slug'];	
	}

	// Se comprueba que exista el controlador
	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		// No existe el controlador entonces lo llevamos al controlador de error
		$seccion = "error404";
	}

	// Se carga el controlador especificado en seccion
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>