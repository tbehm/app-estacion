<?php 

	// pasa el usuario de sesion a una variable
	$usuario = $_SESSION['losapuntes']["usuario"];

	// variables a reemplazar dentro de la vista
	$vars = ["MSG_ERROR_FORM" => "", "USER_NAME" => $usuario->email];

	// carga la vista
	$tpl = new Tini("perfil");

	// cambia las variables de la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();


 ?>