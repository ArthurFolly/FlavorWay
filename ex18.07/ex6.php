<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Simples</title>
</head>
<body>
    <h1>Login Simples</h1>

    <?php
    $usuarioCorreto = "aluno";
    $senhaCorreta = "1234";

    // Inicializa as variáveis para a primeira tentativa ou se não houver POST
    $usuarioDigitado = $_POST['usuario'] ?? '';
    $senhaDigitada = $_POST['senha'] ?? '';
    $tentouLogar = isset($_POST['logar']); // Verifica se o formulário foi submetido

    // Usamos uma flag para controlar o do-while
    $loginSucesso = false;
    $mensagem = "";

    // O do-while aqui controla a lógica de verificação
    // Ele será executado pelo menos uma vez (na submissão do formulário)
    do {
        if ($tentouLogar) { // Se o formulário foi submetido
            if ($usuarioDigitado === $usuarioCorreto && $senhaDigitada === $senhaCorreta) {
                $loginSucesso = true;
                $mensagem = "Login realizado com sucesso! Bem-vindo(a), " . htmlspecialchars($usuarioDigitado) . "!";
            } else {
                $mensagem = "<p>Usuário ou senha incorretos. Tente novamente.</p>";
            }
        }
        // A condição do while está fora do loop no PHP para o formulário.
        // Se $loginSucesso for falso, o formulário é exibido novamente.
        // Se for verdadeiro, a mensagem de sucesso é exibida e o formulário não.

    } while (false); // Este do-while serve apenas para estruturar a primeira verificação.
                     // A repetição 'visual' é controlada pela exibição condicional do formulário.

    if (!$loginSucesso) {
        echo $mensagem; // Exibe mensagem de erro da tentativa anterior
    ?>
        <form method="post">
            <p>
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" required value="<?php echo htmlspecialchars($usuarioDigitado); ?>">
            </p>
            <p>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </p>
            <button type="submit" name="logar">Entrar</button>
        </form>
    <?php
    } else {
        echo "<p>" . $mensagem . "</p>";
    }
    ?>

</body>
</html>