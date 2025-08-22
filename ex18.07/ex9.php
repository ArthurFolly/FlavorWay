<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sequência de Collatz</title>
</head>
<body>
    <h1>Gerador da Sequência de Collatz</h1>
    <p>Peça um número N e gere a sequência de Collatz até que N se torne 1.</p>
    <p>Regras: 1. Se N for par, divida por 2. 2. Se N for ímpar, multiplique por 3 e some 1.</p>

    <form method="post">
        <label for="numero">Digite o número inicial (N):</label>
        <input type="number" name="numero" id="numero" required min="1">
        <button type="submit" name="gerar_collatz">Gerar Sequência</button>
    </form>

    <?php
    if (isset($_POST['gerar_collatz'])) {
        $nOriginal = $_POST['numero'] ?? 0;
        $n = intval($nOriginal);
        $sequencia = [];
        $erros = [];

        echo "<hr>";
        echo "<h2>Sequência de Collatz para " . htmlspecialchars($nOriginal) . ":</h2>";

        // Validação
        if (!is_numeric($nOriginal) || $nOriginal === '') {
            $erros[] = "Por favor, digite um valor numérico válido.";
        } elseif ($n <= 0) {
            $erros[] = "Por favor, digite um número inteiro positivo para N.";
        }

        if (!empty($erros)) {
            echo "<p><strong>Problemas encontrados:</strong></p>";
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . $erro . "</li>";
            }
            echo "</ul>";
        } else {
            // Loop do-while para gerar a sequência de Collatz
            do {
                $sequencia[] = $n; // Adiciona o número atual à sequência
                if ($n == 1) {
                    break; // Se já chegou a 1, sai do loop
                }
                if ($n % 2 == 0) { // Se n é par
                    $n = $n / 2;
                } else { // Se n é ímpar
                    $n = ($n * 3) + 1;
                }
            } while (true); // O loop continua indefinidamente até um 'break' ou 'return'

            // Exibir a sequência
            echo "<p>Sequência: ";
            echo implode(" -> ", $sequencia); // Junta os elementos do array com " -> "
            echo "</p>";
        }
        echo "<hr>";
    }
    ?>

</body>
</html>