<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

$id = $json['id'] ?? $_POST['id'];

$sql = "DELETE FROM plano_contas WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Conta excluída com sucesso."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>