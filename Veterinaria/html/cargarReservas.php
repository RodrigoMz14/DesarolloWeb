<?php

include("../php/databaseConnection.php");

$sql = "SELECT title,start,end FROM reservacionesmascota";

$query = $conexion->prepare($sql);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>