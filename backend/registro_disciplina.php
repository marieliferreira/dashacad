<?php

    include("conexao.php");
    
    session_start();

    // Obtém os dados do formulário
    $turma = $_POST['input-nome-disciplina'];
    

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
        $consulta = "INSERT INTO tbl_disciplina (DIS_NOME,USU_CODIGO_CAD,USU_CODIGO_ALT) VALUES ('$turma','$usuario_codigo','$usuario_codigo')";
        

        if (mysqli_query($mysqli,$consulta) === TRUE) {
            header("Location: ../frontend/exibe_disciplina.php");
        } else {
            echo "Erro ao salvar registro: " . $consulta->error;
        }
    } else {
        echo "Erro: Usuário inválido.";
    }

?>
