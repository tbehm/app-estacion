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
			
			/*< guarda el nombre de la vista*/
			$this->vista = $name;
			
			/*< valida que exista la vista*/
			if(!file_exists("views/".$this->vista."View.html")){
				echo "Fallo al cargar la vista <b>".$this->vista."</b> El archivo no exista";
				
				$this->error = "No se encontro la vista ".$this->vista;
				$this->errno = 404;

			}

			/*< carga la vista en buffer*/
			$this->buffer = file_get_contents("views/".$this->vista."View.html");

			$this->error = "";
			$this->errno = 200;

			/*< se carga los archivos externos*/
			$this->loadExtern();

			/*< variables a reemplazar por defecto en la vista*/
			$env_vars = [
				"PROJECT_NAME" => $_ENV['PROJECT_NAME'],
				"PROJECT_DESCRIPTION" => $_ENV['PROJECT_DESCRIPTION'],
				"PROJECT_AUTHOR" => $_ENV['PROJECT_AUTHOR'],
				"PROJECT_AUTHOR_CONTACT" => $_ENV['PROJECT_AUTHOR_CONTACT'],
				"PROJECT_URL" => $_ENV['PROJECT_URL'],
				"PROJECT_KEYWORDS" => $_ENV['PROJECT_KEYWORDS'],
				"PROJECT_MODE" => $_ENV['PROJECT_MODE'],
			];

			/*< reemplaza las variables en la vista*/
			$this->setVars($env_vars);

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
		 * Busca los @extern('z') y los reemplaza por el contenido del archivo con el nombre encerrado entre comillas
		 * @brief busca y reemplaza los @extern con el archivo correspondiente 
		 * 
		 * */
		private function loadExtern(){

			// REGEX para buscar el patron de un extern
			$pattern = "/@extern\(['\"]([a-zA-Z0-9_]+)['\"]\)/";

			/*< busca todos las coincidencias con el patrón*/
			preg_match_all($pattern, $this->buffer, $externs);

			/*< recorre todas las coincidencias*/
			foreach ($externs[0] as $key => $extern) {
				
				/*< nos quedamos con el nombre encerrado entre comillas*/
				$name_of_extern = $externs[1][$key];

				/*< valida que exista el archivo externo*/
				if(!file_exists("views/".$name_of_extern.".html")){
					echo "Archivo de extern no encontrado. <b>".$name_of_extern."</b>";
					exit();
				}

				/*< carga en memoria el contenido del archivo externo*/
				$extern_buffer = file_get_contents("views/".$name_of_extern.".html");
		
				/*< reemplaza en la vista el @extern encontrado con el contenido del archivo*/
				$this->buffer = str_replace($extern, $extern_buffer, $this->buffer);
			}

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