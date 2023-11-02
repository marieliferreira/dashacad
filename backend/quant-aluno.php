<?php
include("conexao.php");

// Consulta SQL para obter a quantidade de alunos por turma
$consulta_aluno = "SELECT TUR_SERIE, COUNT(*) AS quantidade_alunos FROM tbl_usuario GROUP BY TUR_SERIE";
$resultado_aluno = mysqli_query($mysqli, $consulta_aluno);

if ($resultado_aluno === false) {
    // Se houver um erro na consulta SQL, enviar uma resposta de erro JSON
    $response = array('error' => 'Erro na consulta SQL: ' . mysqli_error($mysqli));
} else {
    // Formatar os resultados como um array associativo
    $resultados = array();
    while ($row = mysqli_fetch_assoc($resultado_aluno)) {
        $resultados[] = $row;
    }
    
    // Enviar os resultados como resposta JSON
    $response = $resultados;
}

// Fechar a conexão com o banco de dados
mysqli_close($mysqli);

// Enviar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
