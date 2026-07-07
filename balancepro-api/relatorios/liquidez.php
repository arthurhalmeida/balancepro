<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$sqlAtivo = "

SELECT SUM(p.valor) AS total

FROM partidas p

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

WHERE pc.nome IN
(
'Caixa',
'Bancos',
'Contas a Receber'
)

";

$resultAtivo = $conn->query($sqlAtivo);

$ativo = $resultAtivo->fetch_assoc()['total'];

if(!$ativo){
    $ativo = 0;
}

$sqlPassivo = "

SELECT SUM(p.valor) AS total

FROM partidas p

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

WHERE pc.nome IN
(
'Fornecedores',
'Impostos a Pagar',
'Emprestimos'
)

";

$resultPassivo = $conn->query($sqlPassivo);

$passivo = $resultPassivo->fetch_assoc()['total'];

if(!$passivo){
    $passivo = 0;
}

if($passivo == 0){

    echo json_encode([
        "success"=>false,
        "message"=>"Não é possível calcular a liquidez."
    ]);

    exit();

}

$liquidez = $ativo / $passivo;

echo json_encode([

    "success"=>true,

    "ativo"=>$ativo,

    "passivo"=>$passivo,

    "liquidez"=>$liquidez

]);

?>