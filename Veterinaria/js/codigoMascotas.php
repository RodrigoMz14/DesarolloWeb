<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}

$idMascota = $_POST['valor'];

require('../php/databaseConnection.php');
$idUsuario =  $_SESSION["id"];

try {

    $stmt = $conexion->prepare(
        "SELECT m.nombreMascota, m.Edad, m.Sexo, m.Especie, m.Raza, m.Imagen, m.NotasVet
        FROM mascotasporusuario mu
        JOIN mascotas m on m.idMascota = mu.idMascota
        WHERE mu.idMascota = :idMascota
        ;"
    );
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
    
    $_SESSION['datosMascota'] = $datosMascota;
    
    // Convertir el array a formato JSON
    $datosJSON = json_encode($datosMascota);
    
    // Imprimir el JSON
    echo $datosJSON;

} catch (PDOException $e) {
    echo "Error de consulta: " . $e->getMessage();
}
?>