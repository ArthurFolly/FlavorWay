<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números Amigos</title>
</head>
<body>
    <h1>Verificação de Números Amigos</h1>
    <p>Digite dois números inteiros e verificaremos se são amigos.</p>
    <p>Um número é amigo de outro se a soma de seus divisores (excluindo ele mesmo) é igual ao outro número.</p>

    <form method="post">
        <label for="num1">Primeiro Número:</label>
        <input type="number" name="num1" id="num1" required min="1">
        <br><br>
        <label for="num2">Segundo Número:</label>
        <input type="number" name="num2" id="num2" required min="1">
        <br><br>
        <button type="submit" name="verificar_amigos">Verificar Amizade</button>
    </form>

    <?php
    // Função para calcular a soma dos divisores de um número
    // O uso de função ajuda a organizar o código e evitar repetição
    function calcularSomaDivisores($num) {
        $soma = 0;
        // Loop for para encontrar divisores
        for ($i = 1; $i < $num; $i++) { // Itera de 1 até num-1
            if ($num % $i == 0) {
                $soma += $i;
            }
        }
        return $soma;
    }

    if (isset($_POST['verificar_amigos'])) {
        $num1Original = $_POST['num1'] ?? '';
        $num2Original = $_POST['num2'] ?? '';
        $num1 = intval($num1Original);
        $num2 = intval($num2Original);
        $erros = [];

        echo "<hr>";
        echo "<h2>Verificação de " . htmlspecialchars($num1Original) . " e " . htmlspecialchars($num2Original) . ":</h2>";

        // Validação
        if (!is_numeric($num1Original) || $num1Original === '' || !is_numeric($num2Original) || $num2Original === '') {
            $erros[] = "Por favor, digite valores numéricos válidos para ambos os números.";
        } elseif ($num1 <= 0 || $num2 <= 0) {
            $erros[] = "Por favor, digite números inteiros positivos.";
        } elseif ($num1 == $num2) {
             $erros[] = "Os números são iguais. Números amigos geralmente são pares diferentes.";
        }


        if (!empty($erros)) {
            echo "<p><strong>Problemas encontrados:</strong></p>";
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . $erro . "</li>";
            }
            echo "</ul>";
        } else {
            // Calcula a soma dos divisores de cada número
            $somaDivisores1 = calcularSomaDivisores($num1);
            $somaDivisores2 = calcularSomaDivisores($num2);

            echo "<p>Soma dos divisores de " . $num1 . " (excluindo ele mesmo): <strong>" . $somaDivisores1 . "</strong></p>";
            echo "<p>Soma dos divisores de " . $num2 . " (excluindo ele mesmo): <strong>" . $somaDivisores2 . "</strong></p>";

            // Verifica a condição de números amigos
            // A condição é: soma_divisores(num1) == num2 E soma_divisores(num2) == num1
            if ($somaDivisores1 == $num2 && $somaDivisores2 == $num1) {
                echo "<h3>Os números <strong>" . $num1 . "</strong> e <strong>" . $num2 . "</strong> SÃO NÚMEROS AMIGOS!</h3>";
            } else {
                echo "<h3>Os números <strong>" . $num1 . "</strong> e <strong>" . $num2 . "</strong> NÃO são números amigos.</h3>";
            }
        }
        echo "<hr>";
    }
    ?>
</body>
</html>