<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method = "post">
    <label for="numero1">Digite uma letra entre A, B, C ou D:</label>
    <input type="text" name = "escolha">
    <button type="submit" name="confirmar">Confirmar</button>
</form>      
<?php
if (isset($_POST['confirmar'])) {
    $escolha = strtoupper($_POST["escolha"]);

    switch ($escolha) {
        case "A":
            echo "Você escolheu a letra A.<br>";
            break;
        case "B":
            echo "Você escolheu a letra B.<br>";
            break;
        case "C":
            echo "Você escolheu a letra C.<br>";
            break;
        case "D":
            echo "Você escolheu a letra D.<br>";
            break;
        default:
            echo "Opção inválida! Por favor, escolha entre A, B, C ou D.";
    }
}
?>
</body>
</html>