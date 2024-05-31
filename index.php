<?php 

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
	
	// Se carga el controlador especificado en seccion
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>