<?php 
	
	include_once 'DBAbstract.php';

	/**
	 * 
	 * Clase para conectar con la tabla de Usuarios
	 * 
	 * */
	class User extends DBAbstract{

		public $nombre;
		public $email;
		private $id;

		/**
		 * 
		 * Constructor de la clase, ejecuta el constructor de DBAbstract
		 * 
		 * */
		function __construct(){
			parent::__construct();
		}

		/**
		 * 
		 * loguea un usuario a la aplicacion
		 * 
		 * @param array $form_login arreglo asociativo con txt_email y txt_pass
		 * @return array arreglo asociativo error y errno
		 * 
		 * */
		function login($form_login){

			$email = $form_login["txt_email"];
			$pass = md5($form_login["txt_pass"]);

			$response = $this->consultar("SELECT * FROM losapuntes__usuarios WHERE email='$email'");

			// no encontre el email
			if(count($response)==0){
				return ["error" => "Usuario no registrado", "errno" => 404];
			}

			if($response[0]["pass"]==$pass){
				$this->id = $response[0]["id"];
				$this->nombre = $response[0]["nombre"];
				$this->email = $email;
				
				$_SESSION['losapuntes']['usuario'] = $this;


				return ["error" => "", "errno" => 200];
			}

			return ["error" => "Contraseña invalida", "errno" => 405];
		}

		/**
		 * 
		 * Registra un nuevo usuario en la tabla de usuarios
		 * 
		 * @param array $form arreglo asociativo con datos de usuario
		 * @return array arreglo con los valores de error
		 * 
		 * */
		function register($form){
			$email = $form["txt_email"];
			$pass = md5($form["txt_pass"]);

			$response = $this->consultar("SELECT * FROM losapuntes__usuarios WHERE email='$email'");

			var_dump($response);

			// no encontre el email entonces puedo registrarme
			if(count($response)==0){

				$this->consultar("INSERT INTO losapuntes__usuarios (email, pass) VALUES ('$email', '$pass')");

				return ["error" => "Usuario registrado correctamente", "errno" => 200];
			}

			return ["error" => "Usuario ya registrado", "errno" => 201];
		}

		/**
		 * 
		 * Retorna el id del usuario
		 * 
		 * @return int id del usuario
		 * 
		 * */
		function getId(){
			return $this->id;
		}


		/**
		 * 
		 * Desloguea al usuario
		 * 
		 * */
		function logout(){

			session_unset();
			session_destroy();

		}

		/**
		 * 
		 * Retorna la cantidad de usuarios
		 * 
		 * @return int cantidad de usuarios
		 * 
		 * */
		function getCantUser(){

			$response = $this->consultar("SELECT * FROM losapuntes__usuarios");

			return $this->db->affected_rows;

		}

		/**
		 * 
		 * Retorna todos datos de un usuario por medio de su id
		 * 
		 * @param int $id id de usuario
		 * @return array datos del usuario
		 * 
		 * */
		function getById($id){
			$response = $this->consultar("SELECT * FROM losapuntes__usuarios WHERE id='$id'");

			return $response;
		}
	}

 ?>






