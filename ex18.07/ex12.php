<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números Primos no Intervalo</title>
</head>
<body>
    <h1>Números Primos em um Intervalo</h1>
    <p>Digite dois números inteiros (A e B) e exibiremos todos os números primos no intervalo entre eles.</p>

    <form method="post">
        <label for="a">Início do Intervalo (A):</label>
        <input type="number" name="a" id="a" required>
        <br><br>
        <label for="b">Fim do Intervalo (B):</label>
        <input type="number" name="b" id="b" required>
        <br><br>
        <button type="submit" name="buscar_primos">Buscar Primos</button>
    </form>

    <?php
    if (isset($_POST['buscar_primos'])) {
        $aOriginal = $_POST['a'] ?? '';
        $bOriginal = $_POST['b'] ?? '';
        $a = intval($aOriginal);
        $b = intval($bOriginal);
        $erros = [];
        $primosEncontrados = [];

        echo "<hr>";
        echo "<h2>Números Primos entre " . htmlspecialchars($aOriginal) . " e " . htmlspecialchars($bOriginal) . ":</h2>";

        // Validação inicial
        if (!is_numeric($aOriginal) || $aOriginal === '' || !is_numeric($bOriginal) || $bOriginal === '') {
            $erros[] = "Por favor, digite valores numéricos válidos para A e B.";
        } elseif ($a < 1 || $b < 1) { // Primos são definidos para números > 1, mas permitimos 1 como limite.
            $erros[] = "Por favor, digite números inteiros positivos para A e B (maiores que 0).";
        } elseif ($a > $b) {
            $erros[] = "O valor de A deve ser menor ou igual ao valor de B.";
        }

        if (!empty($erros)) {
            echo "<p><strong>Problemas encontrados:</strong></p>";
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . $erro . "</li>";
            }
            echo "</ul>";
        } else {
            // Garante que o intervalo comece a partir de 2, pois é o primeiro número primo.
            // Se 'a' for 1 ou 0, começamos a verificar a partir de 2.
            $inicioBusca = max(2, $a);

            // Loop for externo para iterar em cada número no intervalo
            for ($num = $inicioBusca; $num <= $b; $num++) {
                $ehPrimo = true; // Assume que o número é primo inicialmente

                // Condição especial para 2, o único primo par
                if ($num == 2) {
                    $ehPrimo = true;
                }
                // Números menores que 2 não são primos
                else if ($num < 2) {
                    $ehPrimo = false;
                }
                // Números pares maiores que 2 não são primos
                else if ($num % 2 == 0) {
                    $ehPrimo = false;
                }
                // Loop for interno para verificar a primalidade
                // Itera de 3 até a raiz quadrada do número (pulando de 2 em 2, apenas ímpares)
                else {
                    for ($divisor = 3; $divisor * $divisor <= $num; $divisor += 2) {
                        if ($num % $divisor == 0) {
                            $ehPrimo = false; // Não é primo
                            break; // Sai do loop interno, pois já encontrou um divisor
                        }
                    }
                }

                if ($ehPrimo) {
                    $primosEncontrados[] = $num;
                }
            }

            if (empty($primosEncontrados)) {
                echo "<p>Nenhum número primo encontrado no intervalo de " . $a . " a " . $b . ".</p>";
            } else {
                echo "<p>Números primos: <strong>" . implode(", ", $primosEncontrados) . "</strong></p>";
            }
        }
        echo "<hr>";
    }
    ?>
</body>
</html>