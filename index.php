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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos responsive */
        @media (max-width: 768px) {
            .caption h1 {
                font-size: 24px; /* Tamaño de fuente en pantallas pequeñas */
            }

            .caption p {
                font-size: 16px; /* Tamaño de texto en pantallas pequeñas */
            }

            header h1 {
                font-size: 28px; /* Tamaño de texto del header en pantallas pequeñas */
            }

            .about-section, .reviews-section {
                padding: 15px; /* Espaciado en secciones */
            }

            .review-item {
                margin-bottom: 15px; /* Espaciado entre reseñas */
            }
        }

        @media (max-width: 576px) {
            .caption h1 {
                font-size: 20px; /* Tamaño de fuente aún más pequeño */
            }

            .caption p {
                font-size: 14px; /* Texto aún más pequeño */
            }

            #chatbot-container {
                width: 90%; /* Ancho del chatbot en pantallas pequeñas */
                max-width: 400px; /* Ancho máximo del chatbot */
            }
        }
    </style>
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

    <!-- Slider -->
    <div id="slider">
        <div class="slide active" style="background-image: url('img/slider1.jpg');">
            <div class="caption">
                <h1>Bienvenido a Sports Gear</h1>
                <p>Encuentra todo lo que necesitas para tu deporte favorito.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('img/slider2.jpg');">
            <div class="caption">
                <h1>Equipamiento de alta calidad</h1>
                <p>Compra las mejores marcas para rendimiento y calidad.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('img/slider3.png');">
            <div class="caption">
                <h1>Prepárate para el éxito</h1>
                <p>Listo para la acción con ropa deportiva Nike.</p>
            </div>
        </div>
    </div>

    <!-- Sobre Nosotros -->
    <section class="about-section">
        <h2>Sobre Nosotros</h2>
        <p>Somos una compañía dedicada a...</p>
    </section>

    <!-- Reseñas -->
    <section class="reviews-section">
        <h2>Reseñas</h2>
        <div class="row">
            <div class="col-md-4 review-item">
                <p>"¡Increíble experiencia! Me encantó el enfoque en el crecimiento personal."</p>
                <p><strong>- Juan Pérez</strong></p>
            </div>
            <div class="col-md-4 review-item">
                <p>"Un servicio excepcional y motivador."</p>
                <p><strong>- María García</strong></p>
            </div>
            <div class="col-md-4 review-item">
                <p>"Definitivamente recomiendo a todos unirse a este viaje."</p>
                <p><strong>- Carlos López</strong></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2024 Deportes al Aire Libre. Todos los derechos reservados.</p>
    </footer>

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
                <p>¡Hola! ¿En qué puedo ayudarte hoy?</p>
            </div>
        </div>
        <div id="chatbot-questions-container">
            <!-- Botones de desplazamiento -->
            <button class="scroll-button scroll-left"><i class="fas fa-chevron-left"></i></button>
            <div id="chatbot-questions">
                <!-- Preguntas frecuentes -->
                <button class="question-btn" data-answer="Nuestros horarios son de 9 am a 6 pm.">¿Cuáles son sus horarios?</button>
                <button class="question-btn" data-answer="Ofrecemos envíos gratuitos en pedidos superiores a $50.">¿Ofrecen envíos gratuitos?</button>
                <button class="question-btn" data-answer="Puedes devolver cualquier artículo en un plazo de 30 días.">¿Cuál es la política de devoluciones?</button>
                <button class="question-btn" data-answer="Aceptamos tarjetas de crédito, débito y PayPal.">¿Qué métodos de pago aceptan?</button>
                <button class="question-btn" data-answer="Contamos con soporte 24/7.">¿Tienen soporte las 24 horas?</button>
                <button class="question-btn" data-answer="Puedes rastrear tu pedido desde la sección de 'Mis pedidos'.">¿Cómo puedo rastrear mi pedido?</button>
            </div>
            <button class="scroll-button scroll-right"><i class="fas fa-chevron-right"></i></button>
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

        //modal de bienvenida
        $(document).ready(function() {
            // Mostrar el modal de bienvenida
            <?php if ($_SESSION['show_welcome_modal'] === true): ?>
                $('#welcomeModal').modal('show');
                setTimeout(function() {
                    $('#welcomeModal').modal('hide');
                }, 1500);
                <?php $_SESSION['show_welcome_modal'] = false; ?>
            <?php endif; ?>
        });
    </script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/productos.js"></script>
</body>
</html>
