<?php
    session_start();
    require("../php/databaseConnection.php");

    $idMascota = $_POST["mascota"];
    $idUsuario = $_SESSION["id"];
    $fechaInicio = $_POST["fecha"];
    $fechaFinal = $_POST["fecha"];
    $horaCita = $_POST["hora"];
    $servicio = $_POST["servicio"];

    

    $sql = $conexion->prepare("INSERT INTO reservacionesmascota(hora_cita,title,start,end,idMascota,idUsuario) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bindParam(1, $horaCita);
    $sql->bindParam(2, $servicio);
    $sql->bindParam(3, $fechaInicio);
    $sql->bindParam(4, $fechaFinal);
    $sql->bindParam(5, $idMascota);
    $sql->bindParam(6, $idUsuario);
    
    $sql->execute();

    header("location:../html/reservaciones.php");
?>