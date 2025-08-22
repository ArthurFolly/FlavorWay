<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Meses do Ano</h2>
    <form method="post">
        <input type="number" name = "mes" placeholder="Digite um número de 1 a 12">
        <button type="submit" name="enviar">Ver Mês</button>
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        $mes = $_POST['mes'];
        
        switch ($mes) {
            case 1: 
                echo "Janeiro, Verão.<br>";
                break;
            case 2: 
                echo "Fevereiro, Verão.<br>";
                break;
            case 3:
                echo "Março, Outono.<br>";
                break;
            case 4:
                echo "Abril, Outono.<br>";
                break;
            case 5:
                echo "Maio, Outono.<br>";
                break;
            case 6:     
                echo "Junho, Inverno.<br>";
                break;                  
            case 7:         
                echo "Julho, Inverno.<br>";
                break;
            case 8:
                echo "Agosto, Inverno.<br>";
                break;
            case 9:
                echo "Setembro, Primavera.<br>";
                break;
            case 10:
                echo "Outubro, Primavera<br>";
                break;
            case 11:
                echo "Novembro, Primavera<br>";
                break;
            case 12:
                echo "Dezembro, Verão.<br>";
                break;
            default:
                echo "Número inválido! Por favor, digite um número entre 1 e 12.<br>";
        }
    }
    ?>
</body>
</html>