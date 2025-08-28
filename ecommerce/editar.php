<?php
    include "conexao.php";
    $id= $_GET["id"];
    $sql= "SELECT * FROM produtos WHERE id=$id";
    $result= $connection->query($sql);//busca os dados no banco de dados
    $produto= $result->fetch_assoc();//pega os dados e armazena em produto*

    if($_POST) {
        $nome= $_POST["nome"];
        $preco= $_POST["preco"];
        $descricao= $_POST["descricao"];

        $sql= "UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao' WHERE id=$id";
        if($connection->query($sql)) {
            echo "<script>
                    alert('Produto atualizado com sucesso');
                    window.location.href = 'index.php';
                </script>";
        } else {
            echo "Erro ao atualizar o produto, tente novamente" . $connection->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-bbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <form action="" method="post">
        <p>Nome: <input type="text" name="nome" value="<?= $produto['nome']?>"></p>
        <p>Preço: <input type="text" name="preco" value="<?= $produto['preco']?>"></p>
        <p>Descrição:</p>
        <p><textarea name="descricao" cols="30" rows="5"><?= $produto['descricao']?></textarea></p>
        <p><button type="submit">Atualizar</button></p>
    </form>    
</body>
</html>
