<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once 'conexao.php';
    $nome = $_POST["nome"];
    $data_nascimento = $_POST["data_nascimento"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $numero_telefone = $_POST["numero_telefone"];
    $endereco = $_POST["endereco"];
    $cargo = $_POST["cargo"];
    $sql = "INSERT INTO cadastro_funcionarios (nome, data_nascimento, cpf, email, numero_telefone, endereco, cargo) 
            VALUES ('$nome', '$data_nascimento', '$cpf', '$email', '$numero_telefone', '$endereco', '$cargo')";

    if ($connection->query($sql)){
        echo "<script>alert('Dados cadastrado com sucesso!');</script>";
    } else {
        echo "<p>Erro ao cadastrar dados.</p>";
    }
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class = "mainform">
        <form action="" method="post">
            <h1>Cadastro de Funcionários</h1>
            <p><label for="nome">Nome Completo</label></p>
            <p><input type="text" name="nome" required></p>

            <p><label for="data">Data de Nascimento</label></p>
            <p><input type="date" name="data_nascimento"required></p>

            <p><label for="cpf">CPF</label></p>
            <p><input type="text" name="cpf" required maxlength="11"></p>

            <p><label for="email">E-mail</label></p>
            <p><input type="text" name="email" required></p>

            <p><label for="numero_telefone">Número de Telefone</label></p>
            <p><input type="tel" name="numero_telefone" required></p>

            <p><label for="endereco">Endereço</label></p>
            <p><input type="text" name="endereco" required></p>

            <p><label for="cargo">Cargo</label></p>
            <p><input type="text" name="cargo" required></p>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
