<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $link = $_POST['link'];
    $precio = $_POST['precio'];

    $titulo = mysqli_real_escape_string($condb, $titulo);
    $link = mysqli_real_escape_string($condb, $link);
    $precio = mysqli_real_escape_string($condb, $precio);

    $estado = 1;

 
    $query = "INSERT INTO Solicitud (titulo, link, precio, estado) VALUES ('$titulo', '$link', '$precio', '$estado')";
    $result = mysqli_query($condb, $query);

    if ($result) {
        header("Location: Dashboard.php");
        exit();
    }
}
?>
