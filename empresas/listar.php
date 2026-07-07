<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include("../config/conexao.php");

$sql = "SELECT * FROM empresas";

$result = $conn->query($sql);

$empresas = [];

while($row = $result->fetch_assoc()){

    $empresas[] = [
        "id" => $row['id'],
        "nome" => $row['nome'],
        "cnpj" => $row['cnpj']
    ];

}

echo json_encode($empresas);

?>