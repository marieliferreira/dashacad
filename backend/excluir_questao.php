<?php

include("conexao.php");
    
session_start();

$codigo_questao = $_POST['codigo_questao'];


// Query SQL para excluir a opção do banco de dados
$consulta = "DELETE FROM tbl_questao WHERE QUE_CODIGO = '$codigo_questao'";

if (mysqli_query($mysqli,$consulta) === TRUE) {
    echo "Questão removida com sucesso!";
} else {
    echo "Erro ao remover a questão: " . mysqli_error($mysqli);
}

?>