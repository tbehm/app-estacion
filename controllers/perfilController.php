<?php 

	// pasa el usuario de sesion a una variable
	$usuario = $_SESSION['losapuntes']["usuario"];

	// variables a reemplazar dentro de la vista
	$vars = ["MSG_ERROR_FORM" => "", "USER_LAST_NAME" => $usuario->apellido, "USER_FIRST_NAME" => $usuario->nombre];



	// Se presiono el boton de ingresar
	if(isset($_POST['btn_modificar'])){

		// pasamos todo de post a formulario
		$formulario = $_POST;

		// le quitamos al formulario el boton
		unset($formulario["btn_modificar"]);

		// intentamos registrarnos al usuario
		$response = $usuario->update($formulario);

		// registro valido
		if($response["errno"]==200){
			// redirecciona al panel
			header("Location: ?slug=panel");
		}

		// en caso de que el correo ya este registrado
		$vars = ["MSG_ERROR_FORM" => $response["error"]];
	}


	// carga la vista
	$tpl = new Tini("perfil");

	// cambia las variables de la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();


 ?>