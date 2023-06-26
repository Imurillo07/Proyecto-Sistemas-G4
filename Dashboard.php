<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un rol válido
if (!isset($_SESSION['Usuario']) || !isset($_SESSION['Rol'])) {
    header("Location: index.php");
    exit();
}

// Obtener el rol del usuario desde la sesión
$rol = $_SESSION['Rol'];

// Definir los botones según el rol del usuario
$botones = array();
if ($rol === 'administrador') {
    $botones[] = array('text' => 'Boton de admin 1', 'url' => 'accion1.php');
    $botones[] = array('text' => 'Boton de admin 2', 'url' => 'accion2.php');
    $botones[] = array('text' => 'Botón de admin 3', 'url' => 'accion3.php');
} elseif ($rol === 'usuario_regular') {
    $botones[] = array('text' => 'Boton de usuario 1', 'url' => 'accion4.php');
    $botones[] = array('text' => 'Boton de usuario 2', 'url' => 'accion5.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>GOOFY</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <link rel= "stylesheet" herf= "http://cdnjs.cloudfire.com/ajax/libs/font-awsome/5.15.4/css/all.min.css"/>
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="logo">
                    <img src="" alt="">
                    <span class="nav-item">Goofy</span>
                </a></li>
                <li><a href="Dashboard.php">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Home</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-wallet"></i>
                    <span class="nav-item">Wallet</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-item">Analytics</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-task"></i>
                    <span class="nav-item">Task</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-settings"></i>
                    <span class="nav-item">Settigs</span>
                </a></li>
                <li><a href="">
                    <i class="fas fa-questions"></i>
                    <span class="nav-item">Help</span>
                </a></li>
                <li><a href="" class="logout">
                    <i class="fas fa-sign-out"></i>
                    <span class="nav-item">Logout</span>
                </a></li>
            </ul>
        </nav>

        <section class="main">
            <div class="main-top">
                <h1>Bienvenido, <?php echo $_SESSION['Usuario']; ?></h1>

                    <?php

                    if (!empty($botones)) {
                        echo '<h2>Acciones disponibles:</h2>';
                        echo '<ul>';
                        foreach ($botones as $boton) {
                            echo '<li><a href="' . $boton['url'] . '">' . $boton['text'] . '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>No hay acciones disponibles para este usuario.</p>';
                    }
                    ?>

                    <a href="logout.php">Cerrar sesión</a>
            </div>
        </section>

    </div>
</body>
</html>
