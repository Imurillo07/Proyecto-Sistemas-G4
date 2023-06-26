<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['Usuario']) && isset($_POST['Password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['Usuario']);
    $Password = validate($_POST['Password']);
    
    if (empty($Usuario)) {
        header("Location:Login.php?error=El usuario no puede estar vacío.");
        exit();
    } elseif (empty($Password)) {
        header("Location:Login.php?error=La contraseña no puede estar vacía.");
        exit();
    } else {
        $Sql = "SELECT * FROM Usuarios WHERE Usuario = '$Usuario' AND Password = '$Password'";
        $result = mysqli_query($condb, $Sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['Usuario'] = $row['Usuario'];
            $_SESSION['Nombre_Completo'] = $row['Nombre_completo'];
            $_SESSION['Rol'] = $row['Rol'];

            header("Location:Dashboard.php");
            exit();
        } else {
            header("Location:Login.php?error=El usuario o la contraseña son incorrectos.");
            exit();
        }
    }
} else {
    header("Location:Login.php");
    exit();
}
?>

