<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

if($json){

    $codigo = $json['codigo'];
    $nome = $json['nome'];
    $tipo = $json['tipo'];
    $natureza = $json['natureza'];

}else{

    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $natureza = $_POST['natureza'];

}

$sql = "INSERT INTO plano_contas
(
codigo,
nome,
tipo,
natureza
)
VALUES
(
'$codigo',
'$nome',
'$tipo',
'$natureza'
)";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Conta cadastrada com sucesso."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>