		<section class="container border border-4 border-success  px-0 rounded-3 bg-light " id="section-cargar-cobros">
			<h1 class="bg-success text-center px-0">cargar cobros</h1>
			<?php 
				require_once("php/conexion.php"); 
				$sql = Conexion::conectar()->prepare("SELECT * FROM cobros WHERE idCobro =:idCobro");
				$sql->bindParam(":idCobro",$_GET['id'],PDO::PARAM_INT);
				$sql->execute();
				$cobro = $sql->fetch();
			 ?>
			<form class="px-5 pt-2" method="post" action="php/cargarcobros.php">
				<div class="mb-3 ">
					<select name="idAgencia" class="form-control bg-abm-1">
						<option value="">Seleccionar agencia</option>
						<?php 
							require_once("php/conexion.php"); 
							$sql = Conexion::conectar()->prepare("SELECT * FROM agencias");
							$sql->execute();
							$lista_agencia = $sql->fetchAll();
							foreach ($lista_agencia as $key => $value) {
								if ($value["idAgencia"] == $cobro["idAgencia"]) {
									echo "<option value='".$value["idAgencia"]."' selected>".$value["nombre_agencia"]."</option>";
								}
								else{
									echo "<option value='".$value["idAgencia"]."'>".$value["nombre_agencia"]."</option>";
								}
							}
						?>
					</select>
				</div>
			  	<div class="row justify-content-center">
				  	<div class="mb-3 col-lg-6 d-flex align-items-center">
						<select name="idUsuario" class="form-select w-100 bg-abm-1">
						    <option>Selecionar agenciero</option>
							<?php 
								require_once("php/conexion.php"); 
								$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE tipo = 'agenciero'");
								$sql->execute();
								$lista_agenciero = $sql->fetchAll();
								foreach ($lista_agenciero as $key => $value) {
									if ($value["idUsuario"] == $cobro["idUsuario"]) {
										echo "<option value='".$value["idUsuario"]."' selected>".$value["nombre_completo"]."</option>";
									}
									else{
										echo "<option value='".$value["idUsuario"]."'>".$value["nombre_completo"]."</option>";
									}
									
								}
							?>

					  	</select>
				  	</div>
					<div class="mb-3 col-lg-6">
						<select name="tipo_pago" class="form-select w-100 bg-abm-1">
						    <option>Selecionar medio de pago</option>
						    <option value="transferencia" <?php if($cobro["tipo_pago"] == "transferencia"){ echo "selected";} ?>>Transferencia</option>
						    <option value="efectivo" <?php if($cobro["tipo_pago"] == "efectivo"){ echo "selected";} ?>>Efectivo</option>
						    <option value="cheque" <?php if($cobro["tipo_pago"] == "cheque"){ echo "selected";} ?>>Cheque </option>
					  	</select>
					</div>
				</div>
			 	<div class="row justify-content-center">
					<div class="mb-3 col-lg-6">
					    <input type="text" name="fecha_cobro" value="<?= $value["fecha_cobro"] ?? ""?>" class="form-control bg-abm-1" placeholder="Fecha de Cobro">
					</div>
					<div class="mb-3 col-lg-6">
					  <input type="number" name="monto" value="<?= $value["monto"] ?? "" ?>" class="form-control bg-abm-1" placeholder="Monto a pagar">
					</div>
				</div>
				 <div class="row justify-content-center">
				 	<div class="col-lg-12 pb-4 pt-1">
				  		<button type="submit" class="btn btn-success fw-bold w-100">cargar</button>
				  	</div>
				</div>
				<input type="hidden" name="edit" value="true">
				<input type="hidden" name="old_id" value="<?= $_GET["id"] ?>">
			</form>
		</section>
	</body>
</html>