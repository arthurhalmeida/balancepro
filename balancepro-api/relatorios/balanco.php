<?php

header("Content-Type: application/json");

include("../config/conexao.php");

$sql = "
SELECT

pc.tipo,
pc.nome,
SUM(p.valor) AS total

FROM partidas p

INNER JOIN plano_contas pc
ON p.conta_id = pc.id

GROUP BY pc.id
";

$result = $conn->query($sql);

$ativo = 0;
$passivo = 0;
$patrimonio = 0;

while($row = $result->fetch_assoc()){

    if($row['tipo'] == 'ATIVO'){

        $ativo += $row['total'];

    }

    if($row['tipo'] == 'PASSIVO'){

        $passivo += $row['total'];

    }

    if($row['tipo'] == 'PATRIMÔNIO'){

        $patrimonio += $row['total'];

    }

}

echo json_encode([

    "success" => true,

    "ativo" => $ativo,

    "passivo" => $passivo,

    "patrimonio" => $patrimonio,

    "total" => $passivo + $patrimonio

]);

?>