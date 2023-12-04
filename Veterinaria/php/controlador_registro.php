<?php
require('databaseConnection.php');

if (!empty($_POST["registro"])) {
    if (empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["correo"]) or empty($_POST["username"]) or empty($_POST["password"])) {
        echo 'Uno de los campos está vacío';
    } else {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Encriptar la contraseña usando bcrypt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = $conexion->prepare("INSERT INTO usuarios(nombre, apellido, correo, username, password) VALUES (?, ?, ?, ?, ?)");
        $sql->bindParam(1, $nombre);
        $sql->bindParam(2, $apellido);
        $sql->bindParam(3, $correo);
        $sql->bindParam(4, $username);
        $sql->bindParam(5, $hashedPassword);

        if ($sql->execute()) {
            echo 'Usuario registrado correctamente, regresando al Login';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 3000);
                  </script>';
        } else {
            echo 'Error al registrar';
        }
    }
}
?>