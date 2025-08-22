<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirâmide de Números</title>
</head>
<body>
    <h1>Exibição de Pirâmide de Números</h1>
    <p>Digite um número N para exibir uma pirâmide numérica até N.</p>

    <form method="post">
        <label for="n">Digite N:</label>
        <input type="number" name="n" id="n" required min="1">
        <button type="submit" name="gerar_piramide">Gerar Pirâmide</button>
    </form>

    <?php
    if (isset($_POST['gerar_piramide'])) {
        $nOriginal = $_POST['n'] ?? '';
        $n = intval($nOriginal);
        $erros = [];

        echo "<hr>";
        echo "<h2>Pirâmide para N = " . htmlspecialchars($nOriginal) . ":</h2>";

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
            // Loop for externo para as linhas da pirâmide
            for ($linha = 1; $linha <= $n; $linha++) {
                // Loop for interno para os números em cada linha
                for ($coluna = 1; $coluna <= $linha; $coluna++) {
                    echo $coluna . " "; // Exibe o número e um espaço
                }
                echo "<br>"; // Quebra de linha para a próxima linha da pirâmide
            }
        }
        echo "<hr>";
    }
    ?>
</body>
</html>