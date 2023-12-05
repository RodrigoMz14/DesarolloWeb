<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}
require('../php/databaseConnection.php');

$nombreUsuario = $_SESSION["nombre"] . " " . $_SESSION["apellido"];

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
        echo "</table>\n";
        
    } catch (PDOException $e) {
        echo "Error de consulta: " . $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Veterinario de Pueblo Paleta</title>
    <link rel="stylesheet" href="../css/estilosMascotas.css">
    <script language="javascript" src="../js/codigoMascotas.js"></script>
</head>
<body>
    <div id="divPrincipal">
        <div>

        </div>
        <header id="ContenedorMenu">
            <!-- Agrega un espacio para mostrar el nombre del usuario -->
            <span id="nombreUsuario">
                <?php
                echo "Bienvenid@ ". $nombreUsuario;
                ?>
            </span>
            <ul class="ajustarMenuBarra">
                <li id="botonImg"><a href="Index.php"><img src="../recursos/logoPrincipal.png" alt="Logo del Hospital Veterinario" id="imgLogo"></a></li>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="mascotas.php">Mascotas</a></li>
                <li><a href="">Citas</a></li>
                <li><a href="articulos.html">Artículos</a></li>
                <li><a href="">Sucursales</a></li>
                <li><a href="">Contacto</a></li>
                <li><a href="">Cuenta</a></li>
                <!-- Agrega un botón para cerrar sesión -->
                <li><a href="../php/controladorCerrarSesion.php" id="btnSalir" name="">Salir</a></li>
            </ul>
        </header>

        <div id="divContenedorInfo">
            <div id="divTablaMascotas">
                <?php generarTabla(); ?>
            </div>
            <div id="divInfoMascotas">
                <img src="../recursos/fondoMascotas.jpg">
            </div>
        </div>

        <footer id="ContenedorInferior">
            <div id="menuInferior">
                <h2>Veterinaria</h2>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="mascotas.php">Mascotas</a></li>
                    <li><a href="">Citas</a></li>
                    <li><a href="articulos.html">Artículos</a></li>
                    <li><a href="">Sucursales</a></li>
                    <li><a href="">Contacto</a></li>
                    <li><a href="">Cuenta</a></li>
                </ul>
            </div>
            <div id="infoContacto">
                <h2>Contáctanos (Atención al Cliente)</h2>
                <ul>
                    <li>e-mail:<a href="mailto:clientes_duda@vet.com.mx"> clientes_duda@vet.com.mx</a></li>
                    <li>Tel: 9991014169</li>
                    <li>Fax: 9991014169</li>
                </ul>
            </div>
            <div id="redesSociales">
                <h2>¡Síguenos en nuestras redes sociales!</h2>
                <a href="https://twitter.com/LeagueOfLegends"><img src="../recursos/x.png" alt="X"></a>
                <a href="https://www.instagram.com/nintendoamerica"><img src="../recursos/instagram.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="../recursos/facebook.png" alt="Facebook"></a>
            </div>
        </footer>
    </div>
</body>
</html>