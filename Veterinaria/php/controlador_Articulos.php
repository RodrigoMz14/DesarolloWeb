<?php
    session_start();
    if (empty($_SESSION["id"])){
        header("location: login.php");
    }

    include('../php/databaseConnection.php');
    require('../php/generarTablaMascotas.php');

    // Definir valores válidos para mascotas
    $mascotasValidas = array("Perro", "Gato", "Animal pequeño", "Ave");
    $categoriasValidas = array("Alimento para mascota", "Medicamento", "Accesorio", "Productos de cuidado", "Juguete para mascota");
    $edadValida = array("Cachorro", "Adulto");

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
    $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

    // Calcular el índice de inicio para la consulta SQL
    $startIndex = ($currentPage - 1) * $articlesPerPage;
    
    // Obtener los filtros de la URL o del Local Storage
    $filtros = obtenerFiltros();

    // Obtener los filtros de la URL o del Local Storage
    function obtenerFiltros() {
        global $mascotasValidas, $categoriasValidas, $edadValida;

        $mascotas = isset($_GET['mascotas']) && in_array($_GET['mascotas'], $mascotasValidas) ? $_GET['mascotas'] : NULL;
        $categoria = isset($_GET['categoria']) && in_array($_GET['categoria'], $categoriasValidas) ? $_GET['categoria'] : NULL;
        $edad = isset($_GET['edad']) && in_array($_GET['edad'], $edadValida) ? $_GET['edad'] : NULL;


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

            echo '            <form method="POST" action="procesar_carrito.php">';
            echo '                <label for="cantidad" class="cantidad-label">Cantidad:</label>';
            echo '                <input type="number" name="cantidad" id="cantidad" value="1" min="1" required>';
            echo '                <input type="hidden" name="idArticulo" value="' . $idArticulo . '">';
            echo '                <button type="submit" class="guardar-carrito">Guardar en Carrito</button>';
            echo '            </form>';

            echo '        </div>';
            echo '    </div>';
            echo '    <div class="grid-article"><a href="#"><img src="' . $urlImagen . '"></a></div>';
            echo '</div>';
        }
    }

?>