	<section id="section-listado" class="container">
		<h1 class="bg-success text-center px-0 mb-0">COBROS PENDIENTES</h1>
			<form method="post" class="row py-2 px-3 text-center">
				<div class="col-md-5">
					<label for="" class="fw-bold">Fecha inicio</label>
					<input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control">
				</div>
				<div class="col-md-5">
					<label for="" class="fw-bold">Fecha fin</label>
					<input type="text" name="fecha_fin" id="fecha_fin" class="form-control">
				</div>
				<div class="col-md-2">
					<label for=""></label>
					<button class="btn btn-success w-100" type="submit">Filtrar</button>
				</div>
			</form>
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
			  	<!--  -->
			  	<?php 
					require_once("php/conexion.php"); 
			  		$dia_actual = date("Y-m-d");
				  	$fecha_inicio = $_POST["fecha_inicio"] ?? date('1970-01-01');  
				  	$date = new DateTime(date("Y-m-d")); // Y-m-d
					$date->add(new DateInterval('P90D'));
					$fin_default =  $date->format('Y-m-d');
				  	$fecha_fin = $_POST["fecha_fin"] ?? date('2023-12-31');  


				  	$fecha_inicio = htmlentities($fecha_inicio,ENT_COMPAT,"UTF-8");
				  	$fecha_fin = htmlentities($fecha_fin,ENT_COMPAT,"UTF-8");
			  		$agencia = "";
			  		if ($_SESSION["tipo"] == "agenciero") {
			  			$agencia = "AND a.idUsuario = ".$_SESSION['idUsuario'];
			  		}

					$sql = Conexion::conectar()->prepare("SELECT c.monto,c.idCobro,a.nombre_agencia as agencia,c.tipo_pago,c.fecha_cobro,c.status FROM cobros as c INNER JOIN agencias as a ON a.idAgencia = c.idAgencia WHERE  cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin $agencia AND c.status = 'pendiente'");
					$sql->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
					$sql->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
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