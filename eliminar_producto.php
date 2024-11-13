<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

include('db.php');

$id = $_GET['id'];
$delete_sql = "DELETE FROM productos WHERE id_producto = ?";
$stmt = $conn->prepare($delete_sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Producto eliminado exitosamente.'); window.location.href='dashboard.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
