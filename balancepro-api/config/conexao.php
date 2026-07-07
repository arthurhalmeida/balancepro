<?php

$host = "localhost";
$user = "root";
$pass = "";
$banco = "balancepro";

$conn = new mysqli(

$host,
$user,
$pass,
$banco

);

if($conn -> connect_error){
    die("Erro");
}
?>