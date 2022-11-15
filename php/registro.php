<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		//var_dump($_POST);
		if ($_POST["password1"] != $_POST['password2']) {
			header("location:/registro/error_password");
		}

		session_start();
		//CONEXION PDO
		//A la DB : Conseguime un usuario que tenga el email y la password que ingreso en el formulario.
		$sql = Conexion::conectar()->prepare("INSERT INTO usuarios (idAgencia,nombre_completo,password,email,tipo) VALUES(:idAgencia,:nombre_completo,:password,:email,:tipo)");
		$sql->bindParam(":idAgencia",$_POST["idAgencia"],PDO::PARAM_STR);
		$sql->bindParam(":email",$_POST["email"],PDO::PARAM_STR);
		$sql->bindParam(":nombre_completo",$_POST["nombre_completo"],PDO::PARAM_STR);
		$sql->bindParam(":password",$_POST["password1"],PDO::PARAM_STR);
		$sql->bindParam(":tipo",$_POST["tipo"],PDO::PARAM_STR);
		if ($sql->execute()) {
			header("location:/listadousuarios/success");
		}
		else{
			header("location:/registro/error");
		}
	}
 ?>