<?php
session_start();
include '../config/connect.php';
if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $sql = "DELETE FROM pedido WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['statusQuery'] = 'success';
        $_SESSION['message'] = 'Pedido Eliminado con Éxito!';
    } else {
        $_SESSION['statusQuery'] = 'danger';
        $_SESSION['message'] = 'El Pedido no se pudo Eliminar!';
    }
    echo "<script> window.location.replace('../') </script>";
}
mysqli_close($conn);
