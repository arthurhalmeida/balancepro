<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM plano_contas WHERE id='$id'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    echo json_encode($result->fetch_assoc());

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Conta não encontrada."
    ]);

}

?>