<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos.";
        exit;
    }

    $hashedPassword = md5($password);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Login realizado com sucesso!";
    } else {
        echo "E-mail ou senha incorretos.";
    }
}
?>
