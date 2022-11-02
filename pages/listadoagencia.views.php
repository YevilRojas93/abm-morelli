<section id="section-listado">
		<h1 class="bg-success text-center px-0 mb-0">Listado de Agencia</h1>
			<table class="table border border-4 ">
		  <thead>
		    <tr>
		      <th scope="col">Numero de Agencia</th>
		      <th scope="col">Nombre</th>
		      <th scope="col">Telefono</th>
		      <th scope="col">localidad</th>
		      <th scope="col">direccion</th>
		      <th scope="col">Modificar</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
				require_once("php/conexion.php"); 
				$sql = Conexion::conectar()->prepare("SELECT * FROM agencias");
				$sql->execute();
				$lista_agencia = $sql->fetchAll();
				foreach ($lista_agencia as $key => $value):
					?>
					<tr>
				      <th scope="row"><?= $value["agencia_id"]; ?></th>
				      <td><?= $value["nombre_agencia"]; ?></td>
				      <td><?= $value["telefono"]; ?></td>
				      <td><?= $value["localidad"]; ?></td>
				      <td><?= $value["direccion"]; ?></td>
				      <td><a class="btn btn-warning" href="editaragencia/<?= $value["idAgencia"]; ?>">editar</a></td>
				    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
		</section>
	</body>
</html>