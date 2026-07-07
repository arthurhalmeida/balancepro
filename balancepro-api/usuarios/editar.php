<?php

include("../config/conexao.php"); 

$id = $_POST['id'];

$nome = $_POST['nome'];

$email = $_POST['email'];

$senha = $_POST['senha'];

$empresa_id = $_POST['empresa_id'];

$sql = "UPDATE usuarios
SET
nome = '$nome',
email = '$email',
senha = '$senha',
empresa_id = '$empresa_id'
WHERE id = '$id'";

if($conn->query($sql)){

echo "Usuario atualizado com sucesso";

}else{

echo "Erro ao atualizar usuario";

}


?>