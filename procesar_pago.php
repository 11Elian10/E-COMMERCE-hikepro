<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $customerName = $_POST['customer_name'];
    $customerEmail = $_POST['customer_email'];
    $totalAmount = $_POST['total_amount'];
    $cartItems = json_encode($_POST['cart_items']);

    // Suponiendo que las columnas se llamen de otra manera:
    $sql = "INSERT INTO pedidos (nombre_cliente, email_cliente, total_pedido, detalle_items) VALUES ('$customerName', '$customerEmail', '$totalAmount', '$cartItems')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
