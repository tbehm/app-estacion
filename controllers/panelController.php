<?php 
	
	// se pasa lo que esta en el objeto usuario de la sesion a una variable
	$usuario = $_SESSION['losapuntes']["usuario"];

	// variables a reemplazar dentro de la vista
	$vars = ["USER_NAME" => $usuario->nombre, "USER_LAST_NAME" => $usuario->apellido];

	// carga la vista
	$tpl = new Tini("panel");

	// reemplaza las variables en la vista
	$tpl->setVars($vars);

	// imprime la vista en pantalla
	$tpl->print();
 ?>