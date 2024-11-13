<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $nombre_completo = $_POST['nombre_completo'] ?? '';
    $email = $_POST['email'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $numero_tarjeta = $_POST['numero_tarjeta'] ?? '';
    $expiracion = $_POST['expiracion'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Insertar el pedido en la base de datos
    $stmt = $conn->prepare("INSERT INTO pedidos (id_user, email, direccion, estado) VALUES (?, ?, ?, 'Completado')");
    $stmt->bind_param("sss", $_SESSION['user_id'], $email, $direccion);
    $stmt->execute();
    $stmt->close();
    $conn->close();
} else {
    header("Location: carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago - HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="confirmModalLabel">Compra Finalizada</h5>
            </div>
            <div class="modal-body">
                ¡Gracias por tu compra, <?php echo htmlspecialchars($nombre_completo); ?>!<br>
                Recibirás una confirmación en <?php echo htmlspecialchars($email); ?>.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar modal automáticamente al cargar la página
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    confirmModal.show();
</script>
</body>
</html>
