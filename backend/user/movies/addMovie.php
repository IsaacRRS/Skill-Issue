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
            echo "<script>alert('Preencha todos os campos.'); window.location.href = '../../../frontend/userPanel/register/register_films/register_films.html';</script>";
            exit;
        }

        if ($rating < 0 || $rating > 5) {
            echo "<script>alert('A nota deve ser um número entre 0 e 5.'); window.location.href = '../../../frontend/userPanel/register/register_films/register_films.html';</script>";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO movies (user_id, name, genre, rating, status_option, release_year, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issisis", $user_id, $name, $genre, $rating, $status, $release_year, $description);

        if ($stmt->execute()) {
            header("Location: ../../../frontend/messages/MovieAdded.html");
        } else {
            echo "<script>alert('Erro ao adicionar filme.'); window.location.href = '../../../frontend/userPanel/register/register_films/register_films.html';</script>";
            
            echo ": " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Método inválido.";
    }
?>