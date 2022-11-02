<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		//Utilizar las variables de session que guardan los datos del usuario posterior al login.
		session_start();
		//CONEXION PDO
		//A la DB : Conseguime un usuario que tenga el email y la password que ingreso en el formulario.
		$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE email = :email AND password = :password");
		$sql->bindParam(":email",$_POST["email"],PDO::PARAM_STR);
		$sql->bindParam(":password",$_POST["password"],PDO::PARAM_STR);
		$sql->execute();

		$respuesta = $sql->fetch();
		//Si lo que trae $respuesta es distinto a false , significa que existe un usuario osea SE LOGEA BIEN
		if ($respuesta != false) {
			//Los datos del usuario recien logeado
			
			//header redireccion.
			if ($respuesta["primera_vez"] == 0) {
				$v = "/primera_vez/".$respuesta["idUsuario"];
				header("location:".$v);
			}
			else{
				$_SESSION['idUsuario'] = $respuesta["idUsuario"];
				$_SESSION['nombre_completo'] = $respuesta["nombre_completo"];
				$_SESSION['tipo'] = $respuesta["tipo"];
				$_SESSION['idAgencia'] = $respuesta["idAgencia"];
				header("location:/home");
			}
		}
		//Si no trae una fila la $respuesta
		else{
			header("location:/login/error");
		}

		
	}
 ?>