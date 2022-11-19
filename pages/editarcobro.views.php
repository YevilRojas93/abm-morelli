		<section class="container border border-4 border-success  px-0 rounded-3 bg-light " id="section-cargar-cobros">
			<h1 class="bg-success text-center px-0">editar cobros</h1>
			<?php 
				require_once("php/conexion.php"); 
				$sql = Conexion::conectar()->prepare("SELECT * FROM cobros WHERE idCobro = :idCobro");
				$sql->bindParam(":idCobro",$_GET['id'],PDO::PARAM_INT);
				$sql->execute();
				$cobro = $sql->fetch();
			 ?>
			<form class="px-5 pt-2" id="editarcobro" method="post" action="php/cargarcobros.php">
			  	<div class="row justify-content-center">
			  		<div class="mb-3 col-lg-6">
						<label class="fw-bold" for="">Agencia</label>
						<select name="idAgencia" id="idAgencia" class="form-control bg-abm-1">
							<option value="-1">Seleccionar agencia</option>
							<?php 
								require_once("php/conexion.php"); 
								$sql = Conexion::conectar()->prepare("SELECT * FROM agencias");
								$sql->execute();
								$lista_agencia = $sql->fetchAll();
								foreach ($lista_agencia as $key => $value) {
									if ($value["idAgencia"] == $cobro["idAgencia"]) {
										echo "<option value='".$value["idAgencia"]."' selected>".$value["agencia_id"]."-".$value["nombre_agencia"]."</option>";
									}
									else{
										echo "<option value='".$value["idAgencia"]."'>".$value["agencia_id"]."-".$value["nombre_agencia"]."</option>";
									}
								}
							?>
						</select>
						<p class="text-danger error-message">Debes seleccionar una agencia.</p>

					</div>
					<div class="mb-3 col-lg-6">
						<label class="fw-bold" for="">Medio de pago</label>
						<select name="tipo_pago" id="tipo_pago" class="form-select w-100 bg-abm-1">
						    <option value="-1">Selecionar medio de pago</option>
						    <option value="transferencia" <?php if($cobro["tipo_pago"] == "transferencia"){ echo "selected";} ?>>Transferencia</option>
						    <option value="efectivo" <?php if($cobro["tipo_pago"] == "efectivo"){ echo "selected";} ?>>Efectivo</option>
						    <option value="cheque" <?php if($cobro["tipo_pago"] == "cheque"){ echo "selected";} ?>>Cheque </option>
					  	</select>
						<p class="text-danger error-message">Debes seleccionar un medio de pago.</p>
					</div>
				</div>
			 	<div class="row justify-content-center">
					<div class="mb-3 col-lg-6">
						<label class="fw-bold" for="">Fecha de cobro</label>
					    <input type="date" id="fecha_cobro" name="fecha_cobro" value="<?= $cobro["fecha_cobro"]?>" class="form-control bg-abm-1" placeholder="Fecha de Cobro">
					</div>
					<div class="mb-3 col-lg-6">
						<label class="fw-bold" for="">Monto</label>
					  	<input type="number" id="monto" name="monto" value="<?= $cobro["monto"] ?>" class="form-control bg-abm-1" placeholder="Monto a pagar">
					  	<p class="text-danger error-message">El monto debe ser mayor a 0 y numerico.</p>
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
			<script>
			let checked = false;
			document.querySelector("#editarcobro").addEventListener("submit",function(event){
				if (checked == false) {
					event.preventDefault();
					checked = true;
					let idAgencia = document.querySelector("#idAgencia");
					if(idAgencia.value == -1){
						idAgencia.nextElementSibling.classList.add("active")
						checked = false;
					}
					let monto = document.querySelector("#monto");
					let regex = /([0-9])+/;
					if (regex.test(monto.value) == false || monto.value < 1) {
						monto.nextElementSibling.classList.add("active")
						checked = false;
					}
					let tipo_pago = document.querySelector("#tipo_pago");
					if(tipo_pago.value == -1){
						tipo_pago.nextElementSibling.classList.add("active")
						checked = false;
					}
					if (checked == true) {
						event.submit();
					}
				}
			});
		</script>
		</section>
	</body>
</html>