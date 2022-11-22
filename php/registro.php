<?php 
	session_start();
	require_once("conexion.php");
	if (isset($_POST)) {
		//var_dump($_POST);
		$error = "";
		unset($_SESSION['registro_error']);
		$_SESSION['registro_error']["email"] = $_POST["email"];
		$_SESSION['registro_error']["nombre_completo"] = $_POST["nombre_completo"];
		$_SESSION['registro_error']["tipo"] = $_POST["tipo"];

		if (strlen($_POST["password1"]) < 4) {
			$error .= "_password";
		}
		if ($_POST["password1"] != $_POST['password2']) {
			$error .= "_pass2";
		}
		if (strlen($_POST["email"]) < 4) {
			$error .= "_email";
			unset($_SESSION['registro_error']["email"]);
		}
		if (strlen($_POST["nombre_completo"]) < 3) {
			$error .= "_nombre";
			unset($_SESSION['registro_error']["nombre_completo"]);
		}
		if ($_POST["tipo"] == "") {
			$error .= "_tipo";
			unset($_SESSION['registro_error']["tipo"]);
		}

		//CONEXION PDO
		//A la DB : Conseguime un usuario que tenga el email y la password que ingreso en el formulario.
		if ($error == "") {
			unset($_SESSION['registro_error']);
			$sql = Conexion::conectar()->prepare("INSERT INTO usuarios (nombre_completo,password,email,tipo) VALUES(:nombre_completo,:password,:email,:tipo)");
			$sql->bindParam(":email",$_POST["email"],PDO::PARAM_STR);
			$sql->bindParam(":nombre_completo",$_POST["nombre_completo"],PDO::PARAM_STR);
			$sql->bindParam(":password",$_POST["password1"],PDO::PARAM_STR);
			$sql->bindParam(":tipo",$_POST["tipo"],PDO::PARAM_STR);
			if ($sql->execute()) {
				header("location:/listadousuarios/success_crear_usuario");
			}
		}
		else{

			header("location:/registro/".$error);
		}
	}
 ?>