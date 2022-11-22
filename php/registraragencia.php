<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		$error = "";
		if (isset($_POST['edit']) AND $_POST["edit"] == true) {
			$sql = Conexion::conectar()->prepare("SELECT * FROM agencias WHERE agencia_id = :agencia_id AND idAgencia  != :idAgencia");
			$sql->bindParam(":agencia_id",$_POST["agencia_id"],PDO::PARAM_INT);	
			$sql->bindParam(":idAgencia",$_POST["idAgencia"],PDO::PARAM_INT);	
		}
		else{
			$sql = Conexion::conectar()->prepare("SELECT * FROM agencias WHERE agencia_id = :agencia_id");
			$sql->bindParam(":agencia_id",$_POST["agencia_id"],PDO::PARAM_INT);	
		}
		$checkAgencia = $sql->fetchAll();
		if (count($checkAgencia) > 0) {
			$error .= "_repeated";
		}
		if ($_POST["agencia_id"] < 0) {
			$error .= "_agenciaid";
		}
		if (strlen($_POST["nombre_agencia"]) < 5) {
			$error .= "_nombre";
		}
		$checkDireccion = preg_match("/([A-Za-z ]+[ ]+[0-9]+)/", $_POST["direccion"]);
		if ($checkDireccion == 0) {
			$error .= "_direccion";
		}
		$checkLocalidad = preg_match("/^([^0-9]*).{3,}$/", $_POST["localidad"]);
		if ($checkLocalidad == 0) {
			$error .= "_localidad";
		}
		if (strlen($_POST["telefono"]) < 4) {
			$error .= "_telefono";
		}
		if ($error == "") {
			session_start();
			if (isset($_POST['edit']) AND $_POST["edit"] == true) {
				$sql = Conexion::conectar()->prepare("UPDATE agencias set idUsuario = :idUsuario,agencia_id = :agencia_id,nombre_agencia = :nombre_agencia,direccion = :direccion,localidad = :localidad,telefono = :telefono WHERE idAgencia = :old_id");
				$sql->bindParam(":old_id",$_POST["old_id"],PDO::PARAM_INT);
				$url = "success_agencia_edit";
			}
			else{
				$sql = Conexion::conectar()->prepare("INSERT INTO agencias (agencia_id,idUsuario,nombre_agencia,direccion,localidad,telefono) VALUES(:agencia_id,:idUsuario,:nombre_agencia,:direccion,:localidad,:telefono)");
				$url = "success_agencia_create";
			}
			$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
			$sql->bindParam(":agencia_id",$_POST["agencia_id"],PDO::PARAM_INT);
			$sql->bindParam(":nombre_agencia",$_POST["nombre_agencia"],PDO::PARAM_STR);
			$sql->bindParam(":direccion",$_POST["direccion"],PDO::PARAM_STR);
			$sql->bindParam(":localidad",$_POST["localidad"],PDO::PARAM_STR);
			$sql->bindParam(":telefono",$_POST["telefono"],PDO::PARAM_STR);
			if ($sql->execute()) {
				header("location:/home/".$url);
			}
		}
		else{
			if (isset($_POST['edit']) AND $_POST["edit"] == true) {
				header("location:/editaragencia/".$_POST["old_id"]."/".$error);
			}
			else{
				header("location:/registraragencia/".$error);
			}
		}
	}
 ?>