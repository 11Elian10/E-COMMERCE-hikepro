<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Mobile devices (up to 600px) */
        @media (max-width: 600px) {
            body {
                font-size: 14px;
            }
            header h1 {
                font-size: 20px;
            }
            .container {
                padding: 10px;
            }
            .table {
                font-size: 12px;
            }
        }

        /* Tablets and small laptops (601px to 1024px) */
        @media (min-width: 601px) and (max-width: 1024px) {
            body {
                font-size: 16px;
            }
            header h1 {
                font-size: 24px;
            }
            .container {
                padding: 20px;
            }
            .table {
                font-size: 14px;
            }
        }

        /* Desktops and larger devices (1025px and up) */
        @media (min-width: 1025px) {
            body {
                font-size: 18px;
            }
            header h1 {
                font-size: 28px;
            }
            .container {
                padding: 30px;
            }
            .table {
                font-size: 16px;
            }
        }
    </style>
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

    <!-- Carrito de Compras -->
    <section id="cart" class="container my-5" style="min-height: 50rem;">
        <h2>Tu Carrito</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Productos en el carrito se cargarán aquí dinámicamente -->
            </tbody>
        </table>
        <form id="payment-form" action="procesar_pago.php" method="POST">
            <input type="hidden" name="customer_name" value="John Doe">
            <input type="hidden" name="customer_email" value="johndoe@example.com">
            <input type="hidden" name="total_amount" value="100.00">
            <input type="hidden" name="cart_items" value='[{"nombre":"Producto 1","cantidad":2,"precio":50}]'>
            <button id="checkout" class="btn btn-success">Proceder al Pago</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="text-center py-2">
        <p>&copy; 2024 Deportes al Aire Libre. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="js/carrito.js"></script>
</body>
</html>
