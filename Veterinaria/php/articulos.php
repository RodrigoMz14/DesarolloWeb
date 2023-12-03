<?php

    include('databaseConnection.php');

    // Obtener el número total de artículos
    $sqlCount = "SELECT COUNT(*) as total FROM articulo";
    $stmtCount = $pdo->prepare($sqlCount);
    $stmtCount->execute();
    $rowCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $totalArticles = $rowCount['total'];

    // Número de artículos por página
    $articlesPerPage = 1;

    // Calcular el número total de páginas
    $totalPages = ceil($totalArticles / $articlesPerPage);

    // Obtener el número de página actual
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calcular el índice de inicio para la consulta SQL
    $startIndex = ($currentPage - 1) * $articlesPerPage;

    function obtenerArticulos($startIndex, $articlesPerPage) {
        global $pdo;
    
        // Consulta SQL para obtener los artículos de la página actual
        $sqlArticles = "SELECT * FROM articulo LIMIT :startIndex, :articlesPerPage";
        $stmtArticles = $pdo->prepare($sqlArticles);
        $stmtArticles->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
        $stmtArticles->bindParam(':articlesPerPage', $articlesPerPage, PDO::PARAM_INT);
        $stmtArticles->execute();
    
        return $stmtArticles;
    }
    

    function generarPaginacion() {
        global $currentPage, $totalPages;

        if ($currentPage > 1) {
            echo '<button onclick="redirigirPagina(' . ($currentPage - 1) . ')" class="prev">&lt;</button>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<button onclick="redirigirPagina(' . $i . ')" class="page ' . ($i == $currentPage ? 'active' : '') . '">' . $i . '</button>';
        }

        if ($currentPage < $totalPages) {
            echo '<button onclick="redirigirPagina(' . ($currentPage + 1) . ')" class="next">&gt;</button>';
        }
    }

    function generarArticulos() {
        global $currentPage, $articlesPerPage;
    
        // Calcular el índice de inicio para la consulta SQL
        $startIndex = ($currentPage - 1) * $articlesPerPage;
    
        $result = obtenerArticulos($startIndex, $articlesPerPage);
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Datos de los artículos
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $productoId = $row['idArticulo'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $urlImagen = $row['url_imagen'];
    
            echo '<div class="grid-container">';
            echo '    <div class="grid-article">';
            echo '        <a href="#"><p>' . $nombre . '</p></a>';
            echo '        <p>' . $descripcion . '</p>';
            echo '        <div class="info" data-product="' . $productoId . '">';
            echo '            <p>Disponibilidad: <span class="cantidad">' . $cantidad . '</span></p>';
            echo '            <p>Precio: <span class="precio">$' . number_format($precio, 2) . ' mxn</span></p>';
            echo '            <input type="button" value="Comprar">';
            echo '        </div>';
            echo '    </div>';
            echo '    <div class="grid-article"><a href="#"><img src="' . $urlImagen . '"></a></div>';
            echo '</div>';
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosArticulos.css">
    <script src="../js/codigoArticulos.js"></script>
    <title>Articulos</title>
</head>
<body>
    <div id="divPrincipal">
        <header id="ContenedorMenu">
            <ul class="ajustarMenuBarra">
                <li id="botonImg"><a href="Index.html"><img src="../recursos/logoPrincipal.png" alt="Logo del Hospital Veterinario" id="imgLogo"></a></li>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="">Mascotas</a></li>
                <li><a href="">Citas</a></li>
                <li><a href="">Artículos</a></li>
                <li><a href="">Sucursales</a></li>
                <li><a href="">Contacto</a></li>
                <li><a href="">Cuenta</a></li>
            </ul>
        </header>

        <div class="pagination">
            <?php generarPaginacion() ?>
        </div>

        <div class="container-article">
            <div class="filtros">
                <h2>Filtros</h2>
                <h4>Mascotas</h4>
                <label>
                    <input type="checkbox"> Perro
                </label>
                <label>
                    <input type="checkbox"> Gato
                </label>
                <label>
                    <input type="checkbox"> Animal pequeño
                </label>
                <label>
                    <input type="checkbox"> Ave
                </label>
                
                <h4>Categoría</h4>
                <label>
                    <input type="checkbox"> Alimento para mascota
                </label>
                <label>
                    <input type="checkbox"> Medicamento
                </label>
                <label>
                    <input type="checkbox"> Accesorio
                </label>
                <label>
                    <input type="checkbox"> Productos de cuidado
                </label>
                <label>
                    <input type="checkbox"> Juguete para mascota
                </label>

                <h4>Edad de la mascota</h4>
                <label>
                    <input type="checkbox"> Cachorro
                </label>
                <label>
                    <input type="checkbox"> Adulto
                </label>
                <label>
                    <input type="button" value="Filtrar">
                </label>
            </div>

            <?php generarArticulos() ?>
        </div>

        <div class="pagination">
            <?php generarPaginacion() ?>
        </div>  
</body>
</html>
