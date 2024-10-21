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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilo del modal de notificación */
        #notification-modal .modal-content {
            background-color: #28a745;
            color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        #notification-modal .modal-body p {
            font-size: 16px;
            margin: 0;
        }
        /* Estilos responsivos */
        @media (max-width: 768px) {
            footer {
                font-size: 14px;
                padding: 8px 0;
            }
        }

        @media (max-width: 480px) {
            footer {
                font-size: 12px;
                padding: 6px 0;
            }
        }

        /* Ajustes para dispositivos móviles pequeños */
        @media (max-width: 576px) {
            h1 {
                font-size: 24px;
            }
            .navbar {
                flex-direction: column;
            }
            .container {
                padding: 0 10px;
            }
            .productos-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Ajustes para tablets y dispositivos medianos */
        @media (min-width: 577px) and (max-width: 768px) {
            h1 {
                font-size: 28px;
            }
            .productos-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Ajustes para laptops y dispositivos más grandes */
        @media (min-width: 769px) and (max-width: 1024px) {
            h1 {
                font-size: 32px;
            }
            .productos-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Ajustes para pantallas grandes y desktops */
        @media (min-width: 1025px) {
            h1 {
                font-size: 36px;
            }
            .productos-grid {
                grid-template-columns: repeat(4, 1fr);
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
        
        <!-- Contenedor de catálogo y búsqueda -->
    <div class="catalogo-buscador" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Catálogo:</h3>
        <!-- Contenedor de búsqueda -->
            <div class="caja">
                <button class="boton" type="button" id="search-button">
                    <i class="fas fa-search"></i> <!-- Icono de búsqueda -->
                </button>
                <input class="buscar" type="text" placeholder="Buscar..." id="search-input"> <!-- Campo de búsqueda -->
            </div>
        </div>
    </div>

    <br>

    <!-- Sección de productos -->
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

    <!-- Botón flotante para abrir el chatbot -->
    <button id="chatbot-button">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Contenedor del Chatbot -->
    <div id="chatbot-container">
        <div id="chatbot-header">
            <div class="d-flex align-items-center">
                <img src="img/logo2chat.png" alt="Agente" class="rounded-circle">
                <h5>Hikepro BOT</h5>
            </div>
            <i class="fas fa-times" id="close-chatbot"></i>
        </div>

        <div id="chatbot-body">
            <!-- Mensajes del Chatbot -->
            <div class="message bot">
                <p>¡Hola! ¿En qué puedo ayudarte con nuestros productos?</p>
            </div>
        </div>

        <div id="chatbot-questions-container">
            <!-- Botones de desplazamiento -->
            <button class="scroll-button scroll-left"><i class="fas fa-chevron-left"></i></button>
            <div id="chatbot-questions">
                <!-- Preguntas frecuentes -->
                <button class="question-btn" data-answer="Contamos con una amplia variedad de productos, desde ropa hasta equipo de senderismo.">¿Qué tipos de productos venden?</button>
                <button class="question-btn" data-answer="Los precios de nuestros productos varían según el tipo y la marca. Puedes ver los precios actualizados en nuestra tienda online.">¿Cuáles son los precios de los productos?</button>
                <button class="question-btn" data-answer="Ofrecemos descuentos especiales en algunos productos seleccionados. Consulta nuestra sección de ofertas.">¿Tienen productos en oferta?</button>
                <button class="question-btn" data-answer="Nuestros productos más vendidos son las mochilas de senderismo y las botas impermeables.">¿Cuáles son los productos más vendidos?</button>
                <button class="question-btn" data-answer="La disponibilidad depende del stock actual, pero actualizamos nuestra página regularmente.">¿Están todos los productos disponibles en stock?</button>
                <button class="question-btn" data-answer="Hacemos envíos a nivel nacional e internacional. Las tarifas dependen de la ubicación.">¿A qué lugares realizan envíos de productos?</button>
            </div>
            <button class="scroll-button scroll-right"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- Modal de notificación -->
    <div id="notification-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Producto agregado al carrito</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar/Ocultar el chatbot
        const chatbotButton = document.getElementById('chatbot-button');
        const chatbotContainer = document.getElementById('chatbot-container');
        const closeChatbot = document.getElementById('close-chatbot');

        chatbotButton.addEventListener('click', () => {
            chatbotContainer.style.display = 'flex';
        });

        closeChatbot.addEventListener('click', () => {
            chatbotContainer.style.display = 'none';
        });

        // Simular respuestas con preguntas frecuentes
        const questionButtons = document.querySelectorAll('.question-btn');
        const chatbotBody = document.getElementById('chatbot-body');

        questionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const questionText = this.innerText;
                const answerText = this.getAttribute('data-answer');

                // Añadir pregunta del usuario
                const userDiv = document.createElement('div');
                userDiv.classList.add('message', 'user');
                userDiv.innerHTML = `<p>${questionText}</p>`;
                chatbotBody.appendChild(userDiv);

                // Añadir respuesta del bot
                setTimeout(() => {
                    const botDiv = document.createElement('div');
                    botDiv.classList.add('message', 'bot');
                    botDiv.innerHTML = `<p>${answerText}</p>`;
                    chatbotBody.appendChild(botDiv);
                    chatbotBody.scrollTop = chatbotBody.scrollHeight; // Desplazar al final
                }, 1000);
            });
        });

        // Desplazamiento horizontal para preguntas frecuentes
        const chatbotQuestions = document.getElementById('chatbot-questions');
        const scrollLeftButton = document.querySelector('.scroll-left');
        const scrollRightButton = document.querySelector('.scroll-right');

        scrollLeftButton.addEventListener('click', () => {
            chatbotQuestions.scrollBy({ left: -200, behavior: 'smooth' });
        });

        scrollRightButton.addEventListener('click', () => {
            chatbotQuestions.scrollBy({ left: 200, behavior: 'smooth' });
        });

        //Ventana modal de notificacion:
        document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                // Mostrar la notificación modal
                const modalElement = new bootstrap.Modal(document.getElementById('notification-modal'));
                modalElement.show();
                // Ocultar el modal después de 2 segundos
                setTimeout(() => {
                    modalElement.hide();
                }, 2000);
                // Aquí puedes agregar la lógica para añadir el producto al carrito mediante AJAX si lo deseas.
            });
        });
    });
    </script>

    <footer class="text-center py-3">
        <p>&copy; 2024 Deportes al Aire Libre. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/productos.js"></script>

    <!-- Script para mostrar/ocultar el buscador y filtrar productos -->
    <script>
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

        document.getElementById("search-button").addEventListener("click", function() {
            const query = document.getElementById("search-input").value;
            if (query) {
                alert(`Buscando: ${query}`); // Simula una búsqueda mostrando una alerta
                // Aquí puedes agregar la lógica para realizar la búsqueda en tu aplicación
            } else {
                alert("Por favor, ingrese un término de búsqueda."); // Mensaje si el campo está vacío
            }
        });
    </script>
</body>
</html>
