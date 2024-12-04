<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos.";
        exit;
    }

    $hashedPassword = md5($password);

    // Consulta o usuário no banco de dados
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Store user ID in session
        $_SESSION['user_id'] = $user['id'];

        if ($user['is_admin'] == 1) {
            header('Location: ../../frontend/telaLogin/escolhaLogin/index.html');
            exit;
        } else {
            header('Location: ../../frontend/home/index.html');
            exit;
        }
    } else {
        echo "E-mail ou senha incorretos.";
    }

    $stmt->close();
}
?>