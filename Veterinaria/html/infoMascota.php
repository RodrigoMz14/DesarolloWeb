<?php
session_start();
if (empty($_SESSION["id"])){
    header("location: login.php");
}

$nombreUsuario = $_SESSION["nombre"] . " " . $_SESSION["apellido"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Veterinario de Pueblo Paleta</title>
    <link rel="stylesheet" href="../css/estilosInfoMascotas.css">
    <script language="javascript" src="../js/codigoMascotas.js"></script>
</head>

<body>
    <div id="divPrincipal">
        <header id="tituloMascota">
            <h2>Información sobre: <span id="nombMascota"> nombMascota 1</span></h2>
        </header>
        <div id="divContenedorInfo">
            <div id="divImgMascota">
                <img src="" width="">
            </div>
            <div id="divTablaInfoMascota">
                <table>
                    <tr>
                        <td> Nombre: </td>
                        <td id="infoMascota_Nombre">  </td>
                    </tr>
                    <tr>
                        <td> Edad: </td>
                        <td id="infoMascota_Edad">  </td>
                    </tr>
                    <tr>
                        <td> Sexo: </td>
                        <td id="infoMascota_Sexo">  </td>
                    </tr>
                    <tr>
                        <td> Especie: </td>
                        <td id="infoMascota_Especie">  </td>
                    </tr>
                    <tr>
                        <td> Raza: </td>
                        <td id="infoMascota_Raza">  </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="notasVet"> </div>
        <input id="descargar" type="button" value="Descargar">
    </div>
</body>

</html>