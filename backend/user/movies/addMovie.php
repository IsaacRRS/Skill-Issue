<?php
    session_start();
    require_once '../../db.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../frontend/telaLogin/index.html');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $user_id = $_SESSION['user_id'];

        $name = trim($_POST['name']);
        $genre = trim($_POST['opcoes']);
        $rating = intval($_POST['rating']);
        $status = trim($_POST['status-option']);
        $release_year = intval($_POST['release_year']);
        $description = trim($_POST['description']);

        if (empty($name) || empty($genre) || empty($rating) || empty($status) || empty($release_year) || empty($description)) {
            echo "Preencha todos os campos.";
            exit;
        }

        if ($rating < 0 || $rating > 5) {
            echo "A nota deve ser um número entre 0 e 5.";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO movies (user_id, name, genre, rating, status_option, release_year, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issisis", $user_id, $name, $genre, $rating, $status, $release_year, $description);

        if ($stmt->execute()) {
            echo "Filme adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar filme: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Método inválido.";
    }
?>