<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Consultar Usuario </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-search"></i> Consultar Inventario </h1>
				<hr>
				<ol class="breadcrumb">
				  <li><a href="../">Inicio</a></li>
				  <li class="active">Consultar Inventario</li>
				</ol>
				<table class="table table-striped table-hover">
				<?php 
					include '../config/connect.php';
					if (isset($_GET['id'])) {
						$id     = $_GET['id'];
						$sql    = "SELECT * FROM inventario WHERE codigobarra = $id";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($result)) {
				?>
					<tr>
						<th> Codigo Barra </th>
						<td> <?php echo $row['codigobarra']; ?></td>
					</tr>
					<tr>
						<th> cantidad </th>
						<td> <?php echo $row['cantidad']; ?></td>
					</tr>
					<tr>
						<th> Fecha de entrada </th>
						<td> <?php echo $row['fechaentrada']; ?></td>
					</tr>
					<tr>
						<th> Fecha de salida </th>
						<td> <?php echo $row['fehcasalida']; ?></td>
					</tr>
					<tr>
						<th> Lote </th>
						<td> <?php echo $row['lote']; ?></td>
					</tr>
					<tr>
						<th> Foto </th>
						<td> 
							<img src="../<?php echo $row['foto']; ?>" width="80px" data-img="<?php echo $row['foto']; ?>" style="cursor: zoom-in;"> 
						</td>
					</tr>
				<?php
						}
					}
					mysqli_close($conn); 
				?>
				</table>
			</div>
		</div>
	</div>

	<script src="../public/js/jquery-3.3.1.min.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
	<script src="../public/js/sweetalert2.js"></script>
	<script>
		$(document).ready(function() {
			$('table').on('click', 'img', function(event) {
				event.preventDefault();
				$ui = $(this).attr('data-img');
				swal({
                 	imageUrl: '../'+$ui
 				});
			});
		});
	</script>
</body>
</html>