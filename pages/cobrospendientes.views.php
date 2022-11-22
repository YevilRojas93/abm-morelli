	<section id="section-listado" class="container">
		<h1 class="bg-success text-center px-0 mb-0">COBROS PENDIENTES</h1>
			<table class="table border border-4 ">
			  <thead>
			    <tr>
			      <th scope="col">ID cobro</th>
			      <th scope="col">Monto</th>
			      <th scope="col">Agencia</th>
			      <th scope="col">Tipo de pago</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">status</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
					require_once("php/conexion.php"); 
			  		$dia_actual = date("Y-m-d");
			  		$agencia = "";
			  		if ($_SESSION["tipo"] == "agenciero") {
			  			$agencia = "AND a.idUsuario = ".$_SESSION['idUsuario'];
			  		}

					$sql = Conexion::conectar()->prepare("SELECT c.monto,c.idCobro,a.nombre_agencia as agencia,c.tipo_pago,c.fecha_cobro,c.status FROM cobros as c INNER JOIN agencias as a ON a.idAgencia = c.idAgencia WHERE fecha_cobro => :dia_actual $agencia AND c.status = 'pendiente'");
					$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
					$sql->execute();
					$lista_cobros = $sql->fetchAll();
					if (count($lista_cobros) == 0) {
						echo "<tr> <td colspan='6' class='text-center fw-bold'>NINGUN Resultado</td> </tr>";
					}
					foreach ($lista_cobros as $key => $value):
						?>
						<tr>
					      <th scope="row"><?= $value["idCobro"]; ?></th>
					      <td class="text-success">$<?= $value["monto"]; ?></td>
					      <td><?= $value["agencia"]; ?></td>
					      <td><?= $value["tipo_pago"]; ?></td>
					      <td><?= $value["fecha_cobro"]; ?></td>
					      <?php if ($value["status"] == "pendiente"): ?>
					      	<td class="text-warning fw-bold"><?= $value["status"]; ?></td>
					      <?php elseif($value["status"] == "pagado"): ?>	
					      	<td class="text-success fw-bold"><?= $value["status"]; ?></td>
					      <?php endif ?>
					    </tr>
				<?php endforeach; ?>
			  </tbody>
			</table>
		</section>
	</body>
</html>