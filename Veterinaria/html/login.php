<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/estiloLogin.css">
</head>
<body>
    <div>
        <img src="../recursos/logoPrincipal.png"></img>
    </div>
    <?php
    include "../php/controlador_login.php";
    ?>


    <div class="formulario">
        <h1> Inicio de sesión</h1>
        <form method="post">
            <div class="username">
                <input id="usuario" type="text" name="usuario">
                <label> Nombre de usuario</label>
            </div>
            <div class="username">
                <input id="password" type="password" name="password" >
                <label>Contraseña</label>
            </div>
            <div class="recordar">¿Olvido su contraseña?</div>
            <input type="submit" value="Iniciar" name="btnIniciar">
            <div class="registrarse">
                Quiero hacer el <a href="../html/registro.php">registro</a>
            </div>
        </form>

    </div>
</body>
</html>