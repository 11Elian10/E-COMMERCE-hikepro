<?php
$servername = "localhost";
$username = "root";  // Tu usuario de MySQL
$password = "Elianp8765";  // Tu contraseña de MySQL
$dbname = "hikeproshop_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
