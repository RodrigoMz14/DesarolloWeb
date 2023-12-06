<?php
include("../php/databaseConnection.php");
$sqlMascotasUsuario = "SELECT Mascotas.idMascota, Mascotas.nombreMascota
    FROM Mascotas
    JOIN MascotasPorUsuario ON Mascotas.idMascota = MascotasPorUsuario.idMascota
    WHERE MascotasPorUsuario.idUsuario = :idUsuario";

$queryMascotasUsuario = $conexion->prepare($sqlMascotasUsuario);
$queryMascotasUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$queryMascotasUsuario->execute();

$mascotasUsuario = $queryMascotasUsuario->fetchAll(PDO::FETCH_ASSOC);
?>