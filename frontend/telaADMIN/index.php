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

$query = 'SELECT id, name, email FROM users';
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuário</title>
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="title">
        <h3>Gerenciamento de Usuários</h3>
        <a href="../telaLogin/index.html"><i class="bi bi-arrow-up-left-square"></i></a>
    </div>
    <main class="main-conteudo">
      <form>
          <div class="conteudo">
              <table class="conteudo-table">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nome</th>
                      <th scope="col">E-mail</th>
                      <th class="detalhes" colspan="3" scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                      <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                          <a href="../../backend/telaLogin/loginAsUser.php?id=<?php echo $user['id']; ?>" class="ver">Entrar</a>
                          <a href="telaEDITAR/index.php?id=<?php echo $user['id']; ?>" class="editar">Editar</a>
                          <a href="../../backend/telaADMIN/delete_user.php?id=<?php echo $user['id']; ?>" class="excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                      </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
          </div>
        </form>
    </main>
</body>
</html> 