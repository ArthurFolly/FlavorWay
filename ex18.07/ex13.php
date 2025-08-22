<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Temperatura</title>
</head>
<body>
    <h1>Tabela de Conversão de Temperatura</h1>
    <p>Conversão de Celsius para Fahrenheit (de 0°C a 100°C, incrementos de 5°C).</p>

    <form method="post">
        <button type="submit" name="gerar_tabela">Gerar Tabela de Conversão</button>
    </form>

    <?php
    if (isset($_POST['gerar_tabela'])) {
        echo "<hr>";
        echo "<h2>Tabela de Conversão:</h2>";
        echo "<table border='1'>"; // Usamos border='1' para uma tabela básica sem CSS
        echo "<tr><th>Celsius (°C)</th><th>Fahrenheit (°F)</th></tr>"; // Cabeçalho da tabela

        // Loop for para iterar de 0 a 100 com incremento de 5
        for ($celsius = 0; $celsius <= 100; $celsius += 5) {
            // Fórmula de conversão: F = (C * 9/5) + 32
            $fahrenheit = ($celsius * 9 / 5) + 32;

            echo "<tr>";
            echo "<td>" . $celsius . "</td>"; // Coluna Celsius
            echo "<td>" . number_format($fahrenheit, 2, ',', '.') . "</td>"; // Coluna Fahrenheit (formatado)
            echo "</tr>";
        }

        echo "</table>";
        echo "<hr>";
    }
    ?>
</body>
</html>