<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $precio = $_POST['precio'];
    $razon = $_POST['razon'];

    $titulo = mysqli_real_escape_string($condb, $titulo);
    $descripcion = mysqli_real_escape_string($condb, $descripcion);
    $link = mysqli_real_escape_string($condb, $link);
    $precio = mysqli_real_escape_string($condb, $precio);
    $razon = mysqli_real_escape_string($condb, $razon);

    $estado = 1;

 
    $query = "INSERT INTO Solicitud (titulo, descripcion, link, precio, estado, razon) VALUES ('$titulo', '$descripcion', '$link', '$precio', '$estado', '$razon')";
    $result = mysqli_query($condb, $query);

    if ($result) {
        header("Location: Dashboard.php");
        exit();
    }
}
?>
