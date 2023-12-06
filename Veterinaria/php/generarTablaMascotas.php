<?php
if (empty($_SESSION["id"])){
    header("location: login.php");
}
require('../php/databaseConnection.php');

$nombreUsuario = $_SESSION["nombre"] . " " . $_SESSION["apellido"];

function generarTablaIndex() {

    require('../php/databaseConnection.php');
    $idUsuario =  $_SESSION["id"];
    try {
        $stmt = $conexion->prepare(
            "SELECT m.Imagen, m.idMascota 
            FROM mascotasporusuario mu 
            JOIN mascotas m on m.idMascota = mu.idMascota 
            WHERE mu.idUsuario  = :idUsuario
            ;"
        );
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();

        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contador = count($userData);

        echo "<table id=\"tablaMascotasAgregadas\">\n";
        echo "<tr><th id=\"encabezadoTabla\">Tus Mascotas</th></tr>\n";

        for($i = 0; $i < $contador; $i++){
            echo "<tr><th><img src=\"" .$userData[$i]["Imagen"] ."\" onclick=\"window.location.href = 'mascotas.php' \"></th></tr>\n";    
        }
        echo "</table>\n";
        
    } catch (PDOException $e) {
        echo "Error de consulta: " . $e->getMessage();
    }

}

function generarTabla() {

    require('../php/databaseConnection.php');
    $idUsuario =  $_SESSION["id"];
    try {
        $stmt = $conexion->prepare(
            "SELECT m.Imagen, m.idMascota 
            FROM mascotasporusuario mu 
            JOIN mascotas m on m.idMascota = mu.idMascota 
            WHERE mu.idUsuario  = :idUsuario
            ;"
        );
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();

        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contador = count($userData);

        echo "<table id=\"tablaMascotasAgregadas\">\n";
        echo "<tr><th id=\"encabezadoTabla\">Tus Mascotas</th></tr>\n";

        for($i = 0; $i < $contador; $i++){
            echo "<tr><th><img src=\"" .$userData[$i]["Imagen"] ."\" onclick=\"iniciarProceso('" .$userData[$i]["idMascota"]. "')\"></th></tr>\n";    
        }
        echo"<tr><th id=\"btnAgregarMascota\"> <input type=\"button\" value=\"Agregar Mascotas\" onclick=\"registrarMascota()\"></th></tr>\n";
        echo "</table>\n";
        
    } catch (PDOException $e) {
        echo "Error de consulta: " . $e->getMessage();
    }

}





?>