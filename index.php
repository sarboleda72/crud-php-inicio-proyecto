<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title> CRUD - ( PHP & MYSQL ) </title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/fontawesome-all.min.css">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1 class="text-center text-info"> <i class="fa fa-users"></i> CRUD - ( PHP & MYSQL ) </h1>
				<hr>
				<?php include 'config/connect.php'; ?>
				<?php
				$sql     = "SELECT * FROM inventario";
				$results = mysqli_query($conn, $sql);
				?>
				<a href="users/create.php" class="btn btn-success">
					<i class="fa fa-plus"></i> Adicionar inventario
				</a>
				<a href="pedido/create.php" class="btn btn-success">
					<i class="fa fa-plus"></i> Adicionar pedido
				</a>
				<hr>
				<h1>Inventario</h1>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th> Codigo de barra </th>
							<th> Cantidad </th>
							<th class="hidden-xs"> Fecha entrada</th>
							<th class="hidden-xs"> Fecha salida </th>
							<th class="hidden-xs"> Lote </th>
							<th class="hidden-xs"> Foto </th>
							<th> Acciones </th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_array($results)) { ?>
							<tr>
								<td> <?php echo $row['codigobarra'] ?> </td>
								<td> <?php echo $row['cantidad'] ?> </td>
								<td class="hidden-xs"> <?php echo $row['fechaentrada'] ?> </td>
								<td class="hidden-xs"> <?php echo $row['fehcasalida'] ?> </td>
								<td class="hidden-xs"> <?php echo $row['lote'] ?> </td>
								<td class="hidden-xs"> <img src="<?php echo $row['foto'] ?>" width="40px"> </td>
								<td>
									<a href="users/show.php?id=<?php echo $row['codigobarra'] ?>" class="btn btn-default"> <i class="fa fa-search"></i> </a>
									<a href="users/edit.php?id=<?php echo $row['codigobarra'] ?>" class="btn btn-default"> <i class="fa fa-pencil-alt"></i> </a>
									<a href="javascript:;" class="btn btn-danger btn-delete-inventario" data-id="<?php echo $row['codigobarra'] ?>"> <i class="fa fa-trash"></i> </a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php 
				$sql     = "SELECT * FROM pedido";
				$results = mysqli_query($conn, $sql);
				 ?>
				<hr>
				<h1>Pedido</h1>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th> ID </th>
							<th> Nombre del Artículo </th>
							<th> Cantidad Pedido </th>
							<th class="hidden-xs"> Fecha de Pedido </th>
							<th class="hidden-xs"> Fecha de Entrega </th>
							<th class="hidden-xs"> Foto </th>
							<th> Acciones </th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_array($results)) { ?>
							<tr>
								<td> <?php echo $row['id'] ?> </td>
								<td> <?php echo $row['nombrearticulo'] ?> </td>
								<td> <?php echo $row['cantidadpedido'] ?> </td>
								<td class="hidden-xs"> <?php echo $row['fechapedido'] ?> </td>
								<td class="hidden-xs"> <?php echo $row['fechaentrega'] ?> </td>
								<td class="hidden-xs"> <img src="<?php echo $row['foto'] ?>" width="40px"> </td>
								<td>
									<a href="pedido/show.php?id=<?php echo $row['id'] ?>" class="btn btn-default"> <i class="fa fa-search"></i> </a>
									<a href="pedido/edit.php?id=<?php echo $row['id'] ?>" class="btn btn-default"> <i class="fa fa-pencil-alt"></i> </a>
									<a href="javascript:;" class="btn btn-danger btn-delete-pedido" data-id="<?php echo $row['id'] ?>"> <i class="fa fa-trash"></i> </a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php mysqli_close($conn); ?>
			</div>
		</div>
	</div>

	<script src="public/js/jquery-3.3.1.min.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/sweetalert2.js"></script>
	<script>
		$(document).ready(function() {
			<?php if (isset($_SESSION['statusQuery'])) : ?>
				<?php if ($_SESSION['statusQuery'] == 'success') : ?>
					swal('Felicitaciones!', '<?php echo $_SESSION['message']; ?>', 'success');
				<?php else : ?>
					swal('Lo Sentimos!', '<?php echo $_SESSION['message']; ?>', 'error');
				<?php endif ?>
			<?php endif ?>
			<?php
			unset($_SESSION['statusQuery']);
			unset($_SESSION['message']);
			?>
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - */
			$('table').on('click', '.btn-delete-inventario', function(event) {
				event.preventDefault();
				$id = $(this).attr('data-id');
				swal({
					title: 'Esta seguro ?',
					text: "Realmente desea eliminar este usuario ?",
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: '#d33'
				}).then((result) => {
					if (result.value) {
						window.location.replace('users/delete.php?id=' + $id);
					}
				});
			});
			$('table').on('click', '.btn-delete-pedido', function(event) {
				event.preventDefault();
				$id = $(this).attr('data-id');
				swal({
					title: 'Esta seguro ?',
					text: "Realmente desea eliminar este usuario ?",
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: '#d33'
				}).then((result) => {
					if (result.value) {
						window.location.replace('pedido/delete.php?id=' + $id);
					}
				});
			});
		});
	</script>
</body>

</html>