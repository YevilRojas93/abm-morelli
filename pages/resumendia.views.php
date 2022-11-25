<section class="container" id="section-listado">
	<?php if (!isset($_POST)): ?>
		<h1 class="bg-success text-center px-0 mb-0">RESUMEN DEL DIA</h1>
	<?php else: ?>
		<h1 class="bg-success text-center px-0 mb-0">RESUMEN POR FECHA</h1>
		<p class="bg-success text-center px-0 mb-0">De <?= $_POST["fecha_inicio"] ?> a <?= $_POST["fecha_fin"] ?> </p>
	<?php endif ?>
		<form method="post">
			<div class="col-md-5">
				<label for="">Fecha inicio</label>
				<input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control">
			</div>
			<div class="col-md-5">
				<label for="">Fecha fin</label>
				<input type="text" name="fecha_fin" id="fecha_fin" class="form-control">
			</div>
			<div class="col-md-2">
				<button class="btn btn-success w-100" type="submit">Filtrar</button>
			</div>
		</form>
		<table class="table border border-4 ">
		  <thead>
		    <tr>
		      <th scope="col">Efectivo recaudado</th>
		      <th scope="col">Cobros realizados</th>
		      <th scope="col">Por transferencia</th>
		      <th scope="col">Por cheque</th>
		      <th scope="col">Por efectivo</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  	<?php require_once("php/conexion.php"); 
		  	$dia_actual = date("Y-m-d");
		  	$fecha_inicio = $_POST["fecha_inicio"] ?? date('Y-m-d');  
		  	$fecha_fin = $_POST["fecha_fin"] ?? date('Y-m-d');  

		  	$fecha_inicio = htmlentities($fecha_inicio,ENT_COMPAT,"UTF-8");
		  	$fecha_fin = htmlentities($fecha_fin,ENT_COMPAT,"UTF-8");
		  	$agencia = "";
		  	if ($_SESSION['tipo'] == "agenciero") {
		  		$agencia = "AND agencias.idUsuario = ".$_SESSION['idUsuario'];	
		  	}
		  	?>
					<tr class="fw-bold fs-5">
						<?php 
							$sql = Conexion::conectar()->prepare("SELECT sum(monto) as monto FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia  WHERE cobros.status = 'pagado' AND cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin $agencia");
							$sql->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
							$sql->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
							$sql->execute();
							$efectivo = $sql->fetch();
						 ?>
				      <td class="text-success fw-bold">
				      	$<?= $efectivo["monto"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$efectivo = $sql->fetch();
						 ?>
				      <td>
				      	<?= $efectivo["cantidad"] ?? 0; ?>
				      </td>

				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND  cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin AND tipo_pago = 'transferencia' $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$transferencia = $sql->fetch();
						 ?>
				      <td>
				      	<?= $transferencia["cantidad"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin AND tipo_pago = 'cheque' $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$cheque = $sql->fetch();
						 ?>
				      <td>
				      	<?= $cheque["cantidad"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro BETWEEN :fecha_inicio and :fecha_fin AND tipo_pago = 'efectivo' $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$efectivo = $sql->fetch();
						 ?>
				      <td>
				      	<?= $efectivo["cantidad"] ?? 0; ?>
				      </td>
				    </tr>
		  </tbody>
		</table>
		</section>
	</body>
</html>