<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_edit_usuario"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Usuario editado',
		  text: 'Usuario modificado correctamente!.',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_edit_agencia"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Agencia editado',
		  text: 'Agencia modificada correctamente!.',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_edit_cobro"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Cobro editado',
		  text: 'Cobro modificado exitosamente!.',
		});
	</script>
<?php endif; ?>


<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "password_cambiada"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Contraseña modificada exitosamente!',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_usuario"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Creacion de usuario!',
		  text: 'Usuario ingresado exitosamente!.',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_create_agencia"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Creacion de agencia',
		  text: 'Agencia ingresada exitosamente!.',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_cobro"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Creacion de cobros',
		  text: 'Cobro ingresado exitosamente!.',
		});
	</script>
<?php endif; ?>
<H1 class="text-center mt-5"> BIENVENIDO/A <?= ucwords($_SESSION["nombre_completo"]) ?></H1>
</body>
</html>