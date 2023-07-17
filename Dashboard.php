<?php
session_start();
include('Conexionbd.php');

if (!isset($_SESSION['Usuario'])) {
    header("Location: Login.php");
    exit();
}
$Usuario = $_SESSION['Usuario'];
$query = "SELECT Rol_Id FROM Usuarios WHERE Usuario = '$Usuario'";
$result = mysqli_query($condb, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $RolId = $row['Rol_Id'];
    $_SESSION['RolId'] = $RolId;
} else {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GOOFY</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="#" class="logo">
                    <img src="" alt="">
                    <span class="nav-item">Goofy</span>
                </a>
            </li>
            <?php if ($_SESSION['RolId'] == 1): ?>
            <li>
                <a href="#">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Realizar solicitudes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-tasks"></i>
                    <span class="nav-item">Solicitudes en progreso</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-history"></i>
                    <span class="nav-item">Solicitudes realizadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 2): ?>
            <li>
                <a href="#">
                    <i class="fas fa-envelope"></i>
                    <span class="nav-item">Solicitudes recibidas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-item">Solicitudes en proceso de aprobación financiera</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-check-circle"></i>
                    <span class="nav-item">Solicitudes aprobadas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-times-circle"></i>
                    <span class="nav-item">Solicitudes desaprobadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 3): ?>
            <li>
                <a href="#">
                    <i class="fas fa-inbox"></i>
                    <span class="nav-item">Solicitudes entrantes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-file-alt"></i>
                    <span class="nav-item">Reportes de solicitudes recibidas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-check-circle"></i>
                    <span class="nav-item">Solicitudes aceptadas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-times-circle"></i>
                    <span class="nav-item">Solicitudes rechazadas</span>
                </a>
            </li>
            <?php endif; ?>
            <li>
                <a href="Login.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>
