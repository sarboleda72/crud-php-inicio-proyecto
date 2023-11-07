<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title> Adicionar Inventario </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-plus"></i> Adicionar inventario </h1>
				<hr>
				<ol class="breadcrumb">
					<li><a href="../">Inicio</a></li>
					<li class="active">Adicionar inventario</li>
				</ol>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="number" class="form-control" name="codigobarra" placeholder="Codigo de barra" required>
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="cantidadpedido" placeholder="Cantidad en el inventario" required>
					</div>
					<div class="form-group">
						<label>Fecha de entrada</label>
						<input type="date" class="form-control" name="fechapedido" placeholder="Fecha de entrada" required>
					</div>
					<div class="form-group">
						<label>Fecha de salida</label>
						<input type="date" class="form-control" name="fechaentrega" placeholder="Fecha de salida" required>
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="lote" placeholder="Número de lote" required>
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="foto" accept="image/*" required>
						<button class="btn btn-default btn-foto"> <i class="fa fa-user"></i> Seleccione Foto del inventario </button>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Guardar </button>
						<button type="reset" class="btn btn-default"> <i class="fa fa-sync-alt"></i> Limpiar </button>
					</div>
				</form>
				<?php
				include '../config/connect.php';
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$codigobarra = mysqli_real_escape_string($conn, $_POST['codigobarra']);
					$cantidadpedido = mysqli_real_escape_string($conn, $_POST['cantidadpedido']);
					$fechapedido = mysqli_real_escape_string($conn, $_POST['fechapedido']);
					$fechaentrega = mysqli_real_escape_string($conn, $_POST['fechaentrega']);
					$lote = mysqli_real_escape_string($conn, $_POST['lote']);
					$url = 'public/imgs/fotos/';
					$foto = $url . $_FILES['foto']['name'];
					move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $url . $_FILES['foto']['name']);
					$sql = "INSERT INTO inventario VALUES($codigobarra, '$cantidadpedido', '$fechapedido', '$fechaentrega', $lote,'$foto')";
					if (mysqli_query($conn, $sql)) {
						$_SESSION['statusQuery'] = 'success';
						$_SESSION['message'] = 'Usuario Adicionado con Exito!';
					} else {
						$_SESSION['statusQuery'] = 'danger';
						$_SESSION['message'] = 'El Usuario no se pudo Adicionar!';
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