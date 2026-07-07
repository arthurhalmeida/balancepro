<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

if($json){

    $id = $json['id'];
    $codigo = $json['codigo'];
    $nome = $json['nome'];
    $tipo = $json['tipo'];
    $natureza = $json['natureza'];

}else{

    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $natureza = $_POST['natureza'];

}

$sql = "UPDATE plano_contas SET

codigo='$codigo',
nome='$nome',
tipo='$tipo',
natureza='$natureza'

WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Conta atualizada com sucesso."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>