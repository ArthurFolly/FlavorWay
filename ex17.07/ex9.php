<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "post">
        <label for="numero1">Digite uma das linguas: Espanhol, Português, Inglês e Francês(sem acentos)</label>
        <input type="text" name = "escolha">
        <button type="submit" name="confirmar">Confirmar</button>
    </form>      
    <?php
    if (isset($_POST['confirmar'])) {
        $escolha = strtolower($_POST["escolha"]);

        switch ($escolha) {
            case "espanhol":
                echo "Você escolheu o idioma: Espanhol, 'Hola!'<br>";
                break;
            case "portugues":
                echo "Você escolheu o idioma: Português, 'Olá!'<br>";
                break;
            case "ingles":
                echo "Você escolheu o idioma: Inglês, 'Hi!'<br>";
                break;
            case "frances":
                echo "Você escolheu o idioma: Francês, 'Bonjour!'<br>";
                break;
            default:
                echo "Opção inválida! Por favor, escolha entre Espanhol, Português, Inglês e Francês(sem acentos)";
        }
    }
    ?>    
</body>
</html>