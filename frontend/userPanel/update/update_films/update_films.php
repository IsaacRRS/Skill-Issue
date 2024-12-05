<?php
session_start();
require_once '../../../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../telaLogin/index.html');
    exit;
}

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $movie_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Filme não encontrado";
        exit;
    }
} else {
    echo "ID do filme não informado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $status = $_POST['status-option'];

    if (empty($name) || empty($genre) || empty($release_year) || empty($description) || empty($rating) || empty($status)) {
        echo "Preencha todos os campos";
        exit;
    } else {
        $stmt = $conn->prepare("UPDATE movies SET name = ?, genre = ?, release_year = ?, description = ?, rating = ?, status_option = ? WHERE id = ?");
        $stmt->bind_param("ssisisi", $name, $genre, $release_year, $description, $rating, $status, $movie_id);
        
        if ($stmt->execute()) {
            $movie['name'] = $name;
            $movie['genre'] = $genre;
            $movie['release_year'] = $release_year;
            $movie['description'] = $description;
            $movie['rating'] = $rating;
            $movie['status_option'] = $status;

            echo "<script>
                alert('Filme atualizado com sucesso!');
            </script>";
            $stmt->close();
        } else {
            echo "Erro ao atualizar filme: " . $stmt->error;
            $stmt->close();
        }
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
        <div class="films-update-form">
            <form action="" method="POST">
                <fieldset>
                    <legend><b><i class="fa-solid fa-wrench"></i>Editar Filme</b></legend><br>
                    <div class="Inputbox">
                        <label for="name">Nome:</label>
                            <input type="text" name="name" placeholder="Nome" value="<?php echo ($movie['name']); ?>" class="InputUser" required>
                    </div><br>
                    <div class="Inputbox"> 
                        <label for="gender">Gênero:</label>
                            <select id="opcoes" name="genre" size="1" required>
                                <option value="" disabled>Selecione um gênero</option>
                                <option value="terror" <?php if ($movie['genre'] == 'terror') echo 'selected'; ?>>Terror</option>
                                <option value="ação" <?php if ($movie['genre'] == 'ação') echo 'selected'; ?>>Ação</option>
                                <option value="comedia" <?php if ($movie['genre'] == 'comedia') echo 'selected'; ?>>Comédia</option>
                                <option value="ficcao" <?php if ($movie['genre'] == 'ficcao') echo 'selected'; ?>>Ficção Científica</option>
                                <option value="aventura" <?php if ($movie['genre'] == 'aventura') echo 'selected'; ?>>Aventura</option>
                            </select>
                    </div> <br>
                    <div class="Inputbox">
                        <label for="number" name="release_year">Ano de Lançamento:</label>
                            <input type="number" name="release_year" value="<?php echo ($movie['release_year']); ?>" class="InputUser" required> 
                    </div> 
                    <div class="Inputbox"><br>
                        <label for="description" name="description">Descrição:</label> <br>
                            <textarea name="description" cols="60" rows="2" class="InputUser"><?php echo ($movie['description']); ?></textarea>
                    </div><br>
                        <label for="rating" name="rating">Avaliação:</label>
                    <div class="rating">
                        <?php
                            for ($i = 5; $i >= 1; $i--) {
                                echo '<input type="radio" id="star' . $i . '" name="rating" value="' . $i . '" ' . ($movie['rating'] == $i ? 'checked' : '') . '>';
                                echo '<label for="star' . $i . '">&#9733;</label>';
                            }
                        ?>
                    </div> <br><br>
                    <div class="status">
                    <label for="status">Status:</label>
                        <label for="Nao Assistido">Não Assistido</label>
                        <input type="radio" name="status-option" value="Nao Assistido" <?php if ($movie['status_option'] == 'Nao Assistido') echo 'checked'; ?>>
                        <label for="Assistido">Assistido</label>
                        <input type="radio" name="status-option" value="Assistido" <?php if ($movie['status_option'] == 'Assistido') echo 'checked'; ?>>
                    </div> <br><br>
                     <div class="buttons"> 
                        <a class="voltar" href="../../detail/detail_films/detail_films.php">Voltar</a>
                        <button><input type="reset" value="Limpar" id="clear-button"></button>
                        <button><input type="submit" value="Salvar" id="save-button"></button>
                    </div>                      
                </fieldset>
            </form>
        </div>
    </section>
</body>
</html>
