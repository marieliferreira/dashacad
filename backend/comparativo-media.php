<?php
include("conexao.php");

if (isset($_POST['turma-coluna']) && isset($_POST['disciplina-coluna'])) {
    $turma = $_POST['turma-coluna'];
    $disciplina = $_POST['disciplina-coluna'];

    $consulta_media = "SELECT u.USU_CODIGO, u.USU_NOME, AVG(nf.NFO_NOTA) AS media 
                        FROM tbl_nota_formulario nf
                        JOIN tbl_formulario f ON nf.FOR_CODIGO = f.FOR_CODIGO
                        JOIN tbl_disciplina d ON f.DIS_CODIGO = d.DIS_CODIGO
                        JOIN tbl_usuario u ON nf.USU_CODIGO_CAD = u.USU_CODIGO
                        WHERE d.DIS_NOME = '$disciplina' AND u.TUR_SERIE = '$turma'
                        GROUP BY u.USU_CODIGO, u.USU_NOME";

    $data = array();
    $result_media = mysqli_query($mysqli, $consulta_media);

    if ($result_media->num_rows > 0) {
        while ($row_media = $result_media->fetch_assoc()) {
            $data[] = $row_media;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} else {
    echo 'Parâmetros inválidos.';
}
?>
