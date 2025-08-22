<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Média escolar</h2>
    <form method="post">
        <label for="nota">Digite sua nota(0-10): </label>
        <input type="number" name="nota">
        <button type="submit" name="enviar">Enviar</button>
    </form>        

<?php
if (isset($_POST['enviar'])) {
    $nota = $_POST['nota'];

    switch ($nota) {
        case 10:
            echo "Excelente! Você tirou 10.<br>";
            break;
        case 9:
            echo "Muito bom! Você tirou 9.<br>";
            break;
        case 8:
            echo "Bom trabalho! Você tirou 8.<br>";
            break;
        case 7:
            echo "Você tirou 7. Continue se esforçando!<br>";
            break;
        case 6: 
            echo "Você tirou 6. É necessário melhorar!<br>";
            break;
        case 5:
            echo "Você tirou 5. É preciso estudar mais!<br>";
            break;
        case 4:
            echo "Você tirou 4. É necessário muito mais esforço!<br>";  
            break;
        case 3: 
            echo "Você tirou 3. É preciso estudar muito!<br>";
            break;
        case 2:
            echo "Você tirou 2. É necessário um grande esforço!<br>";
            break;
        case 1:  
            echo "Você tirou 1. É necessário um esforço extremo!<br>";
            break;
        case 0:
            echo "Você tirou 0. Reprovado<br>";
        default:
            echo "Operação inválida!<br>";
    }
}
?>   
</body>
</html>