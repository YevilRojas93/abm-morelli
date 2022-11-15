<?php if ($_SESSION["tipo"] == "agenciero"){
	header("location:/resumendia");
} ?>
<section class="container border border-success border-4 rounded-3 mt-4 px-0" id="section-registro">
	<h1 class="d-flex justify-content-center">CREAR USUARIO</h1>
		<form method="post" action="php/registro.php" class="px-5">
	  	<div class="my-4">
	  	    <div class="col-lg-12">
		    	<input type="email" name="email" class="form-control bg-abm-1"  placeholder="Email">
		 	</div>
		</div>
		<div class="mb-4">
		    <input  type="text" name="nombre_completo" class="form-control bg-abm-1" placeholder="Nombre Completo">
		</div>

		<div class="mb-4 row">
			<div class="col-lg-6">	
			    <input type="password" name="password1" class="form-control bg-abm-1" placeholder="Contraseña">
			</div>

			<div class="col-lg-6">
		    	<input type="password" name="password2" class="form-control bg-abm-1"  placeholder="Repetir Contraseña">
		 	</div>

	 	</div>

	 	<div class="mb-2 row justify-content-center">
			<div class="col-lg-6">	
			    <select name="tipo" class="form-control bg-abm-1">
			    	<option value="">Seleccionar tipo usuario</option>
			    	<option value="administrador">Administrador</option>
			    	<option value="agenciero">Agenciero</option>
			    </select>
			</div>  
			<div class="col-lg-6">
				<select name="idAgencia" class="form-control  bg-abm-1">
			    	<option value="">Seleccionar agencia</option>
			    </select>
			</div>
		 	<div class="col-6 mt-4">
			  <button type="submit" class="btn btn-success w-100 ">Enviar</button>
			 </div>
	 	</div>
	 	<div class="text-center mb-2">
			<a href="login" class="link-primary fs-5">Ir a login</a>
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
			  text: 'Los datos ingresados son erroneos.',
			  footer: '<a href="/login">¿Ya tienes cuenta?</a>'
			});
		</script>
	<?php endif; ?>

	<?php if (isset($_GET["id"]) AND $_GET['id'] == "error_password"):?>
		<script>
			Swal.fire({
			  icon: 'error',
			  title: 'Error login',
			  text: 'Las contraseñas no coinciden.'
			});
		</script>
	<?php endif; ?>

</body>
</html>