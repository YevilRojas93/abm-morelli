<?php if ($_SESSION["tipo"] == "agenciero"){
	header("location:/resumendia");
} ?>
<?php 
	$error = explode("_",$_GET["id"]);
 ?>
<section class="container border border-success border-4 rounded-3 mt-4 px-0" id="section-registro">
	<h1 class="d-flex justify-content-center">CREAR USUARIO</h1>
		<form method="post" id="registro" action="php/registro.php" class="px-5">
	  	<div class="my-4">
	  	    <div class="col-lg-12">
		    	<input type="email" name="email" class="form-control bg-abm-1"  placeholder="Email" value="<?= $_SESSION['registro_error']["email"] ?? "" ?>">
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
			</div>

			<div class="col-lg-6">
		    	<input type="password" name="password2" class="form-control bg-abm-1"  placeholder="Repetir Contraseña">
		    	<?php 
			    	if (in_array("pass2", $error)) {
			    		echo "<p class='text-danger'>Ambas contraseñas deben ser iguales.</p>";
			    	}
			    ?>
		 	</div>

	 	</div>

	 	<div class="mb-2 row justify-content-center">
	 		<div class="col-lg-6">
			    <input  type="text" name="nombre_completo" class="form-control bg-abm-1" placeholder="Nombre Completo"  value="<?= $_SESSION['registro_error']["nombre_completo"] ?? "" ?>">
			    <?php 
			    	if (in_array("nombre", $error)) {
			    		echo "<p class='text-danger'>Debe enviar un nombre mayor a 4 caracteres.</p>";
			    	}
			    ?>
			</div>
			<div class="col-lg-6">	
			    <select name="tipo" id="tipo" class="form-control bg-abm-1">
			    	<option value="">Seleccionar tipo usuario</option>
			    	<option value="administrador" <?php if($_SESSION['registro_error']["tipo"] == "administrador") echo "selected" ?> >Administrador</option>
			    	<option value="agenciero" <?php if($_SESSION['registro_error']["tipo"] == "agenciero") echo "selected" ?> >Agenciero</option>
			    </select>
			</div>  
		 	<div class="col-6 mt-4">
			  <button type="submit" class="btn btn-success w-100 ">Enviar</button>
			 </div>
	 	</div>

		</form>
	</section>
	<?php 
	//Si existe la variable id y id es == error
	if (isset($_GET["id"]) AND $_GET['id'] == "error"):?>
		<script>
			Swal.fire({
			  icon: 'error',
			  title: 'Error login',
			  text: 'Error inesperado.',
			});
		</script>
	<?php endif; ?>
	<script>
		let checked = false;
		document.querySelector("#registro").addEventListener("submit",function(event){
			if (checked == false) {
				let mensajes = document.querySelectorAll(".error-message");
				mensajes.forEach((element)=>{
					element.classList.remove("active");
				});
				event.preventDefault();
				checked = true;
				let tipo = document.querySelector("#tipo");
				if(tipo.value == -1){
					tipo.nextElementSibling.classList.add("active");
					checked = false;
				}
				if (checked == true) {
					document.querySelector("#registro").submit();
				}
			}

		});
	</script>
</body>
</html>