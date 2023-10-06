<?php
include("conexao.php");

$aluno = $_POST['aluno'];

$consulta_aluno = "SELECT * FROM tbl_usuario WHERE USU_NOME = '$aluno'";
$resultado_usuario = mysqli_query($mysqli, $consulta_aluno);

if ($resultado_usuario->num_rows > 0) {
    // Retornou um registro - recuperar o ID do usuário
    $row = $resultado_usuario->fetch_assoc();
    $usuario_codigo = $row["USU_CODIGO"];

    $sql = "SELECT NFO_NOTA, FOR_CODIGO FROM tbl_nota_formulario WHERE USU_CODIGO_CAD = '$usuario_codigo'";
    $resultado = mysqli_query($mysqli, $sql);

    $result = array();

    while ($results = mysqli_fetch_assoc($resultado)) {
        $result[] = $results;
    }

    

    echo json_encode($result);
} else {
    echo json_encode(array('error' => 'Aluno não encontrado.'));
}
