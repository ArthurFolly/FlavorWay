<?php

    $server= "localhost";
    $user="root";
    $password= "";
    $database= "empresa";

    $connection= new mysqli($server, $user, $password, $database );

    if($connection->connect_error) {
        die("Erro de Conexão." . $connection->connect_error);
    } 
?>