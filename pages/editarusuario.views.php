<?php 
	
	if (isset($_GET["id"]) AND $_GET["id"] > 0 AND  $_SESSION['tipo'] == "administrador") {
		require_once("php/conexion.php");
		$id = htmlentities($_GET["id"],ENT_COMPAT,"UTF-8");
		$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE idUsuario = :id");
		$sql->bindParam(":id",$id,PDO::PARAM_INT);
		$sql->execute();
		$usuario = $sql->fetch();
		$error = explode("_",$_GET["status"]);
	}else{
		header("location:/resumendia");
	}
 ?>
<section class="container border border-primary border-4 rounded-3 mt-4 px-0" id="section-registro">
	<h1 class="d-flex justify-content-center bg-primary">EDITAR USUARIO</h1>
		<form method="post" id="editarusuario" action="php/editarusuario.php" class="px-5">
			<input type="hidden" name="idUsuario" value="<?= $_GET['id'] ?>">
		  	<div class="my-4 row">
		  	    <div class="col-lg-12">
			    	<input type="email" name="email" class="form-control bg-abm-1"  placeholder="Email" value="<?= $usuario['email'] ?>">
			    	<?php 
			    	if (in_array("email", $error)) {
			    		echo "<p class='text-danger'>Debe enviar un email mayor a 5 caracteres.</p>";
			    	}
			    	?>
			 	</div>
				
			</div>

			<div class="mb-4 row">
				<div class="col-lg-6">	
				    <input type="password" name="password1" class="form-control bg-abm-1" placeholder="Contraseña">
				    <?php 
				    	if (in_array("password", $error)) {
				    		echo "<p class='text-danger'>Debe enviar una contraseña mayor a 4 caracteres.</p>";
				    	}
				    ?>
				    <?php 
				    	if (in_array("pass2", $error)) {
				    		echo "<p class='text-danger'>Ambas contraseñas deben ser iguales.</p>";
				    	}
				    ?>
				</div>

				<div class="col-lg-6">
			    	<input type="password" name="password2" class="form-control bg-abm-1"  placeholder="Repetir Contraseña">
			 	</div>

		 	</div>

		 	<div class="mb-2 row justify-content-center">
		 		<?php if ($_SESSION['tipo'] == "administrador"): ?>
					<div class="col-lg-6">	
					    <select name="tipo" id="tipo" class="form-control bg-abm-1">
					    	<option value="-1">Seleccionar tipo usuario</option>

					    	<option value="administrador" <?php if($usuario['tipo'] == "administrador") echo "selected" ?>>Administrador</option>
					    	<option value="agenciero"  <?php if($usuario['tipo'] == "agenciero") echo "selected" ?>>Agenciero</option>
					    </select>
					    <p class="text-danger error-message">Debe seleccionar un tipo de usuario</p>
					</div>  
					<div class="col-lg-6">
				    <input  type="text" name="nombre_completo" class="form-control bg-abm-1" placeholder="Nombre Completo" value="<?= $usuario['nombre_completo'] ?>">
				    <?php 
				    	if (in_array("nombre", $error)) {
				    		echo "<p class='text-danger'>Debe enviar un nombre mayor a 4 caracteres.</p>";
				    	}
				    ?>
				</div>
		 		<?php endif ?>
			 	<div class="col-6 mt-4">
				  <button type="submit" class="btn btn-primary w-100">Enviar</button>
				 </div>
		 	</div>
		</form>
	</section>
	<script>
		let checked = false;
		document.querySelector("#editarusuario").addEventListener("submit",function(event){
			if (checked == false) {
				event.preventDefault();
				checked = true;
				let tipo = document.querySelector("#tipo");
				if(tipo.value == -1){
					tipo.nextElementSibling.classList.add("active");
					checked = false;
				}
				if (checked == true) {
					document.querySelector("#editarusuario").submit();
				}
			}

		});
	</script>

</body>
</html>