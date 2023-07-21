<?php
session_start();
include('Conexionbd.php');

if (!isset($_SESSION['Usuario'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aprobar'])) {
        $solicitud_id = $_POST['solicitud_id'];
        $razon = null;
        $query = "UPDATE Solicitud SET estado = 4 WHERE id = $solicitud_id";
        mysqli_query($condb, $query);
    } elseif (isset($_POST['desaprobar'])) {
        $solicitud_id = $_POST['solicitud_id'];
        $razon = $_POST['razon'];
        $query = "UPDATE Solicitud SET estado = 3, razon = '$razon' WHERE id = $solicitud_id";
        mysqli_query($condb, $query);
    }

    
    header("Location: Dashboard.php");
    exit();
}
?>
