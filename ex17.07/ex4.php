<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <form method="post">
            <label for="cor">Digite um número entre 1 e 5:</label>
            <input type="number" name = "cor">
            <button type="submit" name="enviar">enviar</button>
        </form>      
        <?php
        if (isset($_POST["enviar"])) {
            $cor = $_POST["cor"];   

            switch ($cor) {
                case 1:
                    echo "Você escolheu a cor #0000FF(Azul).";
                    break;
                case 2:
                    echo "Você escolheu a cor #FF0000(Vermelho).";
                    break;
                case 3:
                    echo "Você escolheu a cor #FFFF00(Amarelo).";
                    break;
                case 4:
                    echo "Você escolheu a cor #00FF00(Verde).";
                    break;
                case 5:
                    echo "Você escolheu a cor #FFFFFF(Branco).";
                    break;
                default:
                    echo "Opção inválida! Por favor, cor entre 1 e 5.";
            }
        }
        ?>
</body>
</html>