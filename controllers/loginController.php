<?php

	// variables para reemplazar en la plantilla
	$vars = ["MSG_ERROR_FORM" => ""];

	// Se presiono el boton de ingresar
	if(isset($_POST['btn_ingresar'])){

		// Instancio la clase User
		$usuario = new User();

		// pasamos todo de post a formulario
		$formulario = $_POST;

		// le quitamos al formulario el boton
		unset($formulario["btn_ingresar"]);

		// intentamos loguear al usuario
		$response = $usuario->login($formulario);

		// logueo valido
		if($response["errno"]==200){
			// redirecciona al panel
			header("Location: panel");
		}

		// en caso de que contraseña o usuario invalido
		$vars = ["MSG_ERROR_FORM" => $response["error"]];
	}
	
	// instanciamos el objeto tini y cargamos la vista login
	$tpl = new Tini("login");

	// reemplazamos las variables en la plantilla
	$tpl->setVars($vars);

	// imprime la plantilla
	$tpl->print();

 ?>