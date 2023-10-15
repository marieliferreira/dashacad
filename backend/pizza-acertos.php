<?php

include("conexao.php");

if (isset($_POST['aluno']) && isset($_POST['formulario_pizza'])) {
    $aluno = $_POST['aluno'];
    $formulario_titulo = $_POST['formulario_pizza'];

    // Consulta o código do aluno
    $consulta_aluno = "SELECT USU_CODIGO FROM tbl_usuario WHERE USU_NOME = '$aluno'";
    $resultado_aluno = mysqli_query($mysqli, $consulta_aluno);

    if ($resultado_aluno->num_rows > 0) {
        $row_aluno = $resultado_aluno->fetch_assoc();
        $usuario_codigo = $row_aluno["USU_CODIGO"];

        // Consulta o código do formulário com base no nome
        $consulta_formulario = "SELECT FOR_CODIGO FROM tbl_formulario WHERE FOR_TITULO = '$formulario_titulo'";
        $resultado_formulario = mysqli_query($mysqli, $consulta_formulario);

        if ($resultado_formulario->num_rows > 0) {
            $row_formulario = $resultado_formulario->fetch_assoc();
            $formulario_codigo = $row_formulario["FOR_CODIGO"];

            // Consulta a quantidade de questões do formulário
            $consulta_questoes = "SELECT COUNT(*) as total_questoes FROM tbl_questoes WHERE FOR_CODIGO = '$formulario_codigo'";
            $resultado_questoes = mysqli_query($mysqli, $consulta_questoes);
            $row_questoes = $resultado_questoes->fetch_assoc();
            $total_questoes = $row_questoes["total_questoes"];

            // Consulta a quantidade de questões corretas
            $consulta_corretas = "SELECT NFO_TOTAL_QUESTOES_CERTAS FROM tbl_nota_formulario WHERE USU_CODIGO_CAD = '$usuario_codigo' AND FOR_CODIGO = '$formulario_codigo'";
            $resultado_corretas = mysqli_query($mysqli, $consulta_corretas);

            if ($resultado_corretas) {
                $row_corretas = mysqli_fetch_assoc($resultado_corretas);
                $questoes_corretas = $row_corretas["NFO_TOTAL_QUESTOES_CERTAS"];
            } else {
                echo 'Erro na consulta.';
            }

            $resultado = array(
                'total_questoes' => $total_questoes,
                'questoes_corretas' => $questoes_corretas
            );
            header('Content-Type:application/json');
            echo json_encode($resultado);
            exit;
        } else {
            echo 'Formulário não encontrado.';
        }
    } else {
        echo 'Aluno não encontrado';
    }
} else {
    echo 'Parâmetros inválidos.';
}
?>
