<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>1. Dia da Semana</h2>
    <form method="post">
        <input type="number" name = "dia" placeholder="Digite um número de 1 a 7">
        <button type="submit" name="ex1">Ver Dia</button>
    </form>
    <?php
    if (isset($_POST['ex1'])) {
        $dia = $_POST['dia'];
        
        switch ($dia) {
            case 1: 
                echo "Domingo<br>"; 
                break;
            case 2: 
                echo "Segunda-feira<br>"; 
                break;
            case 3: 
                echo "Terça-feira<br>"; 
                break;
            case 4: 
                echo "Quarta-feira<br>"; 
                break;
            case 5: 
                echo "Quinta-feira<br>"; 
                break;
            case 6: 
                echo "Sexta-feira<br>"; 
                break;
            case 7: 
                echo "Sábado<br>"; 
                break;
            default: 
                echo "Número inválido!<br>";
        }
    }
    ?>
</body>
</html>