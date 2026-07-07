<?php

include("../config/conexao.php"); 

$id = $_GET['id'];

$sql = "DELETE FROM usuarios
WHERE id = '$id'";

if($conn->query($sql)){

    echo "Usuario excluido com sucesso";

}else{

    echo "Erro ao excluir usuario";
    
}

?>