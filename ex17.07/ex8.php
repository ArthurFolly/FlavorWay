<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>continentes</h2>
    <form method="post">
        <input type="text" name = "continente" placeholder="Digite o nome de um continente sem acentos: ">
        <button type="submit" name="enviar">Ver continente</button>
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        $continente = strtolower($_POST['continente']);
        
        switch ($continente) {
            case "europa": 
                echo "Europa, Portugal, Alemanha e França.<br>";
                break;
            case "oceania": 
                echo "Oceania, Nova Zelândia, Fiji e Austrália.<br>";
                break;
            case "america":
                echo "América, Brasil, Estados Unidos e México.<br>";
                break;
            case "asia":
                echo "Ásia, China, Japão e Índia.<br>";
                break;
            case "africa":
                echo "África, Nígeria, Egito e África do Sul.<br>";
                break;
            case "antartida":     
                echo "Antártida, sem países.<br>";
                break;                  
            
            default:
                echo "Número inválido! Por favor, digite um número entre 1 e 12.<br>";
        }
    }
    ?>                    
</body>
</html>