<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$conta_id = $_GET['conta_id'];

$sql = "

SELECT

l.data_lancamento,
l.historico,
p.tipo,
p.valor,
pc.nome

FROM partidas p

INNER JOIN lancamentos l
ON p.lancamento_id = l.id

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

WHERE p.conta_id='$conta_id'

ORDER BY l.data_lancamento

";

$result = $conn->query($sql);

$dados = [];

while($row = $result->fetch_assoc()){

    $dados[] = $row;

}

echo json_encode($dados);

?>