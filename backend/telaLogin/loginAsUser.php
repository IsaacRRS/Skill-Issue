<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../frontend/telaLogin/index.html');
    exit();
}

$admin_id = $_SESSION['user_id'];

$stmt = $conn->prepare('SELECT is_admin FROM users WHERE id = ?');
$stmt->bind_param('i', $admin_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    header('Location: ../../frontend/telaLogin/index.html');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = ($_GET['id']);

    $stmt = $conn->prepare('SELECT id FROM users WHERE id = ?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['user_id'] = $user_id;

        header('Location: ../../frontend/home/index.html');
        exit();
    } else {
        echo "Usuário não encontrado.";
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>
