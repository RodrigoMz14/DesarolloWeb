<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/estiloRegistro.css">
  <title>Formulario Registro</title>

</head>
<body>

<form class="form-register" method="post" enctype="multipart/form-data">
    <h4>Formulario Registro</h4>
    <?php include "../php/controlador_registroMascotas.php"; ?>
 
    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese el Nombre de su Mascota">
    <input class="controls" type="text" name="edad" id="edad" placeholder="Ingrese la edad de su Mascota">
    <input class="controls" type="text" name="sexo" id="sexo" placeholder="Ingrese el sexo de su Mascota">
    <input class="controls" type="text" name="especie" id="especie" placeholder="Ingrese la especie de su Mascota">
    <input class="controls" type="text" name="raza" id="raza" placeholder="Ingrese la raza de su Mascota">

    <!-- Nuevo campo para la imagen -->
    <input class="controls" type="file" name="imagen" id="imagen" accept="image/*">

    <input class="botons" type="submit" value="Registrar" name="registro" >
  </form>

</body>
</html>