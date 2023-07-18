<?php

    include("conexao.php");
    
    session_start();

    // Obtém os dados do formulário
    $questao = $_POST['input-new-questao'];

    if (isset($_POST['codigo-formulario'])) {
        $codigo_formulario = $_POST['codigo-formulario']; 
    }


    // Consultar o ID do formulario selecionado
    $consulta_formulario = "SELECT FOR_CODIGO FROM tbl_formulario WHERE FOR_CODIGO = '$codigo_formulario'";
    $resultado_formulario = mysqli_query($mysqli,$consulta_formulario);

    if ($resultado_formulario->num_rows > 0) {
        // Retornou um registro - recuperar o ID do formulario
        $row = $resultado_formulario->fetch_assoc();
        $formulario_codigo = $row["FOR_CODIGO"];   
    }

       

    // O usuário está logado, então podemos pegar o seu código
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

        // Salvar a questão no banco de dados"
        $consulta = "INSERT INTO tbl_questao (FOR_CODIGO,QUE_DESCRICAO,USU_CODIGO_CAD,USU_CODIGO_ALT) VALUES ('$formulario_codigo', '$questao', '$usuario_codigo','$usuario_codigo')";
        

        if (mysqli_query($mysqli,$consulta) === TRUE) {
            echo mysqli_insert_id($mysqli);
          //  header('Location: ../frontend/questoes.php');
          //echo "questoes.php?codigo=" . $row["FOR_CODIGO"] . "&titulo=" . urlencode($row["FOR_TITULO"]) . "&descricao=" . urlencode($row["FOR_DESCRICAO"]);
        } else {
            echo "Erro ao salvar questao: " . $consulta->error;
        }
    } else {
        echo "Erro: Usuário inválido.";
    }

?>
