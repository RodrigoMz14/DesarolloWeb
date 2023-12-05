<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}

$idMascota = $_POST['valor'];

require('../php/databaseConnection.php');
$idUsuario =  $_SESSION["id"];

try {
    $stmt = $conexion->prepare("SELECT nombreMascota, Edad, Sexo, Especie, Raza, Imagen, NotasVet FROM mascotasdeusuario WHERE idMascota = :idMascota");
    $stmt->bindParam(':idMascota', $idMascota);
    $stmt->execute();
    $petData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Generar datos como un array asociativo
    $datosMascota = array(
        'nombreMascota' => $petData[0]["nombreMascota"],
        'Edad' => $petData[0]["Edad"],
        'Sexo' => $petData[0]["Sexo"],
        'Especie' => $petData[0]["Especie"],
        'Raza' => $petData[0]["Raza"],
        'Imagen' => $petData[0]["Imagen"],
        'NotasVet' => $petData[0]["NotasVet"]
    );
    
    // Convertir el array a formato JSON
    $datosJSON = json_encode($datosMascota);
    
    // Imprimir el JSON
    echo $datosJSON;

} catch (PDOException $e) {
    echo "Error de consulta: " . $e->getMessage();
}
?>