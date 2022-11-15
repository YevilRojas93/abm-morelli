<section id="section-listado" class="container-fluid px-5 pt-3">
		<h1 class="bg-primary text-center px-0 mb-0">Listado de usuarios</h1>
		<table class="table border border-4 border-primary">
		  <thead>
		    <tr>
		      <th scope="col">ID#</th>
		      <th scope="col">Nombre completo</th>
		      <th scope="col">Tipo</th>
		      <th scope="col">Email</th>
		      <th scope="col">Fecha</th>
		      <th scope="col">Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
				require_once("php/conexion.php"); 
				$sql = Conexion::conectar()->prepare("SELECT * FROM usuarios");
				$sql->execute();
				$lista_usuarios = $sql->fetchAll();
				foreach ($lista_usuarios as $key => $value):
					$actual = ($_SESSION['idUsuario'] == $value["idUsuario"]) ? " class='fw-bold' " : "";
					?>
					<tr>
				      <th scope="row" <?= $actual ?>><?= $value["idUsuario"]; ?></th>
				      <td <?= $actual ?>><?= $value["nombre_completo"]; ?></td>
				      <td <?= $actual ?>><?= $value["tipo"]; ?></td>
				      <td <?= $actual ?>><?= $value["email"]; ?></td>
				      <td <?= $actual ?>><?= $value["fecha"]; ?></td>
				      <td>
				      	<a class="btn btn-warning" href="editarusuario/<?= $value["idUsuario"]; ?>">Editar</a>
				      	<?php if ($_SESSION['idUsuario'] == $value["idUsuario"]): ?>
				      		<a class="btn btn-secondary disabled">Borrar</a>
				      		<?php else: ?>
				      		<a class="btn btn-danger" href="borrarusuario/<?= $value["idUsuario"]; ?>">Borrar</a>
				      	<?php endif ?>
				      </td>
				    </tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
		</section>
	</body>
</html>