<?php
    session_start();
    require_once('../../db.php');

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../frontend/telaLogin/index.html');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $user_id = $_SESSION['user_id'];

        $name = trim($_POST['name']);
        $seasons = intval($_POST['seasons']);
        $episodes = intval($_POST['episodes']);
        $genre = trim($_POST['genre']);
        $release_year = intval($_POST['release_year']);
        $status_option = trim($_POST['status-option']);
        $description = trim($_POST['description']);
        $rating = intval($_POST['rating']);

        if (empty($name) || empty($seasons) || empty($episodes) || empty($genre) || empty($release_year) || empty($status_option) || empty($rating) || empty($description)) {
            echo "<script>alert('Preencha todos os campos.'); window.location.href = '../../../frontend/userPanel/register/register_series/register_series.html';</script>";
            exit;
        }

        if ($rating < 0 || $rating > 5) {
            echo "<script>alert('A nota deve ser um número entre 0 e 5'); window.location.href = '../../../frontend/userPanel/register/register_series/register_series.html';</script>";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO series (user_id, name, seasons, episodes, genre, release_year, status_option, rating, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississsis", $user_id, $name, $seasons, $episodes, $genre, $release_year, $status_option, $rating, $description);

        if ($stmt->execute()) {
            header("Location: ../../../frontend/messages/SerieAdded.html");
        } else {
            echo "Erro ao adicionar série: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Método inválido.";
    }

    $conn->close();
?>