<?php

include("../config/conexao.php"); 

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios
WHERE id = '$id'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $usuario = $result->fetch_assoc();

    echo "ID: ".$usuario['id']."<br>";
    echo "Nome: ".$usuario['nome']."<br>";
    echo "Email: ".$usuario['email']."<br>";
    echo "Empresa ID: ".$usuario['empresa_id'];
}

?>