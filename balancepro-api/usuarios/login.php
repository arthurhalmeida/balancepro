<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include("../config/conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

$sql = "SELECT * FROM usuarios
        WHERE email='$email'
        AND senha='$senha'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    echo json_encode([

        "success"=>true,

        "message"=>"Login realizado com sucesso.",

        "usuario"=>[

            "id"=>$usuario['id'],
            "nome"=>$usuario['nome'],
            "email"=>$usuario['email'],
            "empresa_id"=>$usuario['empresa_id']

        ]

    ]);

}else{

    echo json_encode([

        "success"=>false,

        "message"=>"E-mail ou senha inválidos."

    ]);

}

?>