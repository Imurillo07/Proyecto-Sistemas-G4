<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['submit'])) {
   
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $precio = $_POST['precio'];
    $estado = 1; 
    $razon = ""; 

  
    $nombreUsuario = $_SESSION['Usuario']; 

    
    $titulo = mysqli_real_escape_string($condb, $titulo);
    $descripcion = mysqli_real_escape_string($condb, $descripcion);
    $link = mysqli_real_escape_string($condb, $link);
    $precio = mysqli_real_escape_string($condb, $precio);

    // Inserción con el nombre de usuario y los demás valores
    $query = "INSERT INTO Solicitud (titulo, descripcion, link, precio, estado, razon, usuario_id) VALUES ('$titulo', '$descripcion', '$link', '$precio', '$estado', '$razon', (SELECT Id FROM Usuarios WHERE Usuario = '$nombreUsuario'))";

    $result = mysqli_query($condb, $query);

    if ($result) {
        header("Location: Dashboard.php");
        exit();
    } else {
        echo "Error al insertar solicitud: " . mysqli_error($condb);
    }
}
?>

