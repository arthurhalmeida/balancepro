<?php

include("../config/conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM empresas
WHERE id = '$id'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $empresa = $result->fetch_assoc();

    echo "ID: ".$empresa['id']."<br>";
    echo "Nome: ".$empresa['nome']."<br>";
    echo "CNPJ: ".$empresa['cnpj'];

}else{

echo "Empresa não encontrada";
}







?>