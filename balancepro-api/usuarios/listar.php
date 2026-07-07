<?php

header("Content-Type: application/json; charset=UTF-8");

include("../config/conexao.php");

$sql = "SELECT
usuarios.id,
usuarios.nome,
usuarios.email,
empresas.nome AS empresa
FROM usuarios
LEFT JOIN empresas
ON empresas.id = usuarios.empresa_id
ORDER BY usuarios.nome";

$result = $conn->query($sql);

$dados = array();

while($row = $result->fetch_assoc()){
    $dados[] = $row;
}

echo json_encode($dados);

?>