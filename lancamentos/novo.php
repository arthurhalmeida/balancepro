<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../config/conexao.php");

$json = json_decode(file_get_contents("php://input"), true);

if ($json) {

    $empresa_id = $json['empresa_id'] ?? '';
    $usuario_id = $json['usuario_id'] ?? '';

    $historico = $json['historico'] ?? '';
    $data = $json['data'] ?? '';

    $conta_debito = $json['conta_debito'] ?? '';
    $conta_credito = $json['conta_credito'] ?? '';

    $valor_debito = $json['valor_debito'] ?? '';
    $valor_credito = $json['valor_credito'] ?? '';

} else {

    $empresa_id = $_POST['empresa_id'] ?? '';
    $usuario_id = $_POST['usuario_id'] ?? '';

    $historico = $_POST['historico'] ?? '';
    $data = $_POST['data'] ?? '';

    $conta_debito = $_POST['conta_debito'] ?? '';
    $conta_credito = $_POST['conta_credito'] ?? '';

    $valor_debito = $_POST['valor_debito'] ?? '';
    $valor_credito = $_POST['valor_credito'] ?? '';

}

if (
    empty($empresa_id) ||
    empty($usuario_id) ||
    empty($historico) ||
    empty($data) ||
    empty($conta_debito) ||
    empty($conta_credito) ||
    empty($valor_debito) ||
    empty($valor_credito)
) {

    echo json_encode([
    "success" => false,
    "message" => "Todos os campos são obrigatórios."
]);

exit();
}

if ($valor_debito != $valor_credito) {

    echo json_encode([
        "success" => false,
        "message" => "Débito diferente do Crédito."
    ]);

    exit();
}

$sql = "INSERT INTO lancamentos
(
empresa_id,
usuario_id,
historico,
data_lancamento
)
VALUES
(
'$empresa_id',
'$usuario_id',
'$historico',
'$data'
)";

if (!$conn->query($sql)) {

    echo json_encode([
        "success" => false,
        "etapa" => "lancamentos",
        "erro" => $conn->error,
        "sql" => $sql
    ]);

    exit();
}

$lancamento_id = $conn->insert_id;


$sql = "INSERT INTO partidas
(
lancamento_id,
conta_id,
tipo,
valor
)
VALUES
(
'$lancamento_id',
'$conta_debito',
'D',
'$valor_debito'
)";

if (!$conn->query($sql)) {

    echo json_encode([
        "success" => false,
        "etapa" => "debito",
        "erro" => $conn->error,
        "sql" => $sql
    ]);

    exit();
}


$sql = "INSERT INTO partidas
(
lancamento_id,
conta_id,
tipo,
valor
)
VALUES
(
'$lancamento_id',
'$conta_credito',
'C',
'$valor_credito'
)";

if (!$conn->query($sql)) {

    echo json_encode([
        "success" => false,
        "etapa" => "credito",
        "erro" => $conn->error,
        "sql" => $sql
    ]);

    exit();
}

echo json_encode([
    "success" => true,
    "message" => "Lançamento realizado com sucesso."
]);

?>