<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		session_start();
		if ($_SESSION["tipo"] == "agenciero") {
			$_POST["tipo"] = "agenciero";
		}
		$error = "";
		if (strlen($_POST["password1"]) < 4) {
			$error .= "_password";
		}
		if ($_POST["password1"] != $_POST['password2']) {
			$error .= "_pass2";
		}
		if (strlen($_POST["email"]) < 4) {
			$error .= "_email";
		}
		if (strlen($_POST["nombre_completo"]) < 3) {
			$error .= "_nombre";
		}
		if ($_POST["tipo"] == "") {
			$error .= "_tipo";
		}
		//CONEXION PDO
		//A la DB : Conseguime un usuario que tenga el email y la password que ingreso en el formulario.
		if ($error == "") {
			$sql = Conexion::conectar()->prepare("UPDATE usuarios SET email = :email,nombre_completo = :nombre_completo, password = :password, tipo = :tipo WHERE idUsuario = :idUsuario");
			$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
			$sql->bindParam(":email",$_POST["email"],PDO::PARAM_STR);
			$sql->bindParam(":nombre_completo",$_POST["nombre_completo"],PDO::PARAM_STR);
			$sql->bindParam(":password",$_POST["password1"],PDO::PARAM_STR);
			$sql->bindParam(":tipo",$_POST["tipo"],PDO::PARAM_STR);
		
			if ($sql->execute()) {
				if ($_SESSION['idUsuario'] == $_POST["idUsuario"]) {
					$_SESSION['nombre_completo'] = $_POST["nombre_completo"];
					$_SESSION['tipo'] = $_POST["tipo"];
					header("location:/home/success_edit_usuario");
				}
				else{
					header("location:/listadousuarios/success_edit");
				}
			}
		}
		else{
			header("location:/editarusuario/".$_POST["idUsuario"]."/".$error);
		}
	}
 ?>