<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aproximação de Pi</title>
</head>
<body>
    <h1>Cálculo de Aproximação de Pi (Série de Leibniz)</h1>
    <p>Utilize a série de Leibniz para calcular uma aproximação de Pi com um número de iterações fornecido.</p>
    <p>Quanto maior o número de iterações, mais precisa a aproximação.</p>

    <form method="post">
        <label for="iteracoes">Número de Iterações (N):</label>
        <input type="number" name="iteracoes" id="iteracoes" required min="1">
        <button type="submit" name="calcular_pi">Calcular Pi</button>
    </form>

    <?php
    if (isset($_POST['calcular_pi'])) {
        $nIteracoesOriginal = $_POST['iteracoes'] ?? '';
        $nIteracoes = intval($nIteracoesOriginal);
        $aproximacaoPi = 0;
        $erros = [];

        echo "<hr>";
        echo "<h2>Aproximação de Pi com " . htmlspecialchars($nIteracoesOriginal) . " iterações:</h2>";

        // Validação
        if (!is_numeric($nIteracoesOriginal) || $nIteracoesOriginal === '') {
            $erros[] = "Por favor, digite um valor numérico válido para as iterações.";
        } elseif ($nIteracoes <= 0) {
            $erros[] = "O número de iterações deve ser um inteiro positivo.";
        }

        if (!empty($erros)) {
            echo "<p><strong>Problemas encontrados:</strong></p>";
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . $erro . "</li>";
            }
            echo "</ul>";
        } else {
            // Loop for para aplicar a série de Leibniz
            for ($i = 0; $i < $nIteracoes; $i++) {
                // O denominador começa em 1, depois 3, 5, 7...
                $denominador = (2 * $i) + 1;

                // O sinal alterna (+, -, +, -...)
                // Se 'i' é par (0, 2, 4...), o termo é positivo.
                // Se 'i' é ímpar (1, 3, 5...), o termo é negativo.
                if ($i % 2 == 0) {
                    $aproximacaoPi += (1 / $denominador);
                } else {
                    $aproximacaoPi -= (1 / $denominador);
                }
            }

            // Multiplica o resultado por 4 para obter a aproximação de Pi
            $aproximacaoPi = $aproximacaoPi * 4;

            echo "<p>Número de iterações: <strong>" . $nIteracoes . "</strong></p>";
            echo "<p>Aproximação de Pi: <strong>" . number_format($aproximacaoPi, 10, ',', '.') . "</strong></p>";
            echo "<p>Valor real de Pi (para comparação): <strong>" . number_format(M_PI, 10, ',', '.') . "</strong></p>"; // M_PI é uma constante do PHP para Pi
        }
        echo "<hr>";
    }
    ?>
</body>
</html>