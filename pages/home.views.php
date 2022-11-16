<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_edit"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Modificacion exitoso!',
		  text: 'Los datos fueron actualizados.',
		});
	</script>
<?php endif; ?>

<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Creacion exitoso!',
		  text: 'Datos creados.',
		});
	</script>
<?php endif; ?>
<H1 class="text-center mt-5"> BIENVENIDO/A <?= ucwords($_SESSION["nombre_completo"]) ?></H1>
</body>
</html>