<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		$error = "";
		if ($_POST["agencia_id"] < 4) {
			$error .= "_agenciaid";
		}
		if (strlen($_POST["nombre_agencia"]) < 5) {
			$error .= "_nombre";
		}
		if (strlen($_POST["direccion"]) < 3) {
			$error .= "_direccion";
		}
		if (strlen($_POST["localidad"]) < 3) {
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

			}
			else{
				$sql = Conexion::conectar()->prepare("INSERT INTO agencias (agencia_id,idUsuario,nombre_agencia,direccion,localidad,telefono) VALUES(:agencia_id,:idUsuario,:nombre_agencia,:direccion,:localidad,:telefono)");
			}
			$sql->bindParam(":idUsuario",$_POST["idUsuario"],PDO::PARAM_INT);
			$sql->bindParam(":agencia_id",$_POST["agencia_id"],PDO::PARAM_INT);
			$sql->bindParam(":nombre_agencia",$_POST["nombre_agencia"],PDO::PARAM_STR);
			$sql->bindParam(":direccion",$_POST["direccion"],PDO::PARAM_STR);
			$sql->bindParam(":localidad",$_POST["localidad"],PDO::PARAM_STR);
			$sql->bindParam(":telefono",$_POST["telefono"],PDO::PARAM_STR);
			if ($sql->execute()) {
				header("location:/home/success_agencia");
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