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
			<div class="col-md-8 col-md-offset-2">
				<h1 class="text-center text-info"> <i class="fa fa-users"></i> CRUD - ( PHP & MYSQL ) </h1>
				<hr>
				<?php include 'config/connect.php'; ?>
				<?php 
					$sql     = "SELECT * FROM usuarios";
					$results = mysqli_query($conn, $sql);
				?>
				<a href="users/create.php" class="btn btn-success"> 
					<i class="fa fa-plus"></i> Adicionar Usuario 
				</a>
				<hr>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th> Documento </th>
							<th> Nombres </th>
							<th class="hidden-xs"> Correo Electrónico </th>
							<th class="hidden-xs"> Rol </th>
							<th class="hidden-xs"> Foto </th>
							<th> Acciones </th>
						</tr>
					</thead>
					<tbody>
					<?php while ($row = mysqli_fetch_array($results)) { ?>
						<tr>
							<td> <?php echo $row['documento'] ?> </td>
							<td> <?php echo $row['nombres'] ?> </td>
							<td class="hidden-xs"> <?php echo $row['correo'] ?> </td>
							<td class="hidden-xs"> <?php echo $row['rol'] ?> </td>
							<td class="hidden-xs"> <img src="<?php echo $row['foto'] ?>" width="40px"> </td>
							<td>
								<a href="users/show.php?id=<?php echo $row['documento'] ?>" class="btn btn-default"> <i class="fa fa-search"></i> </a>
								<a href="users/edit.php?id=<?php echo $row['documento'] ?>" class="btn btn-default"> <i class="fa fa-pencil-alt"></i> </a>
								<a href="javascript:;" class="btn btn-danger btn-delete" data-id="<?php echo $row['documento'] ?>"> <i class="fa fa-trash"></i> </a>
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
			<?php if (isset($_SESSION['statusQuery'])): ?>
				<?php if ($_SESSION['statusQuery'] == 'success'): ?>
					swal('Felicitaciones!','<?php echo $_SESSION['message']; ?>','success');
				<?php else: ?>
					swal('Lo Sentimos!','<?php echo $_SESSION['message']; ?>','error');
				<?php endif ?>
			<?php endif ?>
			<?php 
				unset($_SESSION['statusQuery']);
				unset($_SESSION['message']);
			?>
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - */
			$('table').on('click', '.btn-delete', function(event) {
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
					window.location.replace('users/delete.php?id='+$id);
				  }
				});
			});
		});
	</script>
</body>
</html>