<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Modificar Usuario </title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/fontawesome-all.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-info"> <i class="fa fa-pencil-alt"></i> Modificar Usuario </h1>
				<hr>
				<ol class="breadcrumb">
				  <li><a href="../">Inicio</a></li>
				  <li class="active">Modificar Usuario</li>
				</ol>
				<?php
					if(isset($_GET['id'])) {
						include '../config/connect.php';
						$id     = $_GET['id'];
						$sql    = "SELECT * FROM usuarios WHERE documento = $id";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($result)) {
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="number" class="form-control" name="documento" placeholder="Documento de Identidad" required readonly value="<?php echo $row['documento']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="nombres" placeholder="Nombre Completo" required value="<?php echo $row['nombres']; ?>">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required value="<?php echo $row['correo']; ?>">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="telefono" placeholder="Número Telefónico" required value="<?php echo $row['telefono']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="ciudad" placeholder="Ciudad" required value="<?php echo $row['ciudad']; ?>">
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="foto" accept="image/*">
						<button class="btn btn-default btn-foto"> <i class="fa fa-user"></i> Seleccione Foto de Perfil </button>
						<input type="hidden" name="url_foto" value="<?php echo $row['foto']; ?>">
					</div>
					<div class="form-group">
						<select name="genero" class="form-control" required>
							<option value="">Seleccione el Genero...</option>
							<option value="F" <?php if($row['genero'] == "F") echo "selected"; ?> >Femenino</option>
							<option value="M" <?php if($row['genero'] == "M") echo "selected"; ?> >Masculino</option>
							<option value="T" <?php if($row['genero'] == "T") echo "selected"; ?> >Transgenero</option>
						</select>
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
						$documento = mysqli_real_escape_string($conn, $_POST['documento']);
						$nombres   = mysqli_real_escape_string($conn, $_POST['nombres']);
						$correo    = mysqli_real_escape_string($conn, $_POST['correo']);
						$telefono  = mysqli_real_escape_string($conn, $_POST['telefono']);
						$ciudad    = mysqli_real_escape_string($conn, $_POST['ciudad']);
						$genero    = mysqli_real_escape_string($conn, $_POST['genero']);

						if ($_FILES['foto']['tmp_name']) {
							$url  = 'public/imgs/fotos/';
							$foto = $url.$_FILES['foto']['name'];
							if($_POST['url_foto'] != 'public/imgs/fotos/nofoto.png') {
								unlink('../'.$_POST['url_foto']);
							}
							move_uploaded_file($_FILES['foto']['tmp_name'], '../'.$url.$_FILES['foto']['name']);
							$sql = "UPDATE usuarios SET nombres = '$nombres', correo = '$correo', telefono = $telefono, ciudad = '$ciudad', foto = '$foto',genero = '$genero' WHERE documento = $documento";
						} else {
							$sql = "UPDATE usuarios SET nombres = '$nombres', correo = '$correo', telefono = $telefono, ciudad = '$ciudad', genero = '$genero' WHERE documento = $documento";
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