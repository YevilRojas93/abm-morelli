<?php 
	if (isset($_GET["id"]) AND $_GET["id"] > 0) {
		require_once("php/conexion.php");
		$id = htmlentities($_GET["id"],ENT_COMPAT,"UTF-8");
		$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE idUsuario = :id");
		$sql->bindParam(":id",$id,PDO::PARAM_INT);
		$sql->execute();
		$usuario = $sql->fetch();
	}
 ?>
<section class="container border border-primary border-4 rounded-3 mt-4 px-0" id="section-registro">
	<h1 class="d-flex justify-content-center bg-primary">EDITAR USUARIO</h1>
		<form method="post" action="php/editarusuario.php" class="px-5">
			<input type="hidden" name="idUsuario" value="<?= $_GET['id'] ?>">
		  	<div class="my-4 row">
		  	    <div class="col-lg-6">
			    	<input type="email" name="email" class="form-control bg-abm-1"  placeholder="Email" value="<?= $usuario['email'] ?>">
			 	</div>
				<div class="col-lg-6">
				    <input  type="text" name="nombre_completo" class="form-control bg-abm-1" placeholder="Nombre Completo" value="<?= $usuario['nombre_completo'] ?>">
				</div>
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
		 		<?php if ($_SESSION['tipo'] == "administrador"): ?>
					<div class="col-lg-6">	
					    <select name="tipo" class="form-control bg-abm-1">
					    	<option value="">Seleccionar tipo usuario</option>
					    	<?php var_dump($usuario["tipo"]) ?>
					    	<option value="administrador" <?php if($usuario['tipo'] == "administrador") echo "selected" ?>>Administrador</option>
					    	<option value="agenciero"  <?php if($usuario['tipo'] == "agenciero") echo "selected" ?>>Agenciero</option>
					    </select>
					</div>  
		 		<?php endif ?>
				<div class="col-lg-6">
					<select name="idAgencia" class="form-control  bg-abm-1">
				    	<option value="">Seleccionar agencia</option>
				    	<?php 
				    		$sql = Conexion::conectar()->prepare("SELECT * FROM agencias");
							$sql->execute();
							$agencias = $sql->fetchAll();
				    	?>
				    	<?php foreach ($agencias as $key => $value): ?>
				    		<option value="<?= $value['idAgencia'] ?>" <?php if($usuario['idAgencia'] == $value['idAgencia']) echo "selected" ?>><?= ucwords($value['nombre_agencia']) ?></option>
				    	<?php endforeach ?>
				    </select>
				</div>
			 	<div class="col-6 mt-4">
				  <button type="submit" class="btn btn-primary w-100">Enviar</button>
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