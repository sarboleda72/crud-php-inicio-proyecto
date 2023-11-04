<?php
include '../config/connect.php';
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $query = "SELECT correo, clave FROM usuarios WHERE correo='$usuario' AND clave='$clave';";
    //$query="SELECT correo, clave FROM usuarios WHERE correo='isabel@isabel.com' AND clave='cb37fd639c21c6f5093c'";
    $run = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($run);
    if (isset($row)) {
        if ($usuario == $row['correo'] && $clave == $row['clave']) {
            echo "<script>alert('Accedio');</script>";
            echo "<script>window.location.href='../index.php';</script>";
        } 
    }else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        echo "<script>window.location.href='../login.php';</script>";
    }
} else {
    echo "<script>alert('Complete todos los campos');</script>";
}
?>