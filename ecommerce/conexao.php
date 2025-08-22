<?php

    $server= "localhost";
    $user="root";
    $password= "";
    $database= "ecommercephp";

    $connection= new mysqli($server, $user, $password, $database );

    if($connection->connect_error) {
        die("Erro de Conexão." . $connection->connect_error);
    } 
?>