<section class="container px-0 pt-0 pb-3" id="section-form-registrar">
		<?php 
			require_once("php/conexion.php"); 
			$sql = Conexion::conectar()->prepare("SELECT * FROM agencias WHERE idAgencia =:idAgencia");
			$sql->bindParam(":idAgencia",$_GET['id'],PDO::PARAM_INT);
			$sql->execute();
			$agencia = $sql->fetch();
		 ?>
		<h1 class="text-center text-success pb-2"  >Agregar Agencia</h1>
		<hr class="bg-success" style="opacity: 1;">
		<form class="px-4" method="post" action="php/registraragencia.php">
			<div class="row justify-content-center">
				<div class="mb-2 col-lg-2">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="number" name="agencia_id" value="<?= $agencia["idAgencia"] ?? "" ?>" class="form-control" placeholder="ID agencia">
				</div>	
				<div class="mb-2 col-lg-7">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="text" name="nombre_agencia" value="<?= $agencia["nombre_agencia"] ?? "" ?>" class="form-control" placeholder="Nombre Agencia">
				</div>	
			</div>
			<div class="row justify-content-center">
				<div class="mb-4 col-lg-3">
					<label for="exampleInputPassword1" class="form-label"></label>
					<input type="text" name="direccion" value="<?= $agencia["direccion"] ?? "" ?>" class="form-control" placeholder="Direccion">
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="text" name="localidad" value="<?= $agencia["localidad"] ?? "" ?>" class="form-control" placeholder="Localidad">
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputPassword1" class="form-label"></label>
				    <input type="number" name="telefono" value="<?= $agencia["telefono"] ?? "" ?>" class="form-control" placeholder="Telefono">
				</div>
				<input type="hidden" name="edit" value="true">
				<input type="hidden" name="old_id" value="<?= $_GET["id"] ?>">
			</div>
			<div class="row justify-content-center mb-3">
				<div class="col-lg-9">
				  <button type="submit" class="btn btn-success py-1 fs-5 w-100">Guardar</button>
				</div>
			</div>
		</form>
	</section>
	
</body>
</html>