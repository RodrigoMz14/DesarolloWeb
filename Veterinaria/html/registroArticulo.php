<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Articulo</title>
    <link rel="stylesheet" href="../css/estiloArticuloGuardar.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/codigoRegistroArticulo.js"></script>
</head>
<body>

<div class="container">
    <a class="back-button" href="index.php">Regresar</a>
    <h2>Registro de Artículo</h2>
    <?php include "../php/funcionesCrudArticulo.php"; ?>

    <form id="articuloForm" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" pattern="[0-9]+(\.[0-9]{1,2})?" required>

        <label for="File_imagen">Imagen:</label>
        <div id="drop-area">
            <p>Suelta tu archivo aquí o haz clic para seleccionar uno.</p>
            <input type="file" id="File_imagen" name="File_imagen" accept="image/*" required>
        </div>

        <label for="edad">Edad:</label>
        <select id="edad" name="edad">
            <option value="Cachorros">Cachorros</option>
            <option value="Adultos">Adultos</option>
        </select>

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria">
            <option value="Alimento para mascotas">Alimento para mascotas</option>
            <option value="Medicamentos">Medicamentos</option>
            <option value="Accesorios">Accesorios</option>
            <option value="Productos de cuidado">Productos de cuidado</option>
            <option value="Juguetes para mascotas">Juguetes para mascotas</option>
        </select>

        <label for="tipoAnimal">Tipo de Animal:</label>
        <select id="tipoAnimal" name="tipoAnimal">
            <option value="Perros">Perros</option>
            <option value="Gatos">Gatos</option>
            <option value="Animales pequeños">Animales pequeños</option>
            <option value="Aves">Aves</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>
</body>
</html>