<?php

$dsn = 'mysql:host=localhost;dbname=veterinaria';
$username = 'root';
$password = '';

try {
    // Crear una instancia de PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configurar el modo de manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejar errores de conexión
    echo "Error de conexión: " . $e->getMessage();
}
?>