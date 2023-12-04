<?php
// conexion.php

$servername = "localhost";
$dbname = "veterinaria";
$dbusername = "root";
$dbpassword = "";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>