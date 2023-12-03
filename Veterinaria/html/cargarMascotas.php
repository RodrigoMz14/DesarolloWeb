<?php
include("../html/databaseConnection.php");
$idUsuarioRegistrado = 0;
$sqlMascotasUsuario = "SELECT idMascota, nombreMascota FROM mascotasdeusuario
                      WHERE idUsuario = :idUsuario";

$queryMascotasUsuario = $pdo->prepare($sqlMascotasUsuario);
$queryMascotasUsuario->bindParam(':idUsuario', $idUsuarioRegistrado, PDO::PARAM_INT);
$queryMascotasUsuario->execute();

$mascotasUsuario = $queryMascotasUsuario->fetchAll(PDO::FETCH_ASSOC);
?>