<?php 
	require_once("conexion.php");
	if (isset($_POST)) {
		if (isset($_POST['edit']) AND $_POST["edit"] == true) {
			$sql = Conexion::conectar()->prepare("UPDATE cobros set monto = :monto,idAgencia = :idAgencia,tipo_pago = :tipo_pago,fecha_cobro = :fecha_cobro WHERE idCobro = :old_id");
			$sql->bindParam(":old_id",$_POST["old_id"],PDO::PARAM_INT);
		}
		else{
			$sql = Conexion::conectar()->prepare("INSERT INTO cobros (monto,idAgencia,tipo_pago,fecha_cobro) VALUES(:monto,:idAgencia,:tipo_pago,:fecha_cobro)");
		}
		
		$sql->bindParam(":monto",$_POST["monto"],PDO::PARAM_INT);
		$sql->bindParam(":idAgencia",$_POST["idAgencia"],PDO::PARAM_INT);
		$sql->bindParam(":tipo_pago",$_POST["tipo_pago"],PDO::PARAM_STR);
		$sql->bindParam(":fecha_cobro",$_POST["fecha_cobro"],PDO::PARAM_STR);
		if ($sql->execute()) {
			header("location:/home");
		}
		else{
			header("location:/cargarcobros/error");
		}
	}
 ?>