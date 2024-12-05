<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('Preencha todos os campos'); window.location.href = '../../frontend/telaLogin/index.html';</script>";
        exit;
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email ja cadastrado'); window.location.href = '../../frontend/telaLogin/index.html';</script>";
        exit;
    }
    
    $hashedPassword = md5($password);

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../../frontend/messages/RegisterSucess.html");
        exit;
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>
