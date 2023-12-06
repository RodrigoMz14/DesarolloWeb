<?php

// * * * * 
session_start();
if ($_SESSION["valido"] != true) {
	 header("location: index.php?estado=4");
	 exit();
}	
// * * * * 

$datosMascota = $_SESSION['datosMascota'];

$archivo = "Informacion_" . $datosMascota['nombreMascota']. ".doc";

$documento = "<html><body>";
$documento .= "<h1>Nombre Mascota: " . $datosMascota['nombreMascota'] . "</h1>";

$documento .= "</br>";

$documento .= "<table style=\" border: 1px solid #dddddd; padding: 4px; background-color: #f2f2f2; font-family: Arial, sans-serif; font-size: 12px;\">";
$documento .= "<tr><th style=\" text-align: left; \">Edad</th><th style=\" text-align: left; \">" . $datosMascota['Edad'] . "</th></tr>\r\n";
$documento .= "<tr><th style=\" text-align: left; \">Sexo</th><th style=\" text-align: left; \">" . $datosMascota['Sexo'] . "</th></tr>\r\n";
$documento .= "<tr><th style=\" text-align: left; \">Especie</th><th style=\" text-align: left; \">" . $datosMascota['Especie'] . "</th></tr>\r\n";
$documento .= "<tr><th style=\" text-align: left; \">Raza</th><th style=\" text-align: left; \">" . $datosMascota['Raza'] . "</th></tr>\r\n";
$documento .="</table>\r\n";

$documento .= "</br>";

$documento .= "<p><b>Notas del veterinario: </b></p>\r\n";
$documento .= "<p>" . $datosMascota['NotasVet'] . "</p>\r\n";

$documento .="</body></html>";

header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"{$archivo}\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

print $documento;

?>