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
<div>
    <img src="../recursos/logoPrincipal.png">
</div>

<form class="form-register" method="post">
    <h4>Formulario Registro</h4>
    <?php
      include "../php/controlador_registro.php";
    ?>
 
    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre">
    <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido">
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="text" name="username" id="username" placeholder="Ingrese su nombre de usuario">
    <input class="controls" type="password" name="password" id="password" placeholder="Ingrese su Contraseña">
    <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
    <input class="botons" type="submit" value="Registrar" name="registro" >
    <p><a href="../html/login.php">¿Ya tengo Cuenta?</a></p>
  </form>

</body>
</html>