<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['link']) && isset($_POST['precio'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $titulo = validate($_POST['titulo']);
    $descripcion = validate($_POST['descripcion']);
    $link = validate($_POST['link']);
    $precio = validate($_POST['precio']);
    $estado = 1; // ID del rol que deseas asignar al usuario (puedes modificarlo según tus necesidades)

    if (empty($titulo)) {
        header("Location: realizarSolicitudes.php?error=El titulo no puede estar vacío.");
        exit();
    } elseif (empty($descripcion)) {
        header("Location: realizarSolicitudes.php?error=La descripcion no puede estar vacía.");
        exit();
    } elseif (empty($link)) {
        header("Location: realizarSolicitudes.php?error=El link no puede estar vacío.");
        exit();
    } elseif (empty($precio)) {
        header("Location: realizarSolicitudes.php?error=El precio no puede estar vacío.");
        exit();
    } else {
        $query = "SELECT * FROM Solicitud WHERE titulo = '$titulo'";
        $result = mysqli_query($condb, $query);

        if (mysqli_num_rows($result) > 0) {
            $query = "INSERT INTO Solicitud (titulo, descripcion, link, precio, estado) VALUES ('$titulo', '$descripcion', '$link', '$precio', '$estado')";
            if (mysqli_query($condb, $query)) {
                header("Location: Dashboard.php");
            } else {
                $error = "Error al insertar el usuario. Por favor, intenta nuevamente.";
                header("Location: realizarSolicitudes.php?error=" . urlencode($error));
                exit();
            }
        }
    }
} else {
    header("Location: Dashboard.php");
    exit();
}
?>






