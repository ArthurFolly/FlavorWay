<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Média Ponderada</title>
</head>
<body>
    <h1>Calculadora de Média Ponderada</h1>
    <p>Insira as notas (0 a 10) e seus respectivos pesos (não negativos).</p>
    <p>Preencha apenas os campos que você deseja calcular. Campos vazios serão ignorados.</p>

    <form method="post">
        <p>
            Nota 1: <input type="number" name="notas[]" step="0.01">
            Peso 1: <input type="number" name="pesos[]" step="0.01">
        </p>
        <p>
            Nota 2: <input type="number" name="notas[]" step="0.01">
            Peso 2: <input type="number" name="pesos[]" step="0.01">
        </p>
        <p>
            Nota 3: <input type="number" name="notas[]" step="0.01">
            Peso 3: <input type="number" name="pesos[]" step="0.01">
        </p>
        <p>
            Nota 4: <input type="number" name="notas[]" step="0.01">
            Peso 4: <input type="number" name="pesos[]" step="0.01">
        </p>
        <p>
            Nota 5: <input type="number" name="notas[]" step="0.01">
            Peso 5: <input type="number" name="pesos[]" step="0.01">
        </p>

        <button type="submit" name="calcular">Calcular Média</button>
    </form>

    <?php
if (isset($_POST['calcular'])) {
    $notas_enviadas = $_POST['notas'] ?? [];
    $pesos_enviados = $_POST['pesos'] ?? [];

    $somaProdutos = 0;
    $somaPesos = 0;
    $numParesValidos = 0;
    $erros = [];

    // O contador para o loop while
    $i = 0;
    // O número total de campos a verificar (o menor entre o count de notas e pesos)
    $totalCampos = min(count($notas_enviadas), count($pesos_enviados));

    echo "<hr>";
    echo "<h2>Resultado:</h2>";

    // O loop while começa aqui
    while ($i < $totalCampos) {
        $nota_str = trim($notas_enviadas[$i]);
        $peso_str = trim($pesos_enviados[$i]);

        // Ignora pares de campos que estão completamente vazios
        if ($nota_str === '' && $peso_str === '') {
            $i++; // Importante: incrementar o contador mesmo se ignorar
            continue;
        }

        // Validação e conversão
        if (!is_numeric($nota_str) || $nota_str === '') {
            $erros[] = "A Nota " . ($i + 1) . " não é um número válido ou está vazia.";
            $i++; // Importante: incrementar o contador em caso de erro
            continue;
        }
        if (!is_numeric($peso_str) || $peso_str === '') {
            $erros[] = "O Peso " . ($i + 1) . " não é um número válido ou está vazio.";
            $i++; // Importante: incrementar o contador em caso de erro
            continue;
        }

        $nota = floatval($nota_str);
        $peso = floatval($peso_str);

        // Validação de regras de negócio
        if ($nota < 0 || $nota > 10) {
            $erros[] = "A Nota " . ($i + 1) . " ($nota) deve estar entre 0 e 10.";
            $i++; // Importante: incrementar o contador em caso de erro
            continue;
        }
        if ($peso < 0) {
            $erros[] = "O Peso " . ($i + 1) . " ($peso) não pode ser negativo.";
            $i++; // Importante: incrementar o contador em caso de erro
            continue;
        }

        // Se chegou até aqui, o par é válido
        $somaProdutos += ($nota * $peso);
        $somaPesos += $peso;
        $numParesValidos++;

        $i++; // **MUITO IMPORTANTE:** Incrementar o contador para avançar no loop
    }
    // O loop while termina aqui

    if (!empty($erros)) {
        echo "<p><strong>Problemas encontrados:</strong></p>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>" . $erro . "</li>";
        }
        echo "</ul>";
    }

    if ($numParesValidos === 0) {
        echo "<p>Nenhum par de nota e peso válido foi inserido para o cálculo.</p>";
    } elseif ($somaPesos == 0) {
        echo "<p>Erro: A soma dos pesos é zero. Não é possível calcular a média ponderada.</p>";
    } else {
        $mediaPonderada = $somaProdutos / $somaPesos;
        echo "<p>Notas processadas: " . $numParesValidos . "</p>";
        echo "<p>Soma (Nota x Peso): " . number_format($somaProdutos, 2, ',', '.') . "</p>";
        echo "<p>Soma dos Pesos: " . number_format($somaPesos, 2, ',', '.') . "</p>";
        echo "<h3>Média Ponderada: <strong>" . number_format($mediaPonderada, 2, ',', '.') . "</strong></h3>";
    }
}
?>

</body>
</html>