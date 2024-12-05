<?php

session_start();
require_once '../../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../telaLogin/index.html');
    exit();
}

if (isset($_GET['id'])) {
    $serie_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare('SELECT id FROM series WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ii', $serie_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $stmt = $conn->prepare('DELETE FROM series WHERE id = ?');
        $stmt->bind_param('i', $serie_id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../../../frontend/userPanel/detail/detail_series/detail_series.php');
            exit();
        } else {
            echo "Erro ao excluir série: " . $stmt->error;
            $stmt->close();
        } 
    } else {
        echo "Série não encontrada.";
        $stmt->close();
    }
} else {
    echo "ID de série não fornecido.";
}
?>
