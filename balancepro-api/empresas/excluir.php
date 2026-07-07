<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include("../config/conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

$sql = "DELETE FROM empresas WHERE id = '$id'";

if($conn->query($sql)){

    echo json_encode([
        "success" => true,
        "message" => "Empresa excluída com sucesso"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => "Erro ao excluir empresa"
    ]);

}