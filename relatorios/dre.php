<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$sqlReceitas = "
SELECT SUM(p.valor) AS total

FROM partidas p

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

WHERE pc.tipo='RECEITA'
";

$resultReceitas = $conn->query($sqlReceitas);

$receitas = $resultReceitas->fetch_assoc()['total'];

if(!$receitas){
    $receitas = 0;
}

$sqlDespesas = "
SELECT SUM(p.valor) AS total

FROM partidas p

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

WHERE pc.tipo='DESPESA'
";

$resultDespesas = $conn->query($sqlDespesas);

$despesas = $resultDespesas->fetch_assoc()['total'];

if(!$despesas){
    $despesas = 0;
}

$resultado = $receitas - $despesas;

$status = "Lucro";

if($resultado < 0){

    $status = "Prejuízo";

}

echo json_encode([

    "success"=>true,

    "receitas"=>$receitas,

    "despesas"=>$despesas,

    "resultado"=>abs($resultado),

    "status"=>$status

]);

?>