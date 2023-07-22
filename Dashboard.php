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
                    <img src="logo.png" alt="">
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
                <a href="#" class="show-form" onclick="showForm('solicitudesPros')" >
                    <i class="fas fa-money-bill"></i>
                    <span class="nav-item">Solicitudes en proceso de aprobación financiera</span>
                </a>
            </li>
            <li>
            <a href="#" class="show-form" onclick="showForm('solicitudesAceptadas')">
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
                <a href="#" class="show-form" onclick="showForm('solicitudesRecibidasCont1')">
                    <i class="fas fa-inbox"></i>
                    <span class="nav-item">Solicitudes entrantes</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesAceptadas')">
                    <i class="fas fa-check-circle"></i>
                    <span class="nav-item">Solicitudes aceptadas</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRechazadas')">
                    <i class="fas fa-times-circle"></i>
                    <span class="nav-item">Solicitudes rechazadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 4): ?>
                <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRecibidasCont2')">
                    <i class="fas fa-inbox"></i>
                    <span class="nav-item">Solicitudes entrantes</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesAceptadas')">
                    <i class="fas fa-check-circle"></i>
                    <span class="nav-item">Solicitudes aceptadas</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRechazadas')">
                    <i class="fas fa-times-circle"></i>
                    <span class="nav-item">Solicitudes rechazadas</span>
                </a>
            </li>
            <?php elseif ($_SESSION['RolId'] == 5): ?>
                <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRecibidasCont3')">
                    <i class="fas fa-inbox"></i>
                    <span class="nav-item">Solicitudes entrantes</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesAceptadas')">
                    <i class="fas fa-check-circle"></i>
                    <span class="nav-item">Solicitudes aceptadas</span>
                </a>
            </li>
            <li>
                <a href="#" class="show-form" onclick="showForm('solicitudesRechazadas')">
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
            <input type="text" name="descripcion" placeholder="Descripción" required>
            <input type="text" name="link" placeholder="Link">
            <input type="text" pattern="[0-9]{1,7}" name="precio" placeholder="Precio deseado (hasta 7 dígitos)" required>
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
                    <th>Descripcion</th>
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
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='text' name='razon' placeholder='Razón del rechazo' value='$razon'>";
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
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Razon</th>
                </tr>
                <?php
                $query = "SELECT * FROM Solicitud WHERE estado = 3";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>$razon</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>

     <!-- Formulario para ver solicitudes en proceso -->
    <div class="form-container">
    <form id="solicitudesPros" class="hidden-form">
            <h2>Solicitudes en Proceso</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
                <?php
                $query = "SELECT * FROM Solicitud WHERE estado = 4";
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
    
 <!-- Formulario para ver solicitudes recibidas para el contador financiero de nivel 1 -->
    <div class="form-container">
        <form id="solicitudesRecibidasCont1" class="hidden-form" action="ProcesarSolicitudesFin.php" method="post">
            <h2>Solicitudes Recibidas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                include('Conexionbd.php');

                $query = "SELECT * FROM Solicitud WHERE estado = 4 AND precio < 500000";

                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $id = $solicitud['id'];
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='text' name='razon' placeholder='Razón del rechazo o aceptacion' value='$razon'>";
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
     <!-- Formulario para ver solicitudes recibidas para el contador financiero de nivel 2 -->
     <div class="form-container">
        <form id="solicitudesRecibidasCont2" class="hidden-form" action="ProcesarSolicitudesFin.php" method="post">
            <h2>Solicitudes Recibidas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                include('Conexionbd.php');

                $query = "SELECT * FROM Solicitud WHERE estado = 4 AND precio >= 500000 AND precio <= 999999";

                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $id = $solicitud['id'];
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='text' name='razon' placeholder='Razón del rechazo o aceptacion' value='$razon'>";
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
     <!-- Formulario para ver solicitudes recibidas para el contador financiero de nivel 3 -->
     <div class="form-container">
        <form id="solicitudesRecibidasCont3" class="hidden-form" action="ProcesarSolicitudesFin.php" method="post">
            <h2>Solicitudes Recibidas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                include('Conexionbd.php');
                $query = "SELECT * FROM Solicitud WHERE estado = 4 AND precio >= 1000000";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $id = $solicitud['id'];
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='text' name='razon' placeholder='Razón del rechazo o aceptacion' value='$razon'>";
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
    <!-- Formulario para ver solicitudes Aceptadas -->
    <div class="form-container">
        <form id="solicitudesAceptadas" class="hidden-form">
            <h2>Solicitudes Aceptadas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Razon</th>
                </tr>
                <?php
                $query = "SELECT * FROM Solicitud WHERE estado = 2";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>$razon</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>
    <!-- Formulario para ver solicitudes rechazadas -->
    <div class="form-container">
        <form id="solicitudesRechazadas" class="hidden-form">
            <h2>Solicitudes Rechazadas</h2>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripcion</th>
                    <th>Link</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Razon</th>
                </tr>
                <?php
                $query = "SELECT * FROM Solicitud WHERE estado = 3";
                $result = mysqli_query($condb, $query);

                while ($solicitud = mysqli_fetch_assoc($result)) {
                    $titulo = $solicitud['titulo'];
                    $descripcion = $solicitud['descripcion'];
                    $link = $solicitud['link'];
                    $precio = $solicitud['precio'];
                    $estado = $solicitud['estado'];
                    $razon = $solicitud['razon'];

                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$descripcion</td>";
                    echo "<td>$link</td>";
                    echo "<td>$precio</td>";
                    echo "<td>$estado</td>";
                    echo "<td>$razon</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>

</div>
<!--Scripts para esconder formularios y limitar espacio-->

    <script>
        function showForm(formId) {
            const forms = document.getElementsByClassName('hidden-form');
            for (let i = 0; i < forms.length; i++) {
                forms[i].style.display = 'none';
            }
            document.getElementById(formId).style.display = 'block';
        }
    </script>


<script>
    const precioInput = document.querySelector('input[name="precio"]');
    precioInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').substring(0, 7);
    });
</script>


</body>
</html>

