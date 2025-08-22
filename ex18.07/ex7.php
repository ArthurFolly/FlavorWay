<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moeda</title>
</head>
<body>
    <h1>Conversor de Moeda (BRL para USD)</h1>
    <p>Taxa de conversão: 1 USD = 6 BRL (fictícia)</p>
    <p>Digite <strong>0</strong> no campo "Valor em Reais" para finalizar.</p>

    <?php
    $taxaConversao = 6; // 1 USD = 5 BRL

    // Variáveis para a lógica do do-while
    $valorReais = null; // Inicializa como nulo
    $exibirFormulario = true;
    $mensagem = "";

    // O do-while controlará a entrada e a decisão de continuar
    do {
        // Verifica se o formulário foi submetido
        if (isset($_POST['converter'])) {
            $valorReaisStr = $_POST['reais'] ?? '';

            // Validação
            if (!is_numeric($valorReaisStr) || $valorReaisStr === '') {
                $mensagem = "<p>Por favor, digite um valor numérico válido.</p>";
            } else {
                $valorReais = floatval($valorReaisStr);

                if ($valorReais == 0) {
                    $mensagem = "<p>Processo finalizado. Você digitou 0.</p>";
                    $exibirFormulario = false; // Não exibe mais o formulário
                } elseif ($valorReais < 0) {
                    $mensagem = "<p>Por favor, digite um valor positivo para a conversão.</p>";
                } else {
                    $valorDolares = $valorReais / $taxaConversao;
                    $mensagem = "<p>" . number_format($valorReais, 2, ',', '.') . " BRL equivalem a <strong>" . number_format($valorDolares, 2, ',', '.') . " USD</strong>.</p>";
                    $mensagem .= "<p>Digite o próximo valor, ou 0 para finalizar.</p>";
                }
            }
        }
        // A condição do do-while no PHP/HTML é que o formulário continue sendo exibido
        // enquanto $exibirFormulario for true.

    } while (false); // Este do-while garante que a lógica de processamento seja executada.
                     // A repetição visual do formulário é controlada por $exibirFormulario.

    echo $mensagem; // Exibe a mensagem de cada iteração/resultado

    if ($exibirFormulario) {
    ?>
        <form method="post">
            <p>
                <label for="reais">Valor em Reais (BRL):</label>
                <input type="number" name="reais" id="reais" step="0.01" required autofocus>
            </p>
            <button type="submit" name="converter">Converter</button>
        </form>
    <?php
    }
    ?>

</body>
</html>