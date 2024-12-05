<?php

session_start();
require_once '../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../telaLogin/index.html');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT is_admin FROM users WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($is_admin);
$stmt->fetch();
$stmt->close();

if (!$is_admin) {
    header('Location: ../telaLogin/index.html');
    exit();
}

if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    if ($delete_id == $user_id) {
        echo "Você não pode excluir seu próprio usuário.";
        exit;
    }

    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt->bind_param('i', $delete_id);

    if ($stmt->execute()) {
        header('Location: ../../frontend/telaADMIN/index.php');
        exit;
    } else {
        echo "Erro ao excluir usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de usuário não fornecido.";
}
?>