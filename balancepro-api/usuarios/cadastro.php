<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

if($json){

    $nome = $json['nome'];
    $email = $json['email'];
    $senha = $json['senha'];

}else{

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

}

$empresa_id = 1;

$sql = "SELECT id FROM usuarios WHERE email='$email'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    echo json_encode([
        "success"=>false,
        "message"=>"Este e-mail já está cadastrado."
    ]);

    exit();

}

$sql = "INSERT INTO usuarios
(
nome,
email,
senha,
empresa_id
)
VALUES
(
'$nome',
'$email',
'$senha',
'$empresa_id'
)";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Usuário cadastrado com sucesso."
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);

}

?>