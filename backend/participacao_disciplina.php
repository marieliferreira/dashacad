<?php
include("conexao.php");

// Consulta SQL para obter a porcentagem de participação por disciplina
$consulta_porcentagem = "SELECT
    d.DIS_NOME AS Disciplina,
    COUNT(DISTINCT CASE WHEN u.USU_TIPO = 'aluno' THEN nf.USU_CODIGO_CAD END) / COUNT(DISTINCT nf.USU_CODIGO_CAD) * 100 AS PorcentagemParticipacao
    FROM
    tbl_nota_formulario nf
    INNER JOIN
    tbl_formulario f ON nf.FOR_CODIGO = f.FOR_CODIGO
    INNER JOIN
    tbl_disciplina d ON f.DIS_CODIGO = d.DIS_CODIGO
    INNER JOIN
    tbl_usuario u ON nf.USU_CODIGO_CAD = u.USU_CODIGO
    GROUP BY
    d.DIS_NOME;";
$resultado_porcentagem = mysqli_query($mysqli, $consulta_porcentagem);

if ($resultado_porcentagem === false) {
    // Se houver um erro na consulta SQL, enviar uma resposta de erro JSON
    $response = array('error' => 'Erro na consulta SQL: ' . mysqli_error($mysqli));
} else {
    // Formatar os resultados como um array associativo
    $resultados = array();
    while ($row = mysqli_fetch_assoc($resultado_porcentagem)) {
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
