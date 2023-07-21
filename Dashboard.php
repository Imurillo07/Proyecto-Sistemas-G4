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
                <a href="#" class="show-form" onclick="showForm('realizarSolicitudesForm')">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Realizar solicitudes</span>
                </a>
            </li>
            <li>
                <a href="#" >
                    <i class="fas fa-tasks"></i>
                    <span class="nav-item">Solicitudes en progreso</span>
                </a>
            </li>
            <li>
                <a href="#" >
                    <i class="fas fa-history"></i>
                    <span class="nav-item">Solicitudes realizadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 2): ?>
                <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRecibidasForm')">
                    <i class="fas fa-envelope"></i>
                    <span class="nav-item">Solicitudes recibidas</span>
                </a>
            </li>
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
                <a href="#" class="show-form" onclick="showForm('solicitudesDesaprobadasForm')">
                    <i class="fas fa-times-circle"></i>
                    <span class="nav-item">Solicitudes desaprobadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 3): ?>
            <li>
                <a href="#" >
                    <i class="fas fa-inbox"></i>
                    <span class="nav-item">Solicitudes entrantes</span>
                </a>
            </li>
            <li>
                <a href="#" >
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
                <a href="#" >
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

    <!-- Formularios -->
<!-- Formulario para crear la solicitud -->
<div class="forms-container">
    <div class="form-container">
        <form id="realizarSolicitudesForm" class="hidden-form" action="CrearSolicitud.php" method="post">
            <h2>Formulario Realizar Solicitudes</h2>
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="link" placeholder="Link">
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </div>

    <!-- Formulario para procesar la solicitud -->
    <div class="form-container">
        <form id="solicitudesRecibidasForm" class="hidden-form" action="ProcesarSolicitudFA.php" method="post">
            <h2>Solicitudes Recibidas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                include('Conexionbd.php');

                $query = "SELECT * FROM Solicitud WHERE estado = 1";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $id = $solicitud['id'];
                    $titulo = $solicitud['titulo'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<input type='hidden' name='solicitud_id' value='$id'>";
                    echo "<input type='submit' name='aprobar' value='Aprobar'>";
                    echo "<input type='submit' name='desaprobar' value='Desaprobar'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>

    <!-- Formulario para ver solicitudes desaprobadas -->
    <div class="form-container">
        <form id="solicitudesDesaprobadasForm" class="hidden-form">
            <h2>Solicitudes Desaprobadas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
                <?php
                $query = "SELECT * FROM Solicitud WHERE estado = 3";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $titulo = $solicitud['titulo'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>
</div>


    <script>
        function showForm(formId) {
            const forms = document.getElementsByClassName('hidden-form');
            for (let i = 0; i < forms.length; i++) {
                forms[i].style.display = 'none';
            }
            document.getElementById(formId).style.display = 'block';
        }
    </script>
</body>
</html>

