<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Eletrônico</title>
</head>
<body>
    <h1>Simulação de Caixa Eletrônico</h1>
    <p>Insira um valor para saque. O programa retornará a quantidade mínima de cédulas (100, 50, 20, 10, 5, 2, 1).</p>

    <form method="post">
        <label for="saque">Valor do Saque:</label>
        <input type="number" name="saque" id="saque" required min="1">
        <button type="submit" name="sacar">Sacar</button>
    </form>

    <?php
    if (isset($_POST['sacar'])) {
        $valorSaqueStr = $_POST['saque'] ?? '';
        $valorSaque = intval($valorSaqueStr);
        $cedulasDisponiveis = [100, 50, 20, 10, 5, 2, 1];
        $contagemCedulas = [];
        $erros = [];

        echo "<hr>";
        echo "<h2>Resultado do Saque:</h2>";

        // Validação
        if (!is_numeric($valorSaqueStr) || $valorSaqueStr === '') {
            $erros[] = "Por favor, digite um valor numérico válido.";
        } elseif ($valorSaque <= 0) {
            $erros[] = "Por favor, digite um valor de saque positivo.";
        } elseif ($valorSaque != $valorSaqueStr) { // Verifica se é inteiro
             $erros[] = "Por favor, digite um valor de saque inteiro.";
        }

        if (!empty($erros)) {
            echo "<p><strong>Problemas encontrados:</strong></p>";
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . $erro . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Valor solicitado: <strong>R$ " . number_format($valorSaque, 2, ',', '.') . "</strong></p>";
            echo "<h3>Cédulas:</h3>";

            $valorRestante = $valorSaque;
            $indexCedula = 0; // Inicia no índice 0 para a cédula de 100

            // Loop while para iterar sobre os tipos de cédulas
            while ($indexCedula < count($cedulasDisponiveis)) {
                $cedulaAtual = $cedulasDisponiveis[$indexCedula];
                $quantidade = 0;

                // Loop do-while para contar quantas cédulas do tipo atual são necessárias
                do {
                    if ($valorRestante >= $cedulaAtual) {
                        $quantidade++;
                        $valorRestante -= $cedulaAtual;
                    } else {
                        break; // Sai do do-while se não pode mais subtrair essa cédula
                    }
                } while ($valorRestante >= 0); // Condição para continuar tentando com a cédula atual

                if ($quantidade > 0) {
                    $contagemCedulas[$cedulaAtual] = $quantidade;
                }

                $indexCedula++; // Passa para a próxima cédula na lista
            }

            if (empty($contagemCedulas)) {
                echo "<p>Não foi possível sacar o valor com as cédulas disponíveis.</p>";
            } else {
                echo "<ul>";
                foreach ($contagemCedulas as $cedula => $qtd) {
                    echo "<li>R$ " . $cedula . ",00: " . $qtd . " cédula(s)</li>";
                }
                echo "</ul>";
            }

            if ($valorRestante > 0) {
                 echo "<p>Restante não sacado (valor abaixo da menor cédula): R$ " . number_format($valorRestante, 2, ',', '.') . "</p>";
            }
        }
        echo "<hr>";
    }
    ?>

</body>
</html>