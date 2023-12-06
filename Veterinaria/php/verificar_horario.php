<?php
include("../php/databaseConnection.php");
$fecha = $_GET['fecha'];

$hora_cita = "";

$query = $conexion->prepare("SELECT * FROM reservacionesmascota WHERE start = '$fecha'");
$query->execute();

$datos = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos as $dato){
         $hora_cita = $dato['hora_cita'];

         $horario = ['08:00 - 10:00','10:00 - 12:00','12:00 - 14:00','14:00 - 16:00','16:00 - 18:00','18:00 - 20:00'];
         for ( $i = 0; $i < 6; $i++ ){
            
            if($horario[$i] == $hora_cita){
                $num = $i + 1;
                $hora_res = "#btn_h".$num;
                echo "<script> $('$hora_res').attr('disabled',true); </script>";
            }
            
           
         }
    }

?>