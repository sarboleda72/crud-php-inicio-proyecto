<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Modificar Pedido </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>
<body>
	<div class	="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-pencil-alt"></i> Modificar Pedido </h1>
				<hr>
				<ol class="breadcrumb">
				  <li><a href="../">Inicio</a></li>
				  <li class="active">Modificar Pedido</li>
				</ol>
				<?php
					if(isset($_GET['id'])) {
						include '../config/connect.php';
						$id     = intval($_GET['id']);
						$sql    = "SELECT * FROM pedido WHERE id = $id";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($result)) {
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="number" class="form-control" name="id" placeholder="ID" required readonly value="<?php echo $row['id']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="nombrearticulo" placeholder="Nombre del Artículo" required value="<?php echo $row['nombrearticulo']; ?>">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="cantidadpedido" placeholder="Cantidad del Pedido" required value="<?php echo $row['cantidadpedido']; ?>">
					</div>
					<div class="form-group">
						<label>Fecha de Pedido</label>
						<input type="date" class="form-control" name="fechapedido" required value="<?php echo $row['fechapedido']; ?>">
					</div>
					<div class="form-group">
						<label>Fecha de Entrega</label>
						<input type="date" class="form-control" name="fechaentrega" required value="<?php echo $row['fechaentrega']; ?>">
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="foto" accept="image/*">
						<button class="btn btn-default btn-foto"> <i class="fa fa-image"></i> Seleccione Foto del Pedido </button>
						<input type="hidden" name="url_foto" value="<?php echo $row['foto']; ?>">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Modificar </button>
						<button type="reset" class="btn btn-default"> <i class="fa fa-sync-alt"></i> Limpiar </button>
					</div>
				</form>
				<?php 
						}
					} 
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$id = mysqli_real_escape_string($conn, $_POST['id']);
						$nombrearticulo = mysqli_real_escape_string($conn, $_POST['nombrearticulo']);
						$cantidadpedido = mysqli_real_escape_string($conn, $_POST['cantidadpedido']);
						$fechapedido = mysqli_real_escape_string($conn, $_POST['fechapedido']);
						$fechaentrega = mysqli_real_escape_string($conn, $_POST['fechaentrega']);

						if ($_FILES['foto']['tmp_name']) {
							$url  = 'public/imgs/fotos/';
							$foto = $url.$_FILES['foto']['name'];
							if($_POST['url_foto'] != 'public/imgs/fotos/nofoto.png') {
								unlink('../'.$_POST['url_foto']);
							}
							move_uploaded_file($_FILES['foto']['tmp_name'], '../'.$url.$_FILES['foto']['name']);
							$sql = "UPDATE pedido SET nombrearticulo = '$nombrearticulo', cantidadpedido = '$cantidadpedido', fechapedido = '$fechapedido', fechaentrega = '$fechaentrega', foto = '$foto' WHERE id = $id";
						} else {
							$sql = "UPDATE pedido SET nombrearticulo = '$nombrearticulo', cantidadpedido = '$cantidadpedido', fechapedido = '$fechapedido', fechaentrega = '$fechaentrega' WHERE id = $id";
						}

						if (mysqli_query($conn, $sql)) {
							$_SESSION['statusQuery'] = 'success';
							$_SESSION['message'] = 'Pedido Modificado con Éxito!';
						} else {
							$_SESSION['statusQuery'] = 'danger';
							$_SESSION['message'] = 'El Pedido no se pudo Modificar!';
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
