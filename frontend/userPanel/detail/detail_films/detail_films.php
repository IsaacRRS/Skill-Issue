<?php
session_start();
require '../../../../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../telaLogin/index.html');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM movies WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="title">
            <a href="#"><img src="../../../assets/icone_swap.png" alt="logo_swapfilms" class="logo"></a>
            <a class="voltar" href="../../../home/index.html"><i class="bi bi-arrow-up-left-square"></i></a>
    </div>
            <div class="table-container">
                <legend><b>Detalhes do Filme</b></legend>
                <table class="datatable">
                    <thead>
                        <tr>
                            <th>n°</th>
                            <th>Nome</th>
                            <th>Gênero</th>
                            <th>Avaliação</th>
                            <th>Assistido</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counter = 1;
                    while ($movie = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($movie['name']); ?></td>
                        <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                        <td><?php echo htmlspecialchars($movie['rating']); ?></td>
                        <td><?php echo htmlspecialchars($movie['status']); ?></td>
                        <td>
                            <a class="button-edit" href="../../update/update_films/update_films.php?id=<?php echo $movie['id']; ?>">Editar</a>
                            <a class="button-delete" href="../../delete/delete_movie.php?id=<?php echo $movie['id']; ?>">Deletar</a>
                        </td>
                    </tr>
                    <?php
                    endwhile; 
                    ?>
                    </tbody>
                </table>
        </header>
    </section>
    </div>
</body>
</html>
