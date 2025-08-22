<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Número Perfeito</title>
</head>
<body>
    <form method="post">
        <label for="numero">Digite um número para verificar se é perfeito: </label>
        <input type="number" name="numero" required>
        <button type="submit" name="verificar">Verificar</button>
    </form>
    <?php
if (isset($_POST['verificar'])) {   // 1. Obter o número do usuário
    $numero = intval($_POST['numero']);  // Converte a entrada para um número inteiro 
    if ($numero <= 0) {  // 2. Verificar se o número é positivo (números perfeitos são positivos)
        echo "Por favor, digite um número inteiro positivo.";
    } else {    // 3. Encontrar os divisores e somá-los (excluindo o próprio número)
        $somaDivisores = 0;
        for ($i = 1; $i < $numero; $i++) { // Percorremos de 1 até n-1
            if ($numero % $i == 0) { // Se $i for um divisor de $numero
                $somaDivisores += $i; // Adiciona $i à soma dos divisores
            }
        }
        
        if ($somaDivisores == $numero) { // 4. Comparar a soma dos divisores com o número original
            echo "O número $numero é um número perfeito! (Soma dos divisores: $somaDivisores)";
        } else {
            echo "O número $numero não é um número perfeito. (Soma dos divisores: $somaDivisores)";
        }
    }
}
?>

</body>
</html>