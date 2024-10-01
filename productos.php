<?php
session_start();
include('db.php'); // Asegúrate de que este archivo tenga la conexión a la base de datos.
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a href="index.php" style="text-decoration: none;"><h1>HikePro<span>Shop</span></h1></a>
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Productos</a>
                        </li>
                        <?php
                        // Mostrar enlace al dashboard solo para administradores
                        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="dashboard.php">Cargar Nuevos Productos</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <!-- Ícono del Carrito -->
                    <div id="cart-icon" class="position-relative ms-3">
                        <a href="carrito.php">
                            <img src="img/anadir-al-carrito.png" alt="Carrito" width="30">
                            <span id="cart-count" class="badge bg-primary position-absolute top-0 start-100 translate-middle">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <?php

    // Consulta para obtener los productos
    $productos_sql = "SELECT * FROM productos";
    $productos_result = $conn->query($productos_sql);

    // Verifica si la consulta fue exitosa
    if (!$productos_result) {
        die("Error en la consulta: " . $conn->error);
    }
    ?>

    <!-- Productos -->
    <section id="products" class="container my-5">
        <h2 style="text-align: center;">Nuestros Productos</h2>
        <br>
        
        <!-- Encabezado de Catálogo con Lupa -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3>Catálogo:</h3>

            <!-- Lupa de búsqueda -->
            <span style="display: inline-block;">
                <img src="img/lupa.png" alt="Buscar" id="search-icon" style="width: 30px; cursor: pointer;">
            </span>
        </div>

        <!-- Input de búsqueda oculto -->
        <div id="search-bar" style="display: none; margin-top: 10px;">
            <input type="text" id="search-input" placeholder="Buscar productos..." class="form-control" style="border-radius: 6rem">
        </div>
        
        <br>
        <div class="row" id="products-container">
            <?php if ($productos_result->num_rows > 0): ?>
                <?php while($producto = $productos_result->fetch_assoc()): ?>
                    <div class="col-md-4 product-card mb-4">
                        <div class="card">
                            <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?></p>
                                <button class="btn btn-primary btn-add-to-cart" data-id="<?php echo $producto['id_producto']; ?>">Añadir al Carrito</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay productos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer class="text-center py-3">
        <p>&copy; 2024 Deportes al Aire Libre. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/pruductos.js"></script>

    <!-- Script para mostrar/ocultar el buscador y filtrar productos -->
    <script>
        // Mostrar/ocultar barra de búsqueda al hacer clic en la lupa
        document.getElementById('search-icon').addEventListener('click', function() {
            var searchBar = document.getElementById('search-bar');
            if (searchBar.style.display === 'none' || searchBar.style.display === '') {
                searchBar.style.display = 'block';
            } else {
                searchBar.style.display = 'none';
            }
        });

        // Filtrar productos mientras se escribe en la barra de búsqueda
        document.getElementById('search-input').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach(function(card) {
                var productName = card.querySelector('.card-title').textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
