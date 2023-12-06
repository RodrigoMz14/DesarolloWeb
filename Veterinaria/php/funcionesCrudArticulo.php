<?php

include('databaseConnection.php');

// Recibir datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $tipoAnimal = $_POST['tipoAnimal'] ?? '';

    if (isset($_FILES['File_imagen']) && $_FILES['File_imagen']['error'] === UPLOAD_ERR_OK) {
        // Llamar a la función de inserción y guardar la imagen
        $url_imagen = getUrlImagen($_FILES['File_imagen']['name']);
        $decodedImage = decodificarImagen($_FILES['File_imagen']['tmp_name']);
        insertarArticulo($nombre, $descripcion, $cantidad, $precio, $url_imagen, $edad, $categoria, $tipoAnimal);
        file_put_contents($url_imagen, $decodedImage); 
    } else {
        echo "Error al subir el archivo.";
    }
}


// Función para insertar un nuevo artículo en la base de datos
function insertarArticulo($nombre, $descripcion, $cantidad, $precio, $url_imagen, $edad, $categoria, $tipoAnimal) {
    global $pdo;

    try {

        // Verificar si la URL de la imagen ya contiene la ruta completa
        if (strpos($url_imagen, '../recursos/articulos/') === false) {
            // Si no contiene la ruta completa, agregarla
            $url_imagen = '../recursos/articulos/' . $url_imagen;
        }
        $stmt = $pdo->prepare("INSERT INTO articulo (nombre, descripcion, cantidad, precio, url_imagen, edad, categoria, tipoAnimal) 
        VALUES (:nombre, :descripcion, :cantidad, :precio, :url_imagen, :edad, :categoria, :tipoAnimal)");

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':url_imagen', $url_imagen);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':tipoAnimal', $tipoAnimal);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        // Manejar errores de inserción
        echo "Error al insertar el artículo: " . $e->getMessage();
        return false;
    }
}

function getUrlImagen($imagen){
    // Generar un nombre único para la imagen
    $imageName = uniqid() . '.jpg';

    // Ruta de guardado en la carpeta "recursos"
    $rutaGuardado = '../recursos/articulos/' . $imageName;

    // Retornar la ruta de la imagen guardada
    return $rutaGuardado;
}

function decodificarImagen($imagen) {
    // Leer el contenido del archivo
    $decodedImage = file_get_contents($imagen);

    return $decodedImage;
}
