<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soma de Dígitos</title>
</head>
<body>
    <h1>Soma dos Dígitos de um Número</h1>
    <p>Digite um número inteiro e calcularemos a soma de seus dígitos.</p>

    <form method="post">
        <label for="numero">Digite o número:</label>
        <input type="number" name="numero" id="numero" required>
        <button type="submit" name="somar_digitos">Calcular Soma</button>
    </form>

    <?php
if (isset($_POST['somar_digitos'])) {
    // Pega o número do formulário e converte para inteiro
    // intval() é importante para garantir que é um número e tratar entradas não-numéricas como 0
    $numeroOriginal = $_POST['numero'] ?? 0;
    $numero = intval($numeroOriginal);

    $somaDigitos = 0;
    $erros = [];

    echo "<hr>"; // Linha divisória simples
    echo "<h2>Resultado:</h2>";

    // Validação básica
    if (!is_numeric($numeroOriginal)) {
        $erros[] = "Por favor, digite um valor numérico válido.";
    } elseif ($numero < 0) {
        $erros[] = "Por favor, digite um número inteiro não negativo.";
        // Para somar dígitos de números negativos, podemos usar abs()
        // $numero = abs($numero); // Se você quiser somar dígitos de números negativos
    }

    if (!empty($erros)) {
        echo "<p><strong>Problemas encontrados:</strong></p>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>" . $erro . "</li>";
        }
        echo "</ul>";
    } else {
        // Se o número for 0, a soma dos dígitos é 0. O loop while não rodaria.
        if ($numero == 0) {
            $somaDigitos = 0;
        } else {
            // Lógica para somar os dígitos usando um loop while
            $tempNumero = $numero; // Usamos uma variável temporária para não modificar o original
            while ($tempNumero > 0) {
                // 1. Pega o último dígito
                // O operador de módulo (%) retorna o resto da divisão.
                // Ex: 123 % 10 = 3
                $digito = $tempNumero % 10;

                // 2. Adiciona o dígito à soma
                $somaDigitos += $digito;

                // 3. Remove o último dígito do número
                // intval() ou (int) garante que o resultado da divisão seja um inteiro, truncando decimais.
                // Ex: 123 / 10 = 12.3 -> intval(12.3) = 12
                $tempNumero = intval($tempNumero / 10);
            }
        }

        echo "<p>O número digitado foi: <strong>" . htmlspecialchars($numeroOriginal) . "</strong></p>";
        echo "<p>A soma dos dígitos de <strong>" . $numero . "</strong> é: <strong>" . $somaDigitos . "</strong></p>";
    }
    echo "<hr>";
}
?>

</body>
</html>