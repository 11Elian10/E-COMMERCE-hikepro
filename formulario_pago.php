<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago - HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .blur-container {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .form-title {
            text-align: center;
            font-weight: bold;
            color: #0072ff;
        }
    </style>
</head>
<body>
    <div class="blur-container">
        <h2 class="form-title mb-4">Confirmación de Pago</h2>
        <form action="confirmar_pago.php" method="POST">
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección de Envío</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="numero_tarjeta" class="form-label">Número de Tarjeta de Crédito</label>
                <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="0000 0000 0000 0000" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="expiracion" class="form-label">Fecha de Expiración</label>
                    <input type="text" class="form-control" id="expiracion" name="expiracion" placeholder="MM/AA" required>
                </div>
                <div class="col-md-6">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="000" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Finalizar Pago</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
