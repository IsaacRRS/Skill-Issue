<?php
session_start();
require_once '../../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../telaLogin/index.html');
    exit();
}

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare('SELECT id FROM movies WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ii', $movie_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $stmt = $conn->prepare('DELETE FROM movies WHERE id = ?');
        $stmt->bind_param('i', $movie_id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../../../frontend/userPanel/detail/detail_films/detail_films.php');
            exit();
        } else {
            echo "Erro ao excluir filme: " . $stmt->error;
            $stmt->close();
        } 
    } else {
            echo "Filme não encontrado.";
            $stmt->close();
    }
} else {
    echo "ID de filme não fornecido.";
}
?>