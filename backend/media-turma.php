<?php
include("conexao.php");

// Consulta SQL para obter a média de notas por turma
$consulta_media = "SELECT
t.TUR_SERIE AS Turma,
AVG(nf.NFO_NOTA) AS MediaNotaTurma
FROM
tbl_nota_formulario nf
INNER JOIN
tbl_formulario f ON nf.FOR_CODIGO = f.FOR_CODIGO
INNER JOIN
tbl_turma t ON f.TUR_CODIGO = t.TUR_CODIGO
GROUP BY
t.TUR_SERIE  -- Agrupa apenas por turma
ORDER BY
t.TUR_SERIE;";
$resultado_media = mysqli_query($mysqli, $consulta_media);

if ($resultado_media === false) {
    // Se houver um erro na consulta SQL, enviar uma resposta de erro JSON
    $response = array('error' => 'Erro na consulta SQL: ' . mysqli_error($mysqli));
} else {
    // Formatar os resultados como um array associativo
    $resultados = array();
    while ($row = mysqli_fetch_assoc($resultado_media)) {
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
