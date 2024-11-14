<?php 

	// Incluimos los modelos especificos para obtener datos
	// carga la vista
	include_once 'lib/Tini/Tini.php';

	$tpl = new Tini("detalle");

	// imprime la vista en la página
	$tpl->print();

 ?>