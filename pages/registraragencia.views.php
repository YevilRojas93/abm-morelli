<?php if ($_SESSION["tipo"] == "agenciero"){
	header("location:/home");
} ?>
<?php 
	$error = explode("_",$_GET["id"]);
?>

	<section class="container px-0 pt-0 pb-3" id="section-form-registrar">
		<h1 class="text-center text-success pb-2"  >Agregar Agencia</h1>
		<hr class="bg-success" style="opacity: 1;">
		<form class="px-4" id="registraragencia" method="post" action="php/registraragencia.php">
			<div class="row justify-content-center">
				<div class="mb-2 col-lg-2">
				    <input type="number" name="agencia_id" value="<?= $_SESSION['agencia_error']["agencia_id"] ?? '' ?>" class="form-control" placeholder="ID agencia">
				    <?php 
				    	if (in_array("agenciaid", $error)) {
				    		echo "<p class='text-danger'>Agencia id debe ser numerico y mayor a 0.</p>";
				    	}
				    ?>
				    <?php 
				    	if (in_array("repeated", $error)) {
				    		echo "<p class='text-danger'>Agencia id repetida, ingrese otra.</p>";
				    	}
				    ?>
				</div>	
				<div class="mb-2 col-lg-4">
				    <input type="text" name="nombre_agencia"  value="<?= $_SESSION['agencia_error']["nombre_agencia"] ?? '' ?>" class="form-control" placeholder="Nombre Agencia">
				    <?php 
				    	if (in_array("nombre", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un nombre de agencia mayor a 4 caracteres.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-3 col-lg-3">
					<select name="idUsuario" id="idUsuario" class="form-control">
						<option value="-1">Seleccionar Agenciero</option>
						<?php
							require_once("php/conexion.php");
							$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE tipo = 'agenciero'");
							$sql->execute();
							$lista_agencia = $sql->fetchAll();
							foreach ($lista_agencia as $key => $value) {
								$selected = "";
								if (isset($_SESSION['agencia_error']["idUsuario"]) AND $value["idUsuario"] == $_SESSION['agencia_error']["idUsuario"]) {
									$selected = " selected ";
								}
								echo "<option value='".$value["idUsuario"]."' ".$selected.">".$value["nombre_completo"]."</option>";
							}
						?>
					</select>
					<p class="text-danger error-message">Debes seleccionar un agenciero.</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="mb-4 col-lg-3">
					<label for="exampleInputPassword1" class="form-label"></label>
					<input type="text" name="direccion"  value="<?= $_SESSION['agencia_error']["direccion"] ?? '' ?>" class="form-control" placeholder="Direccion">
					<?php 
				    	if (in_array("direccion", $error)) {
				    		echo "<p class='text-danger'>La direccion debe ser en el siguiente formato ej:'calle 123'.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="text" name="localidad"  value="<?= $_SESSION['agencia_error']["localidad"] ?? '' ?>" class="form-control" placeholder="Localidad">
				    <?php 
				    	if (in_array("localidad", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un localidad mayor a 2 caracteres.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputPassword1" class="form-label"></label>
				    <input type="number" name="telefono"  value="<?= $_SESSION['agencia_error']["telefono"] ?? '' ?>" class="form-control" placeholder="Telefono">
				    <?php 
				    	if (in_array("telefono", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un telefono mayor a 4 numeros.</p>";
				    	}
				    ?>
				</div>
			</div>
			<div class="row justify-content-center mb-3">
				<div class="col-lg-9">
				  <button type="submit" class="btn btn-success py-1 fs-5 w-100">Guardar</button>
				</div>
			</div>
		</form>
	</section>
	
<script>
	let checked = false;
	document.querySelector("#registraragencia").addEventListener("submit",function(event){
		if (checked == false) {
			let mensajes = document.querySelectorAll(".error-message");
			mensajes.forEach((element)=>{
				element.classList.remove("active");
			});
			event.preventDefault();
			checked = true;
			let idUsuario = document.querySelector("#idUsuario");
			if(idUsuario.value == -1){
				idUsuario.nextElementSibling.classList.add("active");
				checked = false;
			}
			if (checked == true) {
				document.querySelector("#registraragencia").submit();
			}
		}

	});
</script>


</body>
</html>