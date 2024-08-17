<?php 
	
	/**
	* @file Apunte.php
	* @brief Declaraciones de la clase Apunte para la conexión con la base de datos.
	* @author Matias Leonardo Baez
	* @date 2024
	* @contact elmattprofe@gmail.com
	*/

	// incluye la libreria para conectar con la db
	include_once 'DBAbstract.php';

	/*< Se crea la clase Apunte que hereda de DBAbstract */
	class Apunte extends DBAbstract{

		public $list=array();

		/**
		 * 
		 * @brief constructor de la clase
		 * Carga apuntes de demostración
		 * 
		 * */
		function __construct(){
			$this->list[] = "Teoria del caos según Baez";

			$this->list[] = "Baez y los frontend developers";
		}

		/**
		 * 
		 * @brief Agrega un apunte a la lista
		 * @param string $nombre nombre del apunte
		 * @return array resultado de agregar
		 * 
		 * */
		function add($nombre){
			$this->list[] = $nombre;

			return ["errno" => 200, "error" => "Se agrego el apunte correctamente"];
		}

		/**
		 * 
		 * @brief Lista de apuntes
		 * @return array lista de apuntes
		 * 
		 * */
		function list(){
			return $this->list;
		}

	}


 ?>