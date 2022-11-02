<section id="section-listado">
		<h1 class="bg-success text-center px-0 mb-0">Listado de Agencia</h1>
			<table class="table border border-4 ">
		  <thead>
		    <tr>
		      <th scope="col">ID cobro</th>
		      <th scope="col">Monto</th>
		      <th scope="col">Agencia</th>
		      <th scope="col">Tipo de pago</th>
		      <th scope="col">Fecha</th>
		      <th scope="col">status</th>
		      <th scope="col">Modificar</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
				require_once("php/conexion.php"); 
				$sql = Conexion::conectar()->prepare("SELECT c.monto,c.idCobro,a.nombre_agencia as agencia,c.tipo_pago,c.fecha_cobro,c.status FROM cobros as c INNER JOIN agencias as a ON a.idAgencia = c.idAgencia");
				$sql->execute();
				$lista_cobros = $sql->fetchAll();
				foreach ($lista_cobros as $key => $value):
					?>
					<tr>
				      <th scope="row"><?= $value["idCobro"]; ?></th>
				      <td><?= $value["monto"]; ?></td>
				      <td><?= $value["agencia"]; ?></td>
				      <td><?= $value["tipo_pago"]; ?></td>
				      <td><?= $value["fecha_cobro"]; ?></td>
				      <td><?= $value["status"]; ?></td>
				      <td><a class="btn btn-warning" href="editarcobro/<?= $value['idCobro']; ?>">editar</a></td>
				    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
		</section>
	</body>
</html>