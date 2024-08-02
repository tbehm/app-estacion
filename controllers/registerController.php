<?php

	// variables para reemplazar en la plantilla
	$vars = ["MSG_ERROR_FORM" => ""];

	// Se presiono el boton de ingresar
	if(isset($_POST['btn_registrar'])){

		// Instancio la clase User
		$usuario = new User();

		// pasamos todo de post a formulario
		$formulario = $_POST;

		// le quitamos al formulario el boton
		unset($formulario["btn_registrar"]);

		// intentamos registrarnos al usuario
		$response = $usuario->register($formulario);

		// registro valido o usuario que abandono y volvio
		if($response["errno"]==200 || $response["errno"]==202){

			$usuario->login($formulario);

			// redirecciona al panel
			header("Location: perfil");
		}

		// en caso de que el correo ya este registrado
		$vars = ["MSG_ERROR_FORM" => $response["error"]];
	}
	
	// instanciamos el objeto tini y cargamos la vista login
	$tpl = new Tini("register");

	// reemplazamos las variables en la plantilla
	$tpl->setVars($vars);

	// imprime la plantilla
	$tpl->print();

 ?>