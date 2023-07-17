<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesion</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
    <form action="IniciarSesion.php" method="POST">
    <h1>Bienvenido, por favor ingrese su usuario.</h1>
    <hr>
    <?php 
    if(isset($_GET['error'])){  
        ?>
        <p class="error">
        <?php 
        echo $_GET['error']
        ?>
        </p>
    <?php
        }
    ?>
    <hr>
    <i class="fa-solid fa-user"></i>
    <label>Usuarios</label>
    <input type="text" name="Usuario" placeholder="Nombre de usuario" >

    <i class="fa-solid fa-unlock"></i>
    <label>Password</label>
    <input type="text" name="Password" placeholder="Contrasena">
    <hr>
    <button type="submit">Iniciar sesion</button>
    <a href="CrearUsuario.php">No tienes usuario? Crea uno.</a>
    </form>
</body>
</html>