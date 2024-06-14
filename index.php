<?php 

	// Se incluyen los modelos que se van a usar
	include_once 'models/User.php';

	// se inicia o se continua con la sesion
	session_start();

	/* index.php funciona como un router, redirecciona al controlador especificado en slug */

	// Carga del motor de plantillas en todos los controladores
	include_once 'lib/Tini/Tini.php';

	// por defecto se presenta landing
	$seccion = "landing";

	// Si existe slug se cambia la sección a la solicitada
	if(isset($_GET['slug'])){
		$seccion = $_GET['slug'];	
	}

	// Se comprueba que exista el controlador
	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		// No existe el controlador entonces lo llevamos al controlador de error
		$seccion = "error404";
	}

	// si esta logueado controladores permitidos
	$controller_user_connected = ["panel", "perfil", "logout"];
	// no esta logueado controladores permitidos
	$controller_user_anonymous = ["landing", "login", "register"];

	// Si la sesion esta iniciada
	if(isset($_SESSION["losapuntes"]['usuario'])){
		// los controladores de anonimo no estan permitidos
		$controller_test = $controller_user_anonymous;
		// por defecto se lleva a panel
		$default_seccion = "panel";
	}else{ // sesión no iniciada
		// los controladores de conectado no estan permitidos
		$controller_test = $controller_user_connected;
		// por defecto se lleva a landing
		$default_seccion = "landing";
	}

	// Se analiza cuales controladores estan permitidos
	foreach ($controller_test as $key => $value) {
		// si coincide con un controlador que no deberia solicitar 
	 	if($value == $seccion){
	 		// se manda al controlador por defecto
	 		$seccion = $default_seccion;
	 		break;
	 	}
	}

	
	// Se carga el controlador especificado en seccion
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>