<?php
    include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-bbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Listar Produtos</title>
</head>
<body>
    <h2>Lista de Produtos</h2>
    <button class="contraste"><a href=" criar.php">Adicionar Produto</a></button>
    <table>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr> 
    
    <?php
    $sql= "SELECT * FROM produtos";
    $result= $connection->query($sql);
    while($row= $result->fetch_assoc()){
        echo "<tr>
            <td>{$row['nome']}</td>
            <td>{$row['preco']}</td>
            <td>{$row['descricao']}</td>
            <td>
                <a href='editar.php?id={$row['id']}'>Editar</a>
                <a href='delete.php?id={$row['id']}'onclick=\"return confirm('Tem certeza que quer deletar este item?')\">Deletar</a>
            </td>
        </tr>";
        }
    ?>
    </table>
</body>
</html>
