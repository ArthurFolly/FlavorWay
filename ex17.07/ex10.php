<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method = "post">
        <label for="ação">Digite uma das opções de ação no menu: Saldo, Depósito, Saque ou Sair(sem acentos).</label>
        <input type="text" name = "acao">
        <button type="submit" name="confirmar">Confirmar</button>
    </form>      
    <?php
    if (isset($_POST['confirmar'])) {
        $acao = strtolower($_POST["acao"]);

        switch ($acao) {
            case "saldo":
                echo "Você escolheu ver o saldo, redirecionando para sua pagina inicial...<br>";
                break;
            case "deposito":
                echo "Você escolheu fazer um depósito, redirecionando para a página de depósito...<br>";
                break;
            case "saque":
                echo "Você escolheu fazer um saque, redirecionando para a página de saque...<br>";
                break;
            case "sair":
                echo "Você escolheu sair, encerrando a aplicação...<br>";
                break;
            default:
                echo "Opção inválida! Por favor, Digite uma das opções de ação no menu: Saldo, Depósito, Saque ou Sair(sem acentos).";
        }
    }
    ?>            
</body>
</html>