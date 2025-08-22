<?php
    
    $energia = 400.00;
    $tipodeconsumidor = "Residencial";
    
    if ($tipodeconsumidor == "Residencial") {
        if ($energia <= 400.00) {
            $valor = ($energia * 0.40);
            $valortotal = $valor - ($valor * 5 / 100);
        }   else if ($energia >= 400.01 && $energia <= 500.00) {
                $valor = ($energia * 0.40);
                $valortotal = $valor;
        }   else if ($energia >= 500.01) {
                $valor = ($energia * 0.65);
                $valortotal = $valor;   
        }
    }   else if ($tipodeconsumidor == "Comercial") {
            if ($energia <= 1000.00) {
                $valor = ($energia * 0.55);
                $valortotal = $valor;
            }   else if ($energia >= 1000.01) {
                $valor = ($energia * 0.60);
                $valortotal = $valor;
            }
        
    }   else if ($tipodeconsumidor == "Industrial") {
            if ($energia <= 5000.00) {
                $valor = ($energia * 0.60);
                $valortotal = $valor;
            }   else if ($energia >= 5000.01) {
                $valor = ($energia * 0.75);
                $valortotal = $valor;
            }
    }
    echo "A conta de energia consta $energia KwH, então o valor da conta é de R$ $valortotal reais, conta classificada como: $tipodeconsumidor.<br>";
    







?>