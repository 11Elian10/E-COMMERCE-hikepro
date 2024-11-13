<?php
session_start();

// Verificar que el usuario sea administrador
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'hikeproshop_db');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_FILES['imagen']['name'];

// Guardar la imagen en el servidor
$directorio = "img/";
$ruta_imagen = $directorio . basename($imagen);

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
    // Preparar la consulta SQL
    $sql = "INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nombre, $precio, $stock, $ruta_imagen);

    if ($stmt->execute()) {
        echo "<script>alert('Producto agregado exitosamente.'); window.location.href='dashboard.php';</script>";    
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error al cargar la imagen.";
}

$conn->close();
?>
