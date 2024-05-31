<?php 

	// Incluimos los modelos especificos para obtener datos
	include_once 'models/Users.php';
	include_once 'models/Notes.php';

	// Carga la vista
	$tpl = loadTPL("landing");

	// Variables a reemplazar en la vista
	$vars = ["CANT_USUARIOS" => getCantUsers(), 
				"CANT_APUNTES" => getCantNotes()];


	// reemplazamos las variables en la vista
	$tpl = setVarsTPL($vars ,$tpl);
	
	// imprime la vista
 	printTPL($tpl);

 ?>