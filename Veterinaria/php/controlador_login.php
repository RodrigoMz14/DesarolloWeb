<?php
session_start();
require('databaseConnection.php');

if (!empty($_POST["btnIniciar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $username = $_POST["usuario"];
        $password = $_POST["password"];

        try {
            // Seleccionar solo la contraseña encriptada
            $stmt = $conexion->prepare("SELECT idUsuario, username, nombre, apellido, password FROM usuarios WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // Verificar la contraseña
                if (password_verify($password, $userData["password"])) {
                    // Contraseña válida, iniciar sesión
                    $_SESSION["id"] = $userData["idUsuario"];
                    $_SESSION["nombre"] = $userData["nombre"];
                    $_SESSION["apellido"] = $userData["apellido"];
                    header("location: index.php");
                } else {
                    // Contraseña incorrecta
                    echo "<div class='alert alert-danger'>Acceso denegado</div>";
                }
            } else {
                // Usuario no encontrado
                echo "<div class='alert alert-danger'>Usuario no encontrado</div>";
            }
        } catch (PDOException $e) {
            echo "Error de consulta: " . $e->getMessage();
        }
    } else {
        echo "Campos vacíos";
    }
}
?>
