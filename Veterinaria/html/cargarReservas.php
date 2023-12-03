<?php

include("../html/databaseConnection.php");

$sql = "SELECT title,start,end FROM reservacionesdemascota";

$query = $pdo->prepare($sql);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>