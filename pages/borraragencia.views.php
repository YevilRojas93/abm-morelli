<?php 
	if ($_SESSION["tipo"] == "administrador") {
		require_once("php/conexion.php");
		if (isset($_GET["id"]) AND $_GET["id"] > 0) {
			$id = htmlentities($_GET["id"],ENT_COMPAT,"UTF-8");
			$sql = Conexion::conectar()->prepare("DELETE FROM agencias WHERE idAgencia = :id");
			$sql->bindParam("id",$id,PDO::PARAM_INT);
			$sql->execute();
			header("location:/listadoagencia/success");
		}
		else{
			header("location:/listadoagencia/error");
		}
	}
 ?>