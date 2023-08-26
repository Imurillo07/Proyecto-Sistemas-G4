<?php
session_start();
include('Conexionbd.php');

if (!isset($_SESSION['Usuario'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_SESSION['Usuario'];

    if (isset($_POST['aprobar'])) {
        $solicitud_id = $_POST['solicitud_id'];
        $query = "UPDATE Solicitud SET estado = 2, aprobadorF_id = (SELECT Id FROM Usuarios WHERE Usuario = '$nombre_usuario') WHERE id = $solicitud_id";
        mysqli_query($condb, $query);
    } elseif (isset($_POST['desaprobar'])) {
        $solicitud_id = $_POST['solicitud_id'];
        $razon = $_POST['razon'];
        $query = "UPDATE Solicitud SET estado = 3, razon = ?, aprobadorF_id = (SELECT Id FROM Usuarios WHERE Usuario = '$nombre_usuario') WHERE id = ?";
        $stmt = mysqli_prepare($condb, $query);
        mysqli_stmt_bind_param($stmt, "si", $razon, $solicitud_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: Dashboard.php");
    exit();
}
?>
