<?php
session_start();
require_once '../../../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../telaLogin/index.html');
    exit();
}

if (isset($_GET['id'])) {
    $series_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM series WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $series_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $series = $result->fetch_assoc();
    } else {
        echo "Série não encontrada ou você não tem permissão para editá-la.";
        exit();
    }
} else {
    echo "ID da série não fornecido.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $seasons = intval($_POST['seasons']);
    $episodes = intval($_POST['episodes']);
    $genre = $_POST['genre'];
    $release_year = intval($_POST['release_year']);
    $description = trim($_POST['description']);
    $rating = intval($_POST['rating']);
    $status = $_POST['status-option'];

    if (empty($name) || empty($seasons) || empty($episodes) || empty($genre) || empty($release_year)) {
        echo "Preencha todos os campos obrigatórios.";
    } else {
        $stmt = $conn->prepare("UPDATE series SET name = ?, seasons = ?, episodes = ?, genre = ?, release_year = ?, description = ?, rating = ?, status_option = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("siisisisii", $name, $seasons, $episodes, $genre, $release_year, $description, $rating, $status, $series_id, $user_id);

        if ($stmt->execute()) {
            $series['name'] = $name;
            $series['seasons'] = $seasons;
            $series['episodes'] = $episodes;
            $series['genre'] = $genre;
            $series['release_year'] = $release_year;
            $series['description'] = $description;
            $series['rating'] = $rating;
            $series['status_option'] = $status;

            echo "<script>
                alert('Série atualizada com sucesso!');
            </script>";
        } else {
            echo "Erro ao atualizar série: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Swap Films</title>
    <script src="config.js" defer></script>
</head>
<body>
    <section>
        <div class="series-update-form">
            <form action="" method="post">
                <fieldset>
                    <legend><b><i class="fa-solid fa-wrench"></i> Editar Série</b></legend><br>
                    <div class="Inputbox">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" value="<?php echo ($series['name']); ?>" class="InputUser" required>
                    </div><br>
                    <div class="Inputbox">
                        <label for="seasons">Temporadas:</label>
                        <input type="number" name="seasons" value="<?php echo ($series['seasons']); ?>" class="InputUser" required><br>
                    </div><br>
                    <div class="Inputbox">
                        <label for="episodes">N° de Episódios:</label>
                        <input type="number" name="episodes" value="<?php echo ($series['episodes']); ?>" class="InputUser" required><br>
                    </div><br>
                    <div class="Inputbox">
                        <label for="genre">Gênero:</label>
                        <select id="genre" name="genre" required>
                            <option value="" disabled>Selecione um gênero</option>
                            <option value="terror" <?php if ($series['genre'] == 'terror') echo 'selected'; ?>>Terror</option>
                            <option value="ação" <?php if ($series['genre'] == 'ação') echo 'selected'; ?>>Ação</option>
                            <option value="comedia" <?php if ($series['genre'] == 'comedia') echo 'selected'; ?>>Comédia</option>
                            <option value="ficcao" <?php if ($series['genre'] == 'ficcao') echo 'selected'; ?>>Ficção Científica</option>
                            <option value="aventura" <?php if ($series['genre'] == 'aventura') echo 'selected'; ?>>Aventura</option>
                        </select>
                    </div><br>
                    <div class="Inputbox">
                        <label for="release_year">Ano de Lançamento:</label>
                        <input type="number" name="release_year" value="<?php echo ($series['release_year']); ?>" class="InputUser" required><br>
                    </div><br>
                    <div class="Inputbox">
                        <label for="description">Descrição:</label>
                        <textarea name="description" placeholder="Coloque sua Descrição aqui" class="InputUser" cols="90" rows="3"><?php echo ($series['description']); ?></textarea><br>
                    </div>
                    <label for="rating">Avaliação:</label>
                    <div class="rating">
                        <?php
                        for ($i = 5; $i >= 1; $i--) {
                            echo '<input type="radio" id="star' . $i . '" name="rating" value="' . $i . '" ' . ($series['rating'] == $i ? 'checked' : '') . '>';
                            echo '<label for="star' . $i . '">&#9733;</label>';
                        }
                        ?>
                    </div> <br><br>
                    <div class="status">
                        <label for="status">Status:</label>
                        <label for="Nao Assistido">Não Assistido</label>
                        <input type="radio" name="status-option" value="Nao Assistido" <?php if ($series['status_option'] == 'Nao Assistido') echo 'checked'; ?>>
                        <label for="Assistido">Assistido</label>
                        <input type="radio" name="status-option" value="Assistido" <?php if ($series['status_option'] == 'Assistido') echo 'checked'; ?>>
                    </div> <br><br>
                    <div class="buttons"> 
                        <a class="voltar" href="../../detail/detail_series/detail_series.php">Voltar</a>
                        <button type="reset" id="clear-button">Limpar</button>
                        <button type="submit" id="save-button">Salvar</button>
                    </div>                      
                </fieldset>
            </form>
        </div>
    </section>
</body>
</html>
