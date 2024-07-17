<?php 

	// Credenciales para acceder a la base de datos,
	// No se debe colocar aquí, pero se puso de forma
	// provisoria hasta que se cree .env
	define("HOST","localhost");
	define("USER","losapuntes");
	define("PASS","losapuntes1234");
	define("DB","losapuntes");

	// Desactiva el reporte de errores de mysqli
	mysqli_report(MYSQLI_REPORT_OFF);
	
	/**
	 * 
	 * Clase para la conexión con la base de datos
	 * 
	 * */
	class DBAbstract{

		public $db;

		/**
		 * 
		 * Conecta contra la base de datos usando las credenciales
		 * 
		 * */
		function __construct(){
			
			$this->conectar();

		}

		/**
		 * 
		 * Conecta con la base de datos
		 * 
		 * */
		function conectar(){
			$this->db = @new mysqli(HOST, USER, PASS, DB);	
		
			if($this->db->connect_errno){
				echo "Hubo un error en la conexión: (".$this->db->connect_errno.") ".$this->db->connect_error;

				exit();
			}
		}

		/**
		 * 
		 * realiza una consulta a la base de datos tipo DML
		 * 
		 * @param string $sql consulta en formato SQL
		 * @return array|bool lista indexada de forma asociativa (SELECT)|true (INSERT,UPDATE,DELETE)
		 * 
		 * */
		function consultar($sql){

			$this->conectar();
			
			$response = $this->db->query($sql);

			if($this->db->errno){
				echo "Error de consulta: ".$this->db->error;
				exit();
			}
			
			// obtiene la primer palabra de la query
			$first_word = strstr($sql, " ", true);	

			switch ($first_word) {
				case 'DESCRIBE':
				case 'SELECT':

					return $response->fetch_all(MYSQLI_ASSOC);
					break;
				
				default:
					return true;
					break;
			}
		}

	}



 ?>