<?php

/* phpinfo(); */

$nome = "Carlos";
$idade = 20;
$altura = 1.80;
$estuda = true;
$nota = 7.9;
$media = 6;

echo "Boas vindas, $nome!<br>";
echo "Sua idade é $idade anos.<br>";
echo "Sua altura é $altura metros.<br>";
echo "Estuda? $estuda.<br>";
if ($estuda) {
    echo "Você estuda.<br>";
} else {
    echo "Você não estuda.<br>";
};

var_dump($nome);
"echo<br>";
var_dump($idade);
"echo<br>";

$a = 10;
$b = 20;
$soma = $a + $b;

echo "A soma de $a e $b é igual a $soma.<br>";

if ($idade>=18 && $altura >= 1.60) {
    echo "Você atendeu os critérios.<br>";
} else {
    echo "Você não atendeu os critérios.<br>";
}

if ($nota >= 7) {
    echo "Você foi aprovado!<br>";
} elseif ($nota >= 5) {
    echo "Você está de recuperação.<br>";
} else {
    echo "Você foi reprovado.<br>";
}

if ($nota >= $media or $nota == $media) {
    echo "Você passou da média $media com $nota, Parabéns!<br>";
} else {
    echo "Você não passou com média $media, passou apenas com $nota.<br>";
}

$media1 = 80;

if ($media1 >= 90) {
    echo "Você tirou A!<br>";
} elseif ($media1 >= 80) {
    echo "Você tirou B!<br>";
} elseif ($media1 >= 70) {
    echo "Você tirou C!<br>";
} elseif ($media1 >= 60) {
    echo "Você tirou D!<br>";
} else {
    echo "Você tirou E!<br>";
}

$media2 = 80;

if ($media2 >= 60) {
    echo "Aprovado!<br>";
} else if ($media2 >= 40 && $media2 < 60) {
    echo "Recuperação!<br>";
} else {
    echo "Reprovado!<br>";
}

$i = 1;

switch ($i) {
    case 0:
        echo "i é igual a 0.<br>";
        break;
    case 1:
        echo "i é igual a 1.<br>";
        break;
    case 2:
        echo "i é igual a 2.<br>";
        break;
    case 3:
        echo "i é igual a 3.<br>";
        break;
    default:
        echo "i não é igual a 0, 1, 2 ou 3.<br>";
        break;
}

?>