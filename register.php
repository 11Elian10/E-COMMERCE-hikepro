<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['reg_username'];
    $mail = $_POST['reg_email'];
    $password = md5($_POST['reg_password']); // Encriptar contraseña usando md5

    // Verificar si el usuario o correo ya existe
    $sql_check = "SELECT * FROM usuarios WHERE username='$username' OR mail='$mail'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "<script>alert('El nombre de usuario o correo electrónico ya están en uso.');</script>";
    } else {
        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, mail, password) VALUES ('$username', '$mail', '$password')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['admin'] = $username; 
            echo "<script>window.location.href = 'index.php?registered=true';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
}
?>
