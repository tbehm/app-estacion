<?php 

	/**
	 * 
	 * Retorna un string que contiene la vista
	 * @param string $vista nombre de la vista
	 * @return string vista para modificar o imprimir
	 * 
	 * */
	function loadTPL($vista){
		$f_view = fopen("views/".$vista."View.html", "r");

		$buffer = "";

		while(!feof($f_view)){
			$buffer .= fgets($f_view);
		}

		return $buffer;
	}

	/**
	 * 
	 * Retorna la vista con las variables reemplazadas
	 * @param array $vars indexado de forma asociativa
	 * @param string $tpl vista para ser modificada
	 * @return string vista para ser impresa
	 * 
	 * */
	function setVarsTPL($vars ,$tpl){

		foreach ($vars as $key => $value) {
			$tpl = str_replace("{{".$key."}}", $value, $tpl);
		}

		return $tpl;
	}

	/**
	 * 
	 * Imprime en la vista en la página
	 * @param string $tpl vista para ser impresa
	 * 
	 * */
	function printTPL($tpl){
		echo $tpl;
	}

 ?>