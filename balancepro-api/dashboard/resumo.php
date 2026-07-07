<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$sql = "SELECT COUNT(*) AS total FROM empresas";
$result = $conn->query($sql);
$totalEmpresas = $result->fetch_assoc()['total'];

$sql = "SELECT COUNT(*) AS total FROM usuarios";
$result = $conn->query($sql);
$totalUsuarios = $result->fetch_assoc()['total'];

$sql = "SELECT COUNT(*) AS total FROM plano_contas";
$result = $conn->query($sql);
$totalContas = $result->fetch_assoc()['total'];

$sql = "SELECT COUNT(*) AS total FROM lancamentos";
$result = $conn->query($sql);
$totalLancamentos = $result->fetch_assoc()['total'];

$sql = "
SELECT SUM(p.valor) AS total
FROM partidas p
INNER JOIN plano_contas pc
ON p.conta_id = pc.id
WHERE pc.tipo='RECEITA'
";

$result = $conn->query($sql);
$receitas = $result->fetch_assoc()['total'];

if(!$receitas){
    $receitas = 0;
}

$sql = "
SELECT SUM(p.valor) AS total
FROM partidas p
INNER JOIN plano_contas pc
ON p.conta_id = pc.id
WHERE pc.tipo='DESPESA'
";

$result = $conn->query($sql);
$despesas = $result->fetch_assoc()['total'];

if(!$despesas){
    $despesas = 0;
}

$saldo = $receitas - $despesas;

$sql = "
SELECT
historico,
data_lancamento
FROM lancamentos
ORDER BY id DESC
LIMIT 5
";

$result = $conn->query($sql);

$ultimos = [];

while($row = $result->fetch_assoc()){

    $ultimos[] = $row;

}

echo json_encode([

    "success"=>true,

    "empresas"=>$totalEmpresas,

    "usuarios"=>$totalUsuarios,

    "contas"=>$totalContas,

    "lancamentos"=>$totalLancamentos,

    "receitas"=>$receitas,

    "despesas"=>$despesas,

    "saldo"=>$saldo,

    "ultimos"=>$ultimos

]);

?>