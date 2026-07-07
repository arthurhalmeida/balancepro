<?php

header("Content-Type: application/json; charset=UTF-8");

include("../config/conexao.php");

$sql = "SELECT * FROM plano_contas ORDER BY codigo";

$result = $conn->query($sql);

$dados = array();

while($row = $result->fetch_assoc()){
    $dados[] = $row;
}

echo json_encode($dados);

?>