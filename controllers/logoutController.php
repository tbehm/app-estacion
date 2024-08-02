<?php 

	// Ejecuta el metodo logout del objeto user
	$_SESSION['losapuntes']["usuario"]->logout();

	// Redirecciona a la landing page
	header("Location: landing");
 ?>