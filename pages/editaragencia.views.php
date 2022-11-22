<?php 
	$error = explode("_",$_GET["status"]);
?>
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
		<form class="px-4" id="editaragencia" method="post" action="php/registraragencia.php">
			<div class="row justify-content-center">
				<div class="mb-2 col-lg-2">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="number" name="agencia_id" value="<?= $agencia["agencia_id"] ?? "" ?>" class="form-control" placeholder="ID agencia">
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
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="text" name="nombre_agencia" value="<?= $agencia["nombre_agencia"] ?? "" ?>" class="form-control" placeholder="Nombre Agencia">
				    <?php 
				    	if (in_array("nombre", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un nombre de agencia mayor a 4 caracteres.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-3 col-lg-3">
					<label for="" class="form-label"></label>
					<select name="idUsuario" id="idUsuario" class="form-control">
						<option value="-1">Seleccionar Agenciero</option>
						<?php
							require_once("php/conexion.php");
							$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE tipo = 'agenciero'");
							$sql->execute();
							$lista_agencia = $sql->fetchAll();
							foreach ($lista_agencia as $key => $value) {
								$actual = "";
								if($value["idUsuario"] == $agencia["idUsuario"]) $actual = "selected";
								echo "<option value='".$value["idUsuario"]."' ".$actual.">".$value["nombre_completo"]."</option>";
							}
						?>
					</select>
					<p class="text-danger error-message">Debes seleccionar un agenciero.</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="mb-4 col-lg-3">
					<label for="exampleInputPassword1" class="form-label"></label>
					<input type="text" name="direccion" value="<?= $agencia["direccion"] ?? "" ?>" class="form-control" placeholder="Direccion">
					<?php 
				    	if (in_array("direccion", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un localidad mayor a 2 caracteres.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputEmail1" class="form-label"></label>
				    <input type="text" name="localidad" value="<?= $agencia["localidad"] ?? "" ?>" class="form-control" placeholder="Localidad">
				    <?php 
				    	if (in_array("localidad", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un localidad mayor a 2 caracteres.</p>";
				    	}
				    ?>
				</div>
				<div class="mb-4 col-lg-3">
				    <label for="exampleInputPassword1" class="form-label"></label>
				    <input type="number" name="telefono" value="<?= $agencia["telefono"] ?? "" ?>" class="form-control" placeholder="Telefono">
				    <?php 
				    	if (in_array("telefono", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un telefono mayor a 4 numeros.</p>";
				    	}
				    ?>
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
	<script>
	let checked = false;
	document.querySelector("#editaragencia").addEventListener("submit",function(event){
		if (checked == false) {
			event.preventDefault();
			checked = true;
			let idUsuario = document.querySelector("#idUsuario");
			if(idUsuario.value == -1){
				idUsuario.nextElementSibling.classList.add("active");
				checked = false;
			}
			if (checked == true) {
				document.querySelector("#editaragencia").submit();
			}
		}

	});
</script>

</body>
</html>