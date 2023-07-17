<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
    <form action="CrearCuenta.php" method="POST">
        <h1>Por favor, crea tu usuario.</h1>
        <hr>
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
        <hr>
        <i class="fas fa-user"></i>
        <label>Nombre Completo</label>
        <input type="text" name="Nombre_Completo" placeholder="Nombre completo">

        <i class="fas fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="Usuario" placeholder="Nombre de usuario" >

        <i class="fas fa-unlock"></i>
        <label>Contraseña</label>
        <input type="password" name="Password" placeholder="Contraseña">

      
        <hr>
        <button type="submit">Crear cuenta</button>
        <a href="Login.php">¿Ya tienes una cuenta? Inicia sesión.</a>
    </form>
</body>
</html>
