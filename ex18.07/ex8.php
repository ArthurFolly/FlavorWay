<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número Palíndromo</title>
</head>
<body>
    <h1>Verificador de Número Palíndromo</h1>
    <p>Digite um número inteiro e verificaremos se ele é um palíndromo (lido da mesma forma de trás para frente).</p>

    <form method="post">
        <label for="numero">Digite o número:</label>
        <input type="number" name="numero" id="numero" required>
        <button type="submit" name="verificar_palindromo">Verificar</button>
    </form>

    <?php
    if (isset($_POST['verificar_palindromo'])) {
        $numeroOriginalStr = $_POST['numero'] ?? '';
        $numeroOriginal = intval($numeroOriginalStr);
        $numeroInvertido = 0;
        $tempNumero = abs($numeroOriginal); // Usamos abs para lidar com negativos, se houver

        echo "<hr>";
        echo "<h2>Resultado:</h2>";

        // Validação
        if (!is_numeric($numeroOriginalStr) || $numeroOriginalStr === '') {
            echo "<p>Por favor, digite um valor numérico válido.</p>";
        } else {
            // Se o número for 0, é um palíndromo. O do-while abaixo funcionaria, mas é bom tratar.
            if ($numeroOriginal == 0) {
                $numeroInvertido = 0;
            } else {
                // Loop do-while para inverter o número
                do {
                    $digito = $tempNumero % 10; // Pega o último dígito
                    $numeroInvertido = ($numeroInvertido * 10) + $digito; // Adiciona ao número invertido
                    $tempNumero = intval($tempNumero / 10); // Remove o último dígito
                } while ($tempNumero > 0);
            }

            echo "<p>O número digitado foi: <strong>" . htmlspecialchars($numeroOriginalStr) . "</strong></p>";
            echo "<p>Número original (abs): " . abs($numeroOriginal) . "</p>"; // Mostra o valor absoluto
            echo "<p>Número invertido: " . $numeroInvertido . "</p>";

            // Comparação para verificar se é palíndromo
            // Comparamos o valor absoluto do original com o invertido
            if (abs($numeroOriginal) == $numeroInvertido) {
                echo "<h3>O número <strong>" . htmlspecialchars($numeroOriginalStr) . "</strong> É um Palíndromo!</h3>";
            } else {
                echo "<h3>O número <strong>" . htmlspecialchars($numeroOriginalStr) . "</strong> NÃO é um Palíndromo.</h3>";
            }
        }
        echo "<hr>";
    }
    ?>

</body>
</html>