<?php

include("conexao.php");
    
session_start();

$codigo_opcao = $_POST['codigo_alternativa'];


// Query SQL para excluir a opção do banco de dados
$consulta = "DELETE FROM tbl_alternativas WHERE ALT_CODIGO = '$codigo_opcao'";

if (mysqli_query($mysqli,$consulta) === TRUE) {
    echo "Opção removida com sucesso!";
} else {
    echo "Erro ao remover a opção: " . mysqli_error($mysqli);
}

?>