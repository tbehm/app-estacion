<?php 

	// error : explicacion del error
	// errno : numero del error 

	/**
	 * 
	 * 
	 * Motor de plantillas para cargar vistas
	 * 
	 * 
	 * */
	class Tini{

		public $buffer;
		private $vista;
		private $error;
		private $errno;

		/**
		 * 
		 * Carga la plantilla o vista en memoria
		 * @param string $name nombre de la vista
		 * 
		 * */
		function __construct($name){
			
			$this->vista = $name;
			
			if(!file_exists("views/".$this->vista."View.html")){
				echo "Fallo al cargar la vista <b>".$this->vista."</b> El archivo no exista";
				
				$this->error = "No se encontro la vista ".$this->vista;
				$this->errno = 404;

			}

			$this->buffer = file_get_contents("views/".$this->vista."View.html");

			$this->error = "";
			$this->errno = 200;

		}


		/**
		 * 
		 * Reemplaza las variables dentro de la plantilla
		 * @param array $vars es un arreglo indexado de forma asociativa, el index es la variable
		 * 
		 * */
		function setVars($vars){
			foreach ($vars as $key => $value) {
				if($this->testVar($key)){
					$this->buffer = str_replace("{{".$key."}}", $value, $this->buffer);
				}else{
					echo "La variable de plantilla <b>".$key."</b> no existe";
					exit();
				}
			}

		}

		/**
		 * 
		 * Verifica si existe la variable
		 * @param string $name nombre de la variable
		 * @return bool existe| no existe la variable
		 * 
		 * */
		private function testVar($name){
			return strpos($this->buffer, $name);
		}

		/**
		 * 
		 * Imprime la plantilla o vista en la página
		 * @return bool verdadero si imprimio
		 * 
		 * */
		function print(){
			echo $this->buffer;
			return true;
		}

		/**
		 * 
		 * Altera el valor de vista
		 * @param string $value nuevo valor de vista
		 * 
		 * */
		function setVista($value){
			$this->vista = $value;
		}

		/**
		 * 
		 * Retorna el valor de vista
		 * @return string valor de vista
		 * 
		 * */
		function getVista(){
			return $this->vista;
		}

	}
	

 ?>