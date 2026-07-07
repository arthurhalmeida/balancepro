<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include("../config/conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$nome = $data['nome'] ?? '';
$cnpj = $data['cnpj'] ?? '';

$sql = "INSERT INTO empresas
(nome, cnpj)
VALUES
('$nome', '$cnpj')";

if($conn->query($sql)){

    echo json_encode([
        "success" => true,
        "message" => "Empresa cadastrada com sucesso"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => "Erro ao cadastrar empresa"
    ]);

}