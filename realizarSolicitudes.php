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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Realizar Solicitudes</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
    <div>
        <nav>
            <ul>
                <li>
                    <a href="Dashboard.php" class="logo">
                        <img src="" alt="">
                        <span class="nav-item">Goofy</span>
                    </a>
                </li>
                <?php if ($_SESSION['RolId'] == 1): ?>
                <li>
                    <a href="realizarsolicitudes.php">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Realizar solicitudes</span>
                    </a>
                </li>
                <li>
                    <a href="solprojefe.php">
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
        
        <section class="solicitudes">
            <div class="sol-top">
                <form action="rsolicitud.php" method="POST">
                    <label for="titulo">Título del producto:</label>
                    <?php 
                    if(isset($_GET['error'])){  
                    ?>
                    <p class="error">
                    <?php 
                    echo $_GET['error'];
                    ?>
                    </p>
                    <?php
                    }
                    ?>
                    <input type="text" id="titulo" name="titulo" required>

                    <label for="descripcion">Descripción del producto:</label>
                    <input id="descripcion" name="descripcion" rows="4" required></input>

                    <label for="link">Enlace del producto:</label>
                    <input type="text" id="link" name="link" required>

                    <label for="precio">Precio del producto:</label>
                    <input type="number" id="precio" name="precio" step="0.01" required>

                    <input type="submit" value="Enviar">
                </form>
            </div>
        </section>
    </div>
</body>
</html>