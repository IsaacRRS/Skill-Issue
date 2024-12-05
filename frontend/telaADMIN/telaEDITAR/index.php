<?php 

session_start();
require_once '../../../backend/db.php';

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

if (!isset($_GET['id'])) {
      echo "ID de usuário não fornecido.";
      exit();
}

$edit_user_id = $_GET['id'];

$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $edit_user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

if (!$name) {
    echo "Usuário não encontrado.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($email)) {
      echo "<script>alert('Nome e email são obrigatórios.');</script>";
        exit;
    } else {
        if (!empty($password)) {
            $hashedPassword = md5($password);
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $hashedPassword, $edit_user_id);
         } else {
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $email, $edit_user_id);
         }

         if ($stmt->execute()) {
                  echo "<script>
                        alert('Perfil atualizado com sucesso.');
                        window.location.href = '../../telaADMIN/index.php';
                      </script>";
         } else {
               echo "<script>alert('Erro ao atualizar perfil.');</script>";
         }

         $stmt->close();
      }
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar Perfil</title>
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>

    <div class="title">
        <h3>Edição de Usuários</h3>
        <a href="../../telaLogin/escolhaLogin/index.html"><i class="bi bi-arrow-up-left-square"></i></a>
    </div>
   
<div class="atualizar-perfil">
   <form action="" method="post">      
      <div class="flex">
         <div class="inputBox">
            <h2>Atualizar dados</h2>
            <span>Nome</span>
            <input type="text" id="newName" name="name" value="<?php echo ($name); ?>" class="caixa">
            <span>Email</span>
            <input type="email" id="newEmail" name="email" value="<?php echo ($email) ?>" class="caixa">
            <span>Senha</span>
            <input type="password" id="newPassword" name="password" placeholder="Se necessário, digite uma nova senha" class="caixa">
        </div>
      </div>

      <div class="botao-container">
        <a href="../../telaADMIN/index.php" class="voltar-botao">Voltar</a>
        <input type="submit" value="Editar perfil" name="atualizarPerfil" class="botao">
      </div>

   </form>

</div>

</body>
</html>