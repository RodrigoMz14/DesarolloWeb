<?php
include('databaseConnection.php');
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Manejar la solicitud de agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $productId = $_POST['id'];

    try {
        // Buscar el producto en la base de datos
        $query = $pdo->prepare("SELECT * FROM articulo WHERE id = ?");
        $query->execute([$productId]);
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Verificar si el producto ya está en el carrito
            $productInCart = array_filter($_SESSION['carrito'], function ($item) use ($productId) {
                return $item['id'] == $productId;
            });

            // Si el producto no está en el carrito, agrégalo
            if (empty($productInCart)) {
                $productData = [
                    'id' => $product['id'],
                    'nombre' => $product['nombre'],
                    'cantidad' => 1, // Puedes ajustar la cantidad según tus necesidades
                    'urlImagen' => $product['urlImagen'],
                    'precio' => $product['precio'] // Agrega el precio
                    // Agrega más datos según tus necesidades
                ];

                $_SESSION['carrito'][] = $productData;
                echo 'Producto agregado al carrito con éxito';
            } else {
                echo 'El producto ya está en el carrito';
            }
        } else {
            echo 'Producto no encontrado';
        }
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo 'Error al procesar la solicitud: ' . $e->getMessage();
    }
} else {
    echo 'Error al procesar la solicitud';
}

// Calcular el total del carrito
$totalCarrito = 0;
foreach ($_SESSION['carrito'] as $product) {
    // Puedes ajustar según la estructura de tu array
    $totalCarrito += $product['cantidad'] * $product['precio'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estiloCarrito.css">
    <title>Carrito</title>
</head>
<body>
    <header>
        <h1>Carrito de Compras</h1>
    </header>
    <main>
        <div id="container-products">
            <?php foreach ($_SESSION['carrito'] as $product): ?>
                <div class="product">
                    <img src="<?php echo $product['urlImagen']; ?>" alt="<?php echo $product['nombre']; ?>">
                    <h2><?php echo $product['nombre']; ?></h2>
                    <p>Cantidad: <?php echo $product['cantidad']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="checkout">
            <p>Total en el Carrito: $<?php echo number_format($totalCarrito, 2); ?></p>
            <button>Pagar</button>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
