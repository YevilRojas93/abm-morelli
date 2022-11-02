		<section class="container border border-4 border-success  px-0 rounded-3 bg-light " id="section-cargar-cobros">
			<h1 class="bg-success text-center px-0">cargar cobros</h1>
			<form class="px-5 pt-2" method="post" action="php/cargarcobros.php">
				
			  	<div class="row justify-content-center">
				  	<div class="mb-3 col-lg-6">
						<select name="idAgencia" class="form-control bg-abm-1">
							<option value="">Seleccionar agencia</option>
							<?php 
								require_once("php/conexion.php"); 
								$sql = Conexion::conectar()->prepare("SELECT * FROM agencias");
								$sql->execute();
								$lista_agencia = $sql->fetchAll();
								foreach ($lista_agencia as $key => $value) {
									echo "<option value='".$value["idAgencia"]."'>".$value["nombre_agencia"]."</option>";
								}
							?>
						</select>
					</div>
					<div class="mb-3 col-lg-6">
						<select name="tipo_pago" class="form-select w-100 bg-abm-1">
						    <option>Selecionar medio de pago</option>
						    <option value="transferencia">Transferencia</option>
						    <option value="efectivo">Efectivo</option>
						    <option value="cheque">Cheque </option>
					  	</select>
					</div>
				</div>
			 	<div class="row justify-content-center">
					<div class="mb-3 col-lg-6">
					    <input type="text" name="fecha_cobro" id="datepicker" class="form-control bg-abm-1" placeholder="Fecha de Cobro">
					</div>
					<div class="mb-3 col-lg-6">
					  <input type="number" name="monto" class="form-control bg-abm-1" placeholder="Monto a pagar">
					</div>
				</div>
				 <div class="row justify-content-center">
				 	<div class="col-lg-12 pb-4 pt-1">
				  		<button type="submit" class="btn btn-success fw-bold w-100">cargar</button>
				  	</div>
				</div>
			</form>
		</section>
	</body>
</html>