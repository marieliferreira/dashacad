<?php
include("conexao.php");

if (isset($_POST['disciplina-barra'])) {
    $disciplina = $_POST['disciplina-barra'];

    $consulta_codigo_disciplina = "SELECT DIS_CODIGO FROM tbl_disciplina WHERE DIS_NOME = '$disciplina'";
    $resultado_codigo_disciplina = mysqli_query($mysqli, $consulta_codigo_disciplina);

    if ($resultado_codigo_disciplina->num_rows > 0) {
        $row_codigo_disciplina = $resultado_codigo_disciplina->fetch_assoc();
        $disciplina_codigo = $row_codigo_disciplina["DIS_CODIGO"];

        // Consulta para contar a quantidade de usuários que responderam cada formulário
        $consulta = "SELECT f.FOR_CODIGO, f.FOR_TITULO, COUNT(DISTINCT n.USU_CODIGO_CAD) AS total_respostas 
        FROM tbl_formulario f 
        LEFT JOIN tbl_nota_formulario n ON f.FOR_CODIGO = n.FOR_CODIGO 
        WHERE f.DIS_CODIGO = '$disciplina_codigo'
        AND n.FOR_STATUS = 'respondido' 
        GROUP BY f.FOR_CODIGO";

        $data = array();
        $result = mysqli_query($mysqli, $consulta);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Defina o cabeçalho de resposta apenas se houver dados para enviar
        if (!empty($data)) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => "Nenhum dado encontrado"));
        }
    } else {
        echo "Disciplina não encontrada.";
    }
}
?>
