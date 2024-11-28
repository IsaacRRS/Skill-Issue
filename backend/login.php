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

    // Consulta o usuário no banco de dados
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['is_admin'] == 1) {
            header('Location: ../frontend/telaLogin/escolhaLogin/index.html');
            exit;
        } else {
            header('Location: ../frontend/home/index.html');
            exit;
        }
    } else {
        echo "E-mail ou senha incorretos.";
    }
}
?>
