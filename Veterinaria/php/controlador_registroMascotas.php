<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
}

$idUsuario = $_SESSION["id"];
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

        // Procesar la imagen
        $imagen = $_FILES["imagen"];
        $imagenNombre = $imagen["name"];
        $imagenTipo = $imagen["type"];
        $imagenTamanio = $imagen["size"];
        $imagenTmp = $imagen["tmp_name"];

        if (exif_imagetype($imagenTmp)) {
            // Guardar la imagen en una carpeta en tu servidor
            $carpetaDestino = "../recursos/";
            $rutaImagen = $carpetaDestino . $imagenNombre;
            move_uploaded_file($imagenTmp, $rutaImagen);

            try {
                $conexion->beginTransaction();
    
                $sql1 = $conexion->prepare(
                    "INSERT INTO mascotas(nombreMascota, Edad, Sexo, Especie, Raza, Imagen) 
                    VALUES (?, ?, ?, ?, ?, ?)"
                );
                $sql1->bindParam(1, $nombre);
                $sql1->bindParam(2, $edad);
                $sql1->bindParam(3, $sexo);
                $sql1->bindParam(4, $especie);
                $sql1->bindParam(5, $raza);
                $sql1->bindParam(6, $rutaImagen);
                $sql1->execute();
    
                // Obtener el último ID insertado
                $ultimoID = $conexion->lastInsertId();
    
                $sql2 = $conexion->prepare("INSERT INTO mascotasporusuario (idUsuario, idMascota) VALUES (?, ?)");
                $sql2->bindParam(1, $idUsuario);
                $sql2->bindParam(2, $ultimoID);
                $sql2->execute();
    
                $conexion->commit();
                echo 'Mascota agregada exitosamente';
            } catch (PDOException $e) {
                $conexion->rollBack();
                echo 'Error al insertar datos: ' . $e->getMessage();
            }

        }

        
    }
}
?>