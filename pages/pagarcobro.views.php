<?php 
if (isset($_GET["id"]) AND $_GET["id"] > 0 AND $_SESSION['tipo'] == "agenciero") {
	require_once("php/conexion.php");
	$sql = Conexion::conectar()->prepare("UPDATE cobros SET status = 'pagado' WHERE idCobro = :idCobro");
	$sql->bindParam(":idCobro",$_GET["id"],PDO::PARAM_INT);
	$sql->execute();
	header("location:/listadocobros/pagado");
}
else{
	header("location:/listadocobros");
}
?>
