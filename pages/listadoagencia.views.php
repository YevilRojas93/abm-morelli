<section id="section-listado" class="container-fluid px-5">
		<?php if ($_SESSION["tipo"] == "administrador"): ?>
			<h1 class="bg-success text-center px-0 mb-0">Listado de Agencia</h1>
		<?php else: ?>
			<h1 class="bg-success text-center px-0 mb-0">Mis agencias</h1>
		<?php endif; ?>
		<table class="table border border-4 ">
		  <thead>
		    <tr>
		      <th scope="col">Numero de Agencia</th>
		      <th scope="col">Nombre</th>
		      <th scope="col">Telefono</th>
		      <th scope="col">Agenciero</th>
		      <th scope="col">localidad</th>
		      <th scope="col">direccion</th>
		      <th scope="col">Modificar</th>
		    </tr>
		  </thead>
		  <tbody class="fs-5">
		  	<?php 
				require_once("php/conexion.php"); 
				if ($_SESSION["tipo"] == "administrador") {
					$sql = Conexion::conectar()->prepare("SELECT a.idAgencia,a.nombre_agencia,a.telefono,a.localidad,a.direccion,u.nombre_completo FROM agencias AS a LEFT JOIN usuarios AS u ON u.idUsuario = a.idUsuario");
				}
				else{
					$sql = Conexion::conectar()->prepare("SELECT a.idAgencia,a.nombre_agencia,a.telefono,a.localidad,a.direccion,u.nombre_completo FROM agencias AS a LEFT JOIN usuarios AS u ON u.idUsuario = a.idUsuario where a.idUsuario = :idUsuario");
					$sql->bindParam(":idUsuario",$_SESSION['idUsuario'],PDO::PARAM_INT); 
				}
				$sql->execute();
				$lista_agencia = $sql->fetchAll();
				if (count($lista_agencia) == 0) {
					echo "<tr> <td colspan='6' class='text-center fw-bold'>NINGUN Resultado</td> </tr>";
				}
				foreach ($lista_agencia as $key => $value):
					?>
					<tr>
				      <th scope="row"><?= $value["agencia_id"]; ?></th>
				      <td><?= $value["nombre_agencia"]; ?></td>
				      <td><?= $value["telefono"]; ?></td>
				      <td><?= ($value["nombre_completo"] ?? "NINGUNO"); ?></td>
				      <td><?= $value["localidad"]; ?></td>
				      <td><?= $value["direccion"]; ?></td>
				      <td>
				      	<a class="btn btn-warning" href="editaragencia/<?= $value["idAgencia"]; ?>">Editar</a>
				      	<a class="btn btn-danger" href="borraragencia/<?= $value["idAgencia"]; ?>">Borrar</a>
				      </td>
				    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
		</section>
	</body>
</html>