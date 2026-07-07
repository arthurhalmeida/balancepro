<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

$id = $json["id"] ?? $_POST["id"];

$conn->query("DELETE FROM partidas WHERE lancamento_id='$id'");

$sql = "DELETE FROM lancamentos WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Lançamento excluído."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>