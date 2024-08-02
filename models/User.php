<?php 
	
	include_once 'DBAbstract.php';

	/**
	 * 
	 * Clase para conectar con la tabla de Usuarios
	 * 
	 * */
	class User extends DBAbstract{

		public $attributes = array();

		/**
		 * 
		 * Constructor de la clase, ejecuta el constructor de DBAbstract
		 * 
		 * */
		function __construct(){
			parent::__construct();

			$result = $this->consultar('DESCRIBE `losapuntes__usuarios`; ');

			foreach ($result as $key => $value) {

				// guarda el nombre de la columna en una variable
				$attrib = $value['Field']; 

				// Guarda los nombres de las columnas en un vector
				$this->attributes[] = $attrib;

				// crea el atributo con el nombre de la columna
				$this->$attrib = "";
			}
		}

		/**
		 * 
		 * Actualiza los datos del usuario
		 * @param array $form arreglo asociativo con los datos actualizar
		 * @return array arreglo de errores
		 * 
		 * */
		function update($form){
			$this->nombre = $form["txt_nombre"];
			$this->apellido = $form["txt_apellido"];

			$sql = "UPDATE losapuntes__usuarios SET nombre = '{$this->nombre}', apellido = '{$this->apellido}' WHERE email='{$this->email}'";


			$this->consultar($sql);

			return ["error" => "Actualizacion exitosa", "errno" => 200];
		}

		/**
		 * 
		 * loguea un usuario a la aplicacion si existe y esta activo
		 * 
		 * @param array $form_login arreglo asociativo con txt_email y txt_pass
		 * @return array arreglo asociativo error y errno
		 * 
		 * */
		function login($form_login){

			$email = $form_login["txt_email"];
			// cifra la contraseña
			$pass = md5($form_login["txt_pass"]);

			$response = $this->consultar("SELECT * FROM losapuntes__usuarios WHERE email='$email' AND delete_at = '0000-00-00 00:00:00'");

			// no encontre el email
			if(count($response)==0){
				return ["error" => "Usuario no registrado", "errno" => 404];
			}

			// si la contraseña es correcta
			if($response[0]["pass"]==$pass){

				// autocarga de valores en los atributos
				foreach ($this->attributes as $key => $atribute) {
					// menos la contraseña
					if($attribute!="pass"){
						$this->$atribute = $response[0][$atribute];
					}
				}

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

			//var_dump($response);

			// no encontre el email entonces puedo registrarme
			if(count($response)==0){


				$avatar = "https://robohash.org/".$email.".png?set=set4";

				$this->consultar("INSERT INTO losapuntes__usuarios (email, pass, avatar) VALUES ('$email', '$pass', '$avatar')");

				return ["error" => "Usuario registrado correctamente", "errno" => 200];
			}else{ // Se encontro el email

				// Si el usuario es uno que abandono la app
				if($response[0]["delete_at"]!="0000-00-00 00:00:00"){

					$id = $response[0]["id"];

					$sql = "UPDATE losapuntes__usuarios SET delete_at = '0000-00-00 00:00:00' WHERE id=$id";

					//var_dump($sql);

					$this->consultar($sql);

					return ["error" => "Usuario que abandono y volvio", "errno" => 202];

				}else{ // el usuario solo esta registrado

					return ["error" => "Usuario ya registrado", "errno" => 201];
				}
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
		 * Soft Delete del usuario en la tabla de usuarios
		 * @return bool true
		 * 
		 * */
		function leaveOut(){

			$fecha_hora = date("Y-m-d h:i:s");
			$id = $this->id;

			$sql = "UPDATE losapuntes__usuarios SET nombre= '', apellido = '', delete_at = '$fecha_hora' WHERE id=$id";

			$this->consultar($sql);

			$this->logout();

			return true;
		}

		/**
		 * 
		 * Retorna la cantidad de usuarios
		 * 
		 * @return int cantidad de usuarios
		 * 
		 * */
		function getCantUser(){

			$response = $this->consultar("SELECT * FROM losapuntes__usuarios WHERE delete_at = '0000-00-00 00:00:00'");

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






