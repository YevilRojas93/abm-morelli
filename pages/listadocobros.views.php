<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "pagado"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Cobro pagado',
		});
	</script>
<?php endif; ?>
<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_edit"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Cobro editado',
		});
	</script>
<?php endif; ?>
<?php 
//Si existe la variable id y id es == error
if (isset($_GET["id"]) AND $_GET['id'] == "success_cobro"):?>
	<script>
		Swal.fire({
		  icon: 'success',
		  title: 'Cobro agregado',
		});
	</script>
<?php endif; ?>

	<section id="section-listado" class="container-fluid px-5">
		<h1 class="bg-success text-center px-0 mb-0">Listado de Cobros</h1>
			<table class="table border border-4 ">
		  <thead>
		    <tr>
		      <th scope="col">ID cobro</th>
		      <th scope="col">Monto</th>
		      <th scope="col">Agencia</th>
		      <th scope="col">Agencia Id</th>
		      <th scope="col">Tipo de pago</th>
		      <th scope="col">Fecha</th>
		      <th scope="col">status</th>
			  <?php if ($_SESSION["tipo"] == "administrador"): ?>
		      	<th scope="col">Modificar</th>
		  	  <?php endif; ?>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
				require_once("php/conexion.php");
				if ($_SESSION['tipo'] == "agenciero") {
					$sql = Conexion::conectar()->prepare("SELECT c.monto,c.idCobro,a.nombre_agencia as agencia,c.tipo_pago,c.fecha_cobro,c.status,a.agencia_id FROM cobros as c INNER JOIN agencias as a ON a.idAgencia = c.idAgencia WHERE a.idUsuario = :idUsuario");
					$sql->bindParam(":idUsuario",$_SESSION['idUsuario'],PDO::PARAM_INT);
				}
				elseif($_SESSION['tipo'] == "administrador"){
					$sql = Conexion::conectar()->prepare("SELECT c.monto,c.idCobro,a.nombre_agencia as agencia,c.tipo_pago,c.fecha_cobro,c.status,a.agencia_id FROM cobros as c INNER JOIN agencias as a ON a.idAgencia = c.idAgencia");
				}
				$sql->execute();
				$lista_cobros = $sql->fetchAll();
				if (count($lista_cobros) == 0) {
					echo "<tr> <td colspan='6' class='text-center fw-bold'>NINGUN Resultado</td> </tr>";
				}
				foreach ($lista_cobros as $key => $value):
					?>
					<tr>
				      <th scope="row"><?= $value["idCobro"]; ?></th>
				      <td class="text-success fw-bold">$<?= $value["monto"]; ?></td>
				      <td><?= $value["agencia"]; ?></td>
				      <td><?= $value["agencia_id"]; ?></td>
				      <td><?= $value["tipo_pago"]; ?></td>
				      <td><?= $value["fecha_cobro"]; ?></td>
				      <?php if ($value["status"] == "pendiente"): ?>
				      	<td class="text-warning fw-bold"><?= $value["status"]; ?></td>
				      <?php elseif($value["status"] == "pagado"): ?>	
				      	<td class="text-success fw-bold"><?= $value["status"]; ?></td>
				      <?php endif ?>
				      <?php if ($_SESSION["tipo"] == "administrador"): ?>
				      <td>
				      	<a class="btn btn-warning" href="editarcobro/<?= $value['idCobro']; ?>">editar</a>
				      	<a class="btn btn-danger" href="borrarcobro/<?= $value['idCobro']; ?>">borrar</a>
				      		<a class="btn btn-primary" href="pagarcobro/<?= $value['idCobro']; ?>">Pagado</a>
				  	  </td>
				      <?php endif ?>
				    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
		</section>
	</body>
</html>