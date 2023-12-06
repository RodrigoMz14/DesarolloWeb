<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}
$idUsuario =  $_SESSION["id"];

require('../php/databaseConnection.php');

if (!empty($_POST["registro"])) {
    if (empty($_POST["nombre"]) or empty($_POST["edad"]) or empty($_POST["sexo"]) or empty($_POST["especie"]) or empty($_POST["raza"])) {
        echo 'Uno de los campos está vacío';
    } else {
        $nombre = $_POST["nombre"];
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];
        $especie = $_POST["especie"];
        $raza = $_POST["raza"];

        $sql = $conexion->prepare(
            "INSERT INTO mascotas(nombreMascota, Edad, Sexo, Especie, Raza) 
            VALUES (?, ?, ?, ?, ?)
            ;"
        );
        $sql->bindParam(1, $nombre);
        $sql->bindParam(2, $edad);
        $sql->bindParam(3, $sexo);
        $sql->bindParam(4, $especie);
        $sql->bindParam(5, $raza);

        if ($sql->execute()) {
/*
            $ultimoID = $conexion->LAST_INSERT_ID();

            try {
                //guarda la relación Usuario -> Mascota en la tabla mascotasporusuario
                $sql = $conexion->prepare(
                    "INSERT INTO mascotasporusuario (idUsuario, idMascota`) 
                    VALUES (?, ?)
                    ;"
                );
                $sql->bindParam(1, $idUsuario);
                $sql->bindParam(2, $ultimoID);
            } catch (PDOException $e) {
                echo "Error de consulta: " . $e->getMessage();
            }
*/
            echo 'Mascota agregada exitosamente, regresando al Login';
        } else {
            echo 'Error al registrar';
        }
    }
}
?>