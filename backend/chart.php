<?php

include("conexao.php");

$aluno = $_POST['aluno'];

if (isset($_SESSION['codigo-usuario'])) {
    $usu_codigo = $_SESSION['codigo-usuario'];
    $consulta_usuario = "SELECT USU_CODIGO FROM tbl_usuario WHERE USU_CODIGO = '$usu_codigo'";
    $resultado_usuario = mysqli_query($mysqli,$consulta_usuario);
} else {
    echo "Erro: Usuário não está logado.";
    return;
}

if ($resultado_usuario->num_rows > 0) {
    // Retornou um registro - recuperar o ID do usuário
    $row = $resultado_usuario->fetch_assoc();
    $usuario_codigo = $row["USU_CODIGO"];
}

$sql = "SELECT * FROM tbl_nota_formulario WHERE USU_CODIGO_CAD = '$usuario_codigo'";

$statement = $pdo->prepare($sql);

$statement->execute();


while($results = $statement->fetch(PDO::FETCH_ASSOC)) {

    $result[] = $results;
}

echo json_encode($result);