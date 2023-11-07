<?php 
session_start();
include '../config/connect.php';
if (isset($_GET['id'])) {
	$id  = $_GET['id'];
	$sql = "DELETE FROM inventario WHERE codigobarra = $id";

	if (mysqli_query($conn, $sql)) {
		$_SESSION['statusQuery'] = 'success';
		$_SESSION['message'] = 'Usuario Eliminado con Exito!';
	} else {
		$_SESSION['statusQuery'] = 'danger';
		$_SESSION['message'] = 'El Usuario no se pudo Eliminar!';
	}
	echo "<script> window.location.replace('../') </script>";
}
mysqli_close($conn); 