<?php 
	require_once("conexion.php");
	if (isset($_POST)){
		if ($_POST["password1"] != $_POST['password2']){
			header("location:/primera_vez/error");
		}
		elseif (preg_match("^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$^", $_POST["password1"]) != 1){
			header("location:/primera_vez/error_reg");
		}
		else{
			$sql = Conexion::conectar()->prepare("UPDATE usuarios SET password = :password ,primera_vez = 1 WHERE idUsuario = :idUsuario");
			$sql->bindParam(":password",$_POST["password1"],PDO::PARAM_STR);
			$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
			if ($sql->execute()) {
				$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE idUsuario = :idUsuario");
				$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
				$sql->execute();
				$respuesta = $sql->fetch();

				$_SESSION['idUsuario'] = $respuesta["idUsuario"];
				$_SESSION['nombre_completo'] = $respuesta["nombre_completo"];
				$_SESSION['tipo'] = $respuesta["tipo"];
				$_SESSION['idAgencia'] = $respuesta["idAgencia"];
				header("location:/home");
			}
		}
	}
 ?>