# LosApuntes

Está aplicación sirve para hacer intercambio de apuntes escolares


- el nombre de la session debe estar relacionado a la variable de entorno PROJECT NAME
- img debe pasar a estar en static
- validar que existan las variables por defecto en el motor de plantillas
- en Estaciones.php falto colocar protecciones en los métodos para que retornen mensajes de error en caso de que no haya datos.
- en la api colocar una protección para que la clase Mailer.php no pueda ser utilizada.
- en User.php dentro de register hacer que use el motor de plantillas para levantar el email.