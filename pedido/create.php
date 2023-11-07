<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title> Adicionar Pedido </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-plus"></i> Adicionar Pedido </h1>
				<hr>
				<ol class="breadcrumb">
					<li><a href="../">Inicio</a></li>
					<li class="active">Adicionar Pedido</li>
				</ol>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" class="form-control" name="nombrearticulo" placeholder="Nombre del Artículo" required>
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="cantidadpedido" placeholder="Cantidad del Pedido" required>
					</div>
					<div class="form-group">
						<label>Fecha de Pedido</label>
						<input type="date" class="form-control" name="fechapedido" required>
					</div>
					<div class="form-group">
						<label>Fecha de Entrega</label>
						<input type="date" class="form-control" name="fechaentrega" required>
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="foto" accept="image/*" required>
						<button class="btn btn-default btn-foto"> <i class="fa fa-image"></i> Seleccionar Foto del Pedido </button>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Guardar </button>
						<button type="reset" class="btn btn-default"> <i class="fa fa-sync-alt"></i> Limpiar </button>
					</div>
				</form>
				<?php
				include '../config/connect.php';
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$nombrearticulo = mysqli_real_escape_string($conn, $_POST['nombrearticulo']);
					$cantidadpedido = mysqli_real_escape_string($conn, $_POST['cantidadpedido']);
					$fechapedido = mysqli_real_escape_string($conn, $_POST['fechapedido']);
					$fechaentrega = mysqli_real_escape_string($conn, $_POST['fechaentrega']);
					$url = 'public/imgs/fotos/';
					$foto = $url . $_FILES['foto']['name'];
					move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $url . $_FILES['foto']['name']);
					$sql = "INSERT INTO pedido (nombrearticulo, cantidadpedido, fechapedido, fechaentrega, foto) VALUES ('$nombrearticulo', '$cantidadpedido', '$fechapedido', '$fechaentrega', '$foto')";
					if (mysqli_query($conn, $sql)) {
						$_SESSION['statusQuery'] = 'success';
						$_SESSION['message'] = 'Pedido Adicionado con Éxito!';
					} else {
						$_SESSION['statusQuery'] = 'danger';
						$_SESSION['message'] = 'El Pedido no se pudo Adicionar!';
					}
					echo "<script> window.location.replace('../') </script>";
				}
				mysqli_close($conn);
				?>
			</div>
		</div>
	</div>

	<script src="../public/js/jquery-3.3.1.min.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
	<script src="../public/js/sweetalert2.js"></script>
	<script>
		$(document).ready(function() {
			$('input[type=file]').hide();
			$('form').on('click', '.btn-foto', function(event) {
				event.preventDefault();
				$('input[type=file]').click();
			});
		});
	</script>
</body>

</html>
