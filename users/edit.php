<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Modificar Inventario </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-pencil-alt"></i> Modificar Inventario </h1>
				<hr>
				<ol class="breadcrumb">
				  <li><a href="../">Inicio</a></li>
				  <li class="active">Modificar Inventario</li>
				</ol>
				<?php
					if(isset($_GET['id'])) {
						include '../config/connect.php';
						$id     = intval($_GET['id']);
						$sql    = "SELECT * FROM inventario WHERE codigobarra = $id";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($result)) {
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="number" class="form-control" name="codigobarra" placeholder="Codigo de barra" required readonly value="<?php echo $row['codigobarra']; ?>">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required value="<?php echo $row['cantidad']; ?>">
					</div>
					<div class="form-group">
						<label >Fecha de entrada</label>
						<input type="date" class="form-control" name="fechaentrada" placeholder="" required value="<?php echo $row['fechaentrada']; ?>">
					</div>
					<div class="form-group">
						<label>Fecha salida</label>
						<input type="date" class="form-control" name="fehcasalida" placeholder="" required value="<?php echo $row['fehcasalida']; ?>">
					</div>
					<div class="form-group">
						<label>Lote</label>
						<input type="number" class="form-control" name="lote" placeholder="Ciudad" required value="<?php echo $row['lote']; ?>">
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="foto" accept="image/*">
						<button class="btn btn-default btn-foto"> <i class="fa fa-user"></i> Seleccione Foto de Perfil </button>
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
						$codigobarra = mysqli_real_escape_string($conn, $_POST['codigobarra']);
						$cantidad   = mysqli_real_escape_string($conn, $_POST['cantidad']);
						$fechaentrada    = mysqli_real_escape_string($conn, $_POST['fechaentrada']);
						$fehcasalida  = mysqli_real_escape_string($conn, $_POST['fehcasalida']);
						$lote    = mysqli_real_escape_string($conn, $_POST['lote']);

						if ($_FILES['foto']['tmp_name']) {
							$url  = 'public/imgs/fotos/';
							$foto = $url.$_FILES['foto']['name'];
							if($_POST['url_foto'] != 'public/imgs/fotos/nofoto.png') {
								unlink('../'.$_POST['url_foto']);
							}
							move_uploaded_file($_FILES['foto']['tmp_name'], '../'.$url.$_FILES['foto']['name']);
							$sql = "UPDATE inventario SET lote = '$lote', cantidad = '$cantidad', fechaentrada = '$fechaentrada', fehcasalida = '$fehcasalida', foto = '$foto' WHERE codigobarra = $codigobarra";
						} else {
							$sql = "UPDATE inventario SET cantidad = '$cantidad', fechaentrada = '$fechaentrada', fehcasalida = '$fehcasalida', lote = '$lote'WHERE codigobarra = $codigobarra";
						}

						if (mysqli_query($conn, $sql)) {
							$_SESSION['statusQuery'] = 'success';
							$_SESSION['message'] = 'Usuario Modificado con Exito!';
						} else {
							$_SESSION['statusQuery'] = 'danger';
							$_SESSION['message'] = 'El Usuario no se pudo Modificar!';
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