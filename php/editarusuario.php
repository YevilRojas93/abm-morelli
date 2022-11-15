<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		//var_dump($_POST);
		if ($_POST["password1"] != $_POST['password2']) {
			header("location:/editarusuario/error_password");
		}
		session_start();
		if ($_SESSION["tipo"] == "agenciero") {
			$_POST["tipo"] = "agenciero";
		}
		//CONEXION PDO
		//A la DB : Conseguime un usuario que tenga el email y la password que ingreso en el formulario.
		$sql = Conexion::conectar()->prepare("UPDATE usuarios SET email = :email,nombre_completo = :nombre_completo, password = :password, tipo = :tipo, idAgencia = :idAgencia WHERE idUsuario = :idUsuario");
		$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
		$sql->bindParam(":idAgencia",$_POST["idAgencia"],PDO::PARAM_INT);
		$sql->bindParam(":email",$_POST["email"],PDO::PARAM_STR);
		$sql->bindParam(":nombre_completo",$_POST["nombre_completo"],PDO::PARAM_STR);
		$sql->bindParam(":password",$_POST["password1"],PDO::PARAM_STR);
		$sql->bindParam(":tipo",$_POST["tipo"],PDO::PARAM_STR);
		
		if ($sql->execute()) {
			if ($_SESSION['idUsuario'] == $_POST["idUsuario"]) {
				$_SESSION['nombre_completo'] = $_POST["nombre_completo"];
				$_SESSION['tipo'] = $_POST["tipo"];
				$_SESSION['idAgencia'] = $_POST["idAgencia"];
			}
			header("location:/listadousuarios/success_edit");
		}
		else{
			header("location:/editarusuario/".$_POST["idUsuario"]."/error");
		}
	}
 ?>