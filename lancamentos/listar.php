<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$sql = "
SELECT
l.id,
e.nome AS empresa,
u.nome AS usuario,
l.historico,
l.data_lancamento
FROM lancamentos l

INNER JOIN empresas e
ON e.id = l.empresa_id

INNER JOIN usuarios u
ON u.id = l.usuario_id

ORDER BY l.id DESC
";

$result = $conn->query($sql);

$lancamentos = [];

while($row = $result->fetch_assoc()){
    $lancamentos[] = $row;
}

echo json_encode($lancamentos);

?>