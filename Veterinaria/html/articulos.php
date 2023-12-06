<?php
    include('../php/databaseConnection.php');

    $filtros = obtenerFiltros();

    // Construir con respecto a filtros las consultas SQL.
    $filtroMascotas = isset($filtros['mascotas']) ? "AND tipoAnimal = :mascotas" : "";
    $filtroCategoria = isset($filtros['categoria']) ? "AND categoria = :categoria" : "";
    $filtroEdad = isset($filtros['edad']) ? "AND edad = :edad" : "";

    // Obtener el número total de artículos
    $sqlCount = "SELECT COUNT(*) as total FROM articulo WHERE 1 $filtroMascotas $filtroCategoria $filtroEdad";
    $stmtCount = $conexion->prepare($sqlCount);

    // Bind de los valores de los filtros
    if (!empty($filtros['mascotas'])) {
        $stmtCount->bindParam(':mascotas', $filtros['mascotas'], PDO::PARAM_STR);
    }
    if (!empty($filtros['categoria'])) {
        $stmtCount->bindParam(':categoria', $filtros['categoria'], PDO::PARAM_STR);
    }
    if (!empty($filtros['edad'])) {
        $stmtCount->bindParam(':edad', $filtros['edad'], PDO::PARAM_STR);
    }
    
    $stmtCount->execute();
    $rowCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $totalArticles = $rowCount['total'];

    // Número de artículos por página
    $articlesPerPage = 2;

    // Calcular el número total de páginas
    $totalPages = ceil($totalArticles / $articlesPerPage);

    // Obtener el número de página actual
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calcular el índice de inicio para la consulta SQL
    $startIndex = ($currentPage - 1) * $articlesPerPage;
    
    // Obtener los filtros de la URL o del Local Storage
    $filtros = obtenerFiltros();

    // Obtener los filtros de la URL o del Local Storage
    function obtenerFiltros() {

        $mascotas = isset($_GET['mascotas']) ? $_GET['mascotas'] : NULL;
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : NULL;
        $edad = isset($_GET['edad']) ? $_GET['edad'] : NULL;

        $filtros = array(
            'mascotas' => $mascotas,
            'categoria' => $categoria,
            'edad' => $edad,
        );
        return $filtros;
    }

    function obtenerArticulos($startIndex, $articlesPerPage) {
        global $conexion, $filtros;
        
        // Construir con respecto a filtros las consultas SQL.
        $filtroMascotas = isset($filtros['mascotas']) ? "AND tipoAnimal = :mascotas" : "";
        $filtroCategoria = isset($filtros['categoria']) ? "AND categoria = :categoria" : "";
        $filtroEdad = isset($filtros['edad']) ? "AND edad = :edad" : "";

        // Consulta SQL para obtener los artículos de la página actual
        $sqlArticles = "SELECT * FROM articulo WHERE 1 $filtroMascotas $filtroCategoria $filtroEdad LIMIT :startIndex, :articlesPerPage";
        $stmtArticles = $conexion->prepare($sqlArticles);
        $stmtArticles->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
        $stmtArticles->bindParam(':articlesPerPage', $articlesPerPage, PDO::PARAM_INT);

         // Bind de los valores de los filtros
        if ($filtroMascotas != "") $stmtArticles->bindParam(':mascotas', $filtros['mascotas'], PDO::PARAM_STR);
        if ($filtroCategoria != "") $stmtArticles->bindParam(':categoria', $filtros['categoria'], PDO::PARAM_STR);
        if ($filtroEdad != "") $stmtArticles->bindParam(':edad', $filtros['edad'], PDO::PARAM_STR);

        $stmtArticles->execute();

        return $stmtArticles;
    }
    

    function generarPaginacion() {
        global $currentPage, $totalPages;
        $filtros = obtenerFiltros();
        $filtrosEncoded = htmlspecialchars(json_encode($filtros), ENT_QUOTES, 'UTF-8');

        if ($currentPage > 1) {
            echo '<button onclick="redirigirPagina(' . ($currentPage - 1) . ', ' .  $filtrosEncoded  . ')" class="prev">&lt;</button>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<button onclick="redirigirPagina(' . $i . ', ' .  $filtrosEncoded  . ')" class="page' . ($i == $currentPage ? 'active' : '') . '">' . $i . '</button>';
        }

        if ($currentPage < $totalPages) {
            echo '<button onclick="redirigirPagina(' . ($currentPage + 1) . ', ' .  $filtrosEncoded  . ')" class="next">&gt;</button>';
        }
    }

    function generarArticulos() {
        global $currentPage, $articlesPerPage;
    
        // Calcular el índice de inicio para la consulta SQL
        $startIndex = ($currentPage - 1) * $articlesPerPage;
    
        $result = obtenerArticulos($startIndex, $articlesPerPage);
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Datos de los artículos
            $idArticulo = $row['idArticulo'];
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $urlImagen = $row['url_imagen'];
    
            echo '<div class="grid-container">';
            echo '    <div class="grid-article">';
            echo '        <a href="#"><p>' . $nombre . '</p></a>';
            echo '        <p>' . $descripcion . '</p>';
            echo '        <div class="info">';
            echo '            <p>Disponibilidad: <span class="cantidad">' . $cantidad . '</span></p>';
            echo '            <p>Precio: <span class="precio">$' . number_format($precio, 2) . ' mxn</span></p>';
            echo '            <input type="button" class="guardar-carrito" data-product="' . $idArticulo .'" value="Guardar en Carrito">';
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
                    <input type="checkbox" name="mascotas" value="Perro" onclick="deseleccionar(this)"> Perro
                </label>
                <label>
                    <input type="checkbox" name="mascotas" value="Gato" onclick="deseleccionar(this)"> Gato
                </label>
                <label>
                    <input type="checkbox" name="mascotas" value="Animal pequeño" onclick="deseleccionar(this)"> Animal pequeño
                </label>
                <label>
                    <input type="checkbox" name="mascotas" value="Ave" onclick="deseleccionar(this)"> Ave
                </label>
                
                <h4>Categoría</h4>
                <label>
                    <input type="checkbox" name="categoria" value="Alimento para mascota" onclick="deseleccionar(this)"> Alimento para mascota
                </label>
                <label>
                    <input type="checkbox" name="categoria" value="Medicamento" onclick="deseleccionar(this)"> Medicamento
                </label>
                <label>
                    <input type="checkbox" name="categoria" value="Accesorio" onclick="deseleccionar(this)"> Accesorio
                </label>
                <label>
                    <input type="checkbox" name="categoria" value="Productos de cuidado" onclick="deseleccionar(this)"> Productos de cuidado
                </label>
                <label>
                    <input type="checkbox" name="categoria" value="Juguete para mascota" onclick="deseleccionar(this)"> Juguete para mascota
                </label>

                <h4>Edad de la mascota</h4>
                <label>
                    <input type="checkbox" name="edad" value="Cachorro" onclick="deseleccionar(this)"> Cachorro
                </label>
                <label>
                    <input type="checkbox" name="edad" value="Adulto" onclick="deseleccionar(this)"> Adulto
                </label>
                <label>
                    <input type="button" value="Filtrar" onclick="filtrarArticulos()">
                </label>
            </div> 

            <div>
                <?php generarArticulos() ?>
            </div>
        </div>

        <div class="pagination">
            <?php generarPaginacion() ?>
        </div>  

        <footer id="ContenedorInferior">
            <div id="menuInferior">
                <h2>Veterinaria</h2>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="">Mascotas</a></li>
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
