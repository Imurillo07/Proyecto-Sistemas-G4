<?php
session_start();
include('Conexionbd.php');

if (isset($_POST['Nombre_Completo']) && isset($_POST['Usuario']) && isset($_POST['Password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Nombre_Completo = validate($_POST['Nombre_Completo']);
    $Usuario = validate($_POST['Usuario']);
    $Password = validate($_POST['Password']);
    $RolId = 1; // ID del rol que deseas asignar al usuario (puedes modificarlo según tus necesidades)

    if (empty($Nombre_Completo)) {
        header("Location: CrearUsuario.php?error=El nombre completo no puede estar vacío.");
        exit();
    } elseif (empty($Usuario)) {
        header("Location: CrearUsuario.php?error=El usuario no puede estar vacío.");
        exit();
    } elseif (empty($Password)) {
        header("Location: CrearUsuario.php?error=La contraseña no puede estar vacía.");
        exit();
    } else {
        $query = "SELECT * FROM Usuarios WHERE Usuario = '$Usuario'";
        $result = mysqli_query($condb, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = "El usuario ya existe.";
            header("Location: CrearUsuario.php?error=" . urlencode($error));
            exit();
        } else {
            $query = "INSERT INTO Usuarios (Nombre_Completo, Usuario, Password, Rol_Id) VALUES ('$Nombre_Completo', '$Usuario', '$Password', '$RolId')";
            if (mysqli_query($condb, $query)) {
                header("Location: Login.php");
            } else {
                $error = "Error al insertar el usuario. Por favor, intenta nuevamente.";
                header("Location: CrearUsuario.php?error=" . urlencode($error));
                exit();
            }
        }
    }
} else {
    header("Location: Login.php");
    exit();
}
?>






