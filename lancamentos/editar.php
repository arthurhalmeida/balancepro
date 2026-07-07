<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

if($json){

    $id = $json["id"];
    $historico = $json["historico"];
    $data = $json["data"];

}else{

    $id = $_POST["id"];
    $historico = $_POST["historico"];
    $data = $_POST["data"];

}

$sql = "UPDATE lancamentos
SET

historico='$historico',
data_lancamento='$data'

WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Lançamento atualizado com sucesso."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>