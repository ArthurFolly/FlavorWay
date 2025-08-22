<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="enunciado">Digite um número:  </label>
        <input type="text" name="numero">
        <button type="submit" name="confirmar">Confirmar</button>
    </form>
    <?php
    if (isset($_POST['confirmar'])) {
        $numero = $_POST['numero'];
        $tabuada = 1;
        while ($tabuada <= 12) {
            echo "$tabuada X $numero = " . ($tabuada * $numero) . "<br>";
            $tabuada++;
        } 
    }
    ?>  
</body>
</html> 