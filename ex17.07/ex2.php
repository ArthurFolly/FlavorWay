<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Calculadora simples</h2>
    <form method="post">
        <label for="numero1">Digite um número: </label>
        <input type="number" name = "num1">
        <label for="numero1">Digite outro número: </label>
        <input type="number" name = "num2">
        <label for="numero1">Digite para um cálculo simples: 1 para soma, 2 para subtração, 3 para multiplicação e 4 para divisão.</label>
        <input type="number" name = "op">
        <button type="submit" name="calcular">Calcular</button>
    </form>        

<?php
if (isset($_POST['calcular'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $op = $_POST['op'];

    switch ($op) {
        case 1:
            $resultado = $num1 + $num2;
            echo "A soma de $num1 e $num2 é igual a $resultado.<br>";
            break;
        case 2:
            $resultado = $num1 - $num2;
            echo "A subtração de $num1 e $num2 é igual a $resultado.<br>";
            break;
        case 3:
            $resultado = $num1 * $num2;
            echo "A multiplicação de $num1 e $num2 é igual a $resultado.<br>";
            break;
        case 4:
            if ($num2 != 0) {
                $resultado = $num1 / $num2;
                echo "A divisão de $num1 por $num2 é igual a $resultado.<br>";
            } else {
                echo "Divisão por zero não é permitida!<br>";
            }
            break;
        default:
            echo "Operação inválida!<br>";
    }
}
?>
</body>
</html>