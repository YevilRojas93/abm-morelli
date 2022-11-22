<section class="container" id="section-listado">
		<h1 class="bg-success text-center px-0 mb-0">RESUMEN DEL DIA</h1>
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
		  <tbody>
		  	<?php require_once("php/conexion.php"); 
		  	$dia_actual = date("Y-m-d");
		  	$agencia = "";
		  	if ($_SESSION['tipo'] == "agenciero") {
		  		$agencia = "AND agencias.idUsuario = ".$_SESSION['idUsuario'];	
		  	}
		  	?>
					<tr class="fw-bold fs-5">
						<?php 
							$sql = Conexion::conectar()->prepare("SELECT sum(monto) as monto FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia  WHERE cobros.status = 'pagado' AND cobros.fecha_cobro = :dia_actual $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$efectivo = $sql->fetch();
						 ?>
				      <td class="text-success fw-bold">
				      	$<?= $efectivo["monto"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro = :dia_actual $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$efectivo = $sql->fetch();
						 ?>
				      <td>
				      	<?= $efectivo["cantidad"] ?? 0; ?>
				      </td>

				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND  cobros.fecha_cobro = :dia_actual AND tipo_pago = 'transferencia' $agencia");
							$sql->bindParam(":dia_actual",$dia_actual,PDO::PARAM_STR);
							$sql->execute();
							$transferencia = $sql->fetch();
						 ?>
				      <td>
				      	<?= $transferencia["cantidad"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro = $dia_actual AND tipo_pago = 'cheque' $agencia");
							$sql->execute();
							$cheque = $sql->fetch();
						 ?>
				      <td>
				      	<?= $cheque["cantidad"] ?? 0; ?>
				      </td>
				      <?php 
							$sql = Conexion::conectar()->prepare("SELECT count(idCobro) as cantidad FROM cobros INNER JOIN agencias ON agencias.idAgencia = cobros.idAgencia WHERE cobros.status = 'pagado' AND cobros.fecha_cobro = $dia_actual AND tipo_pago = 'efectivo' $agencia");
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