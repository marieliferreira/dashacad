<?php

    include("conexao.php");
    
    session_start();

    // Obtém os dados do formulário
    $titulo = $_POST['input-titulo'];
    $descricao = $_POST['input-descricao'];
    $disciplina = $_POST['disciplina'];
    $turma = $_POST['turma'];
    $prazo = $_POST['input-date-prazo'];

    // Consultar o ID da disciplina selecionada
    $consulta_disciplina = "SELECT DIS_CODIGO FROM tbl_disciplina WHERE DIS_NOME = '$disciplina'";
    $resultado_disciplina = mysqli_query($mysqli,$consulta_disciplina);

    if ($resultado_disciplina->num_rows > 0) {
        // Retornou um registro - recuperar o ID da disciplina
        $row = $resultado_disciplina->fetch_assoc();
        $disciplina_codigo = $row["DIS_CODIGO"];   
    }

     // Consultar o ID da turma selecionada
     $consulta_turma = "SELECT TUR_CODIGO FROM tbl_turma WHERE TUR_SERIE = '$turma'";
     $resultado_turma = mysqli_query($mysqli,$consulta_turma);

     if ($resultado_turma->num_rows > 0) {
         // Retornou um registro - recuperar o ID da turma
         $row = $resultado_turma->fetch_assoc();
         $turma_codigo = $row["TUR_CODIGO"];
     }     

    // O usuário está logado, então podemos pegar o seu código

     print_r($_SESSION);

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

        // Salvar o ID da disciplina selecionada e o ID da turma na tabela "formulario"
        $consulta = "INSERT INTO tbl_formulario (DIS_CODIGO,TUR_CODIGO,FOR_TITULO,FOR_DESCRICAO,FOR_DT_ENTREGA,USU_CODIGO_CAD,USU_CODIGO_ALT) VALUES ('$disciplina_codigo', '$turma_codigo', '$titulo', '$descricao','$prazo','$usuario_codigo','$usuario_codigo')";
        

        if (mysqli_query($mysqli,$consulta) === TRUE) {
            header("Location: ../frontend/exibe-formulario.php");
        } else {
            echo "Erro ao salvar registro: " . $consulta->error;
        }
    } else {
        echo "Erro: Usuário inválido.";
    }

?>
