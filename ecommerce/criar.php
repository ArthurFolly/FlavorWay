<?php
    include "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-bbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Adicionar Produto</title>
</head>
<body>
    <h2>Adicionar Produto</h2>
    <form action="" method="post">
        <p>Nome: <input type="text" name="nome"></p>
        <p>Preço: <input type="text" name="preco"></p>
        <p>Descrição</p>
        <p><textarea name="descricao" cols="30" rows="5"></textarea></p>
        <p><button type="submit">Salvar</button></p>
    </form>    
</body>
</html>
<?php
    if($_POST) {
        $nome= $_POST["nome"];
        $preco= $_POST["preco"];
        $descricao= $_POST["descricao"];
        $sql= "INSERT INTO produtos (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";
        if($connection->query($sql)) {
            
            echo "<script>
                    alert('Produto adicionado com sucesso');
                    window.location.href = 'index.php';
                </script>";
        } else {
            echo "Erro ao adicionar produto" . $connection->error;
        }
        $connection->close();    
    }
    

?>