<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include("../config/conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? '';
$nome = $data['nome'] ?? '';
$cnpj = $data['cnpj'] ?? '';

$sql = "UPDATE empresas
SET nome='$nome',
    cnpj='$cnpj'
WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success" => true,
        "message" => "Empresa atualizada com sucesso"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => "Erro ao atualizar empresa"
    ]);

}