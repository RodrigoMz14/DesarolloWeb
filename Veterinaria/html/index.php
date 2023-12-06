<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}

require('../php/generarTablaMascotas.php');
$nombreUsuario = $_SESSION["nombre"] . " " . $_SESSION["apellido"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Veterinario de Pueblo Paleta</title>
    <link rel="stylesheet" href="../css/estilosIndex.css">
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
                <li><a href="reservaciones.php">Citas</a></li>
                <li><a href="articulos.php">Artículos</a></li>
                <!-- Agrega un botón para cerrar sesión -->
                <li><a href="../php/controladorCerrarSesion.php" id="btnSalir" name="">Salir</a></li>
            </ul>
        </header>

        <div id="divContenedorInfo">
            <div id="divTablaMascotas">
                <?php generarTablaIndex(); ?>
            </div>
            <div id="divInfoGeneral">
                <div id="divArticulos">
                    Aquí se desplegarán algunos artículos de la veterinaria
                </div>
            </div>
        </div>

        <footer id="ContenedorInferior">
            <div id="menuInferior">
                <h2>Veterinaria</h2>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="mascotas.php">Mascotas</a></li>
                    <li><a href="reservaciones.php">Citas</a></li>
                    <li><a href="articulos.php">Artículos</a></li>
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