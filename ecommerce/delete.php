<?php
include "conexao.php";
$id=$_GET["id"];
$sql= "DELETE FROM produtos WHERE id=$id";
$connection->query($sql);

header("Location: index.php");

?>