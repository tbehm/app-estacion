<?php 

	// Incluimos los modelos especificos para obtener datos
	include_once 'models/Notes.php';

	// crea el objeto de usuario
	$usuario = new User();

	// carga la vista
	$tpl = new Tini("landing");

	// Variables a reemplazar en la vista
	$vars = ["CANT_USUARIOS" => $usuario->getCantUser(), 
				"CANT_APUNTES" => getCantNotes()];

	// reemplaza variables en la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();

 ?>