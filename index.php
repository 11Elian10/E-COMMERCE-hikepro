<?php
session_start();

// Verifica si el usuario está logueado
$currentUser = isset($_SESSION['admin']) ? $_SESSION['admin'] : null;

// Verifica si el modal ya fue mostrado para este usuario
if (!isset($_SESSION['last_user']) || $_SESSION['last_user'] !== $currentUser) {
    $_SESSION['show_welcome_modal'] = true;
    $_SESSION['last_user'] = $currentUser; // Actualiza el último usuario con el actual
} else {
    $_SESSION['show_welcome_modal'] = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Modal de bienvenida -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="welcomeModalLabel">¡Bienvenido!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($currentUser) {
                        echo "<center>BIENVENIDO DE NUEVO</center> " . $currentUser . ".";
                    } else {
                        echo "Bienvenido a la Tienda de Deportes al Aire Libre.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

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
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Productos</a>
                        </li>
                        <?php if (isset($_SESSION['admin'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><?php echo $_SESSION['admin']; ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- Ícono del Carrito -->
                    <div id="cart-icon" class="position-relative ms-3">
                        <a href="carrito.php">
                            <img src="img/anadir-al-carrito.png" alt="" width="30">
                            <span id="cart-count" class="badge bg-primary position-absolute top-0 start-100 translate-middle">0</span>
                        </a>
                    </div>
                    <div id="cart-icon2" class="position-relative ms-3">
                        <a href="login.html">
                            <img src="img/usuario.png" alt="" width="30">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Slider de Promociones -->
    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/Diseño sin título_20240823_201424_0000.png" class="d-block w-100" alt="Promoción 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Promoción Especial: 50% de descuento en Equipo de futbol</h5>
                    <p>Compra hoy y obtén un descuento exclusivo en equipacion de futbol.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/Diseño sin título_20240823_200423_0000.png" class="d-block w-100" alt="Promoción 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Promociòn del 50% de descuento en bicicletas de montaña</h5>
                    <p>Prepárate para la aventura con nuestras bicicletas de alta calidad.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Información de la Tienda -->
    <section id="about-us" class="mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="img/Diseño sin título_20240823_204108_0000.png" alt="Acerca de Nosotros">
                </div>
                <div class="col-md-6">
                    <h2>Sobre Nuestra Tienda</h2>
                    <p class="about-text">Bienvenido a Deportes al Aire Libre, tu destino principal para todo lo relacionado con la aventura al aire libre. Ofrecemos una amplia gama de productos, desde equipamiento de ciclismo y senderismo hasta ropa deportiva de alta calidad. Nuestro objetivo es proporcionar a nuestros clientes productos excepcionales que mejoren su experiencia al aire libre.</p>
                    <p class="about-text">Contamos con un equipo apasionado de expertos en actividades al aire libre que están siempre listos para ayudarte a elegir el equipo perfecto para tus necesidades. Gracias por elegirnos como tu tienda de confianza para todas tus aventuras al aire libre.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2024 Deportes al Aire Libre. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/productos.js"></script>

    <script>
        $(document).ready(function() {
            // Mostrar el modal solo si es un nuevo usuario
            <?php if ($_SESSION['show_welcome_modal'] === true): ?>
                $('#welcomeModal').modal('show');
                setTimeout(function() {
                    $('#welcomeModal').modal('hide');
                }, 1500);
                <?php $_SESSION['show_welcome_modal'] = false; // No mostrar el modal de nuevo ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
