		<?php if ($_SESSION['tipo'] == "administrador"){
			header("location:/resumendia");
		}?>
		<section class="container border border-4 border-success  px-0 rounded-3 bg-light" id="section-cargar-cobros">
			<h1 class="bg-success text-center px-0">cargar cobros</h1>
			<form class="px-5 pt-2" method="post" id="cargarcobros" action="php/cargarcobros.php">
			  	<div class="row justify-content-center">
				  	<div class="mb-3 col-lg-6">
						<select name="idAgencia" id="idAgencia" class="form-control bg-abm-1">
							<option value="-1">Seleccionar agencia</option>
							<?php 
								require_once("php/conexion.php"); 
								$sql = Conexion::conectar()->prepare("SELECT * FROM agencias WHERE idUsuario = :idUsuario");
								$sql->bindParam(":idUsuario",$_SESSION['idUsuario'],PDO::PARAM_INT);
								$sql->execute();
								$lista_agencia = $sql->fetchAll();
								foreach ($lista_agencia as $key => $value) {
									echo "<option value='".$value["idAgencia"]."'>".$value["nombre_agencia"]."</option>";
								}
							?>
						</select>
						<p class="text-danger error-message">Debes seleccionar una agencia.</p>
					</div>
					<div class="mb-3 col-lg-6">
						<select name="tipo_pago" id="tipo_pago" class="form-select w-100 bg-abm-1">
						    <option value="-1">Selecionar medio de pago</option>
						    <option value="transferencia">Transferencia</option>
						    <option value="efectivo">Efectivo</option>
						    <option value="cheque">Cheque </option>
					  	</select>
						<p class="text-danger error-message">Debes seleccionar un medio de pago.</p>

					</div>
				</div>
			 	<div class="row justify-content-center">
					<div class="mb-3 col-lg-6">
					    <input type="text" name="fecha_cobro" id="datepicker" class="form-control bg-abm-1" placeholder="Fecha de Cobro">
					  <p class="text-danger error-message">La fecha debe ser ingresada</p>

					</div>
					<div class="mb-3 col-lg-6">
					  <input type="number" name="monto" class="form-control bg-abm-1" id="monto" placeholder="Monto a pagar">
					  <p class="text-danger error-message">El monto debe ser mayor a 0 y numerico.</p>
					</div>
				</div>
				 <div class="row justify-content-center">
				 	<div class="col-lg-12 pb-4 pt-1">
				  		<button type="submit" class="btn btn-success fw-bold w-100">cargar</button>
				  	</div>
				</div>
			</form>
		</section>	
		<script>
			let checked = false;
			document.querySelector("#cargarcobros").addEventListener("submit",function(event){
				if (checked == false) {
					let mensajes = document.querySelectorAll(".error-message");
					mensajes.forEach((element)=>{
						element.classList.remove("active");
					});
					event.preventDefault();
					checked = true;
					let datepicker = document.querySelector("#datepicker");
					if(datepicker.value.length < 2){
						datepicker.nextElementSibling.classList.add("active")
						checked = false;
					}
					let idAgencia = document.querySelector("#idAgencia");
					if(idAgencia.value == -1){
						idAgencia.nextElementSibling.classList.add("active")
						checked = false;
					}
					let monto = document.querySelector("#monto");
					let regex = /([0-9])+/;
					if (regex.test(monto.value) ==  false || monto.value < 1) {
						monto.nextElementSibling.classList.add("active")
						checked = false;
					}
					let tipo_pago = document.querySelector("#tipo_pago");
					if(tipo_pago.value == -1){
						tipo_pago.nextElementSibling.classList.add("active")
						checked = false;
					}
					if (checked == true) {
						document.querySelector("#cargarcobros").submit();
					}
				}
			});
		</script>
	</body>
</html>
