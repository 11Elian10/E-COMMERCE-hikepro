<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username; 
        $_SESSION['admin'] = $user['admin'];
    
        echo "<script>window.location.href = 'index.php?success=true';</script>";
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }
}
?>
