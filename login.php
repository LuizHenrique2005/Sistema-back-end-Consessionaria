<?php

// Verifica se o usuário já está logado
// if (isset($_SESSION['usuario_id'])) {
//     header('Location: dashboard.php');  Redireciona para a página do painel
//     exit;
// }

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('config.php'); // Arquivo de configuração com conexão ao banco de dados

    $E_mail = $_POST['E_mail'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar o login
    $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE E_mail = ? AND senha = ?");
    $stmt->bind_param("ss", $E_mail, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Login bem-sucedido
        header('Location: pagina1.php');
        exit;
    } else {
        $erro = 'E-mail e/ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($erro)) : ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="E_mail">E-mail:</label>
        <input type="text" id="E_mail" name="E_mail" required><br>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <br>
        <button type="submit">Entrar</button>
        <a href="Clientes.php">
                <input type="button" value="Cadastro">
                </a>
    </form>
</body>
</html>