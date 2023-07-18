<?php

    include("conexao.php");
    
    session_start();

    
    if (isset($_POST['option-text'])) {
        $descricao_alternativa = $_POST['option-text']; 
    }

    $questao_codigo = $_POST['option-hidden'];

    if (isset($_POST['option-checkbox'])) {
        $checkbox = $_POST['option-checkbox'];
        
        if ($checkbox === "sim") {
            $checkbox_status = "certo";
        } else {
            $checkbox_status = "errado";
        }

    } else {
        $checkbox_status = "errado";
    }
    

    // Consultar o ID do formulario selecionado
    $consulta_questao = "SELECT QUE_CODIGO FROM tbl_questao WHERE QUE_CODIGO = '$questao_codigo'";
    $resultado_questao = mysqli_query($mysqli,$consulta_questao);

    if ($resultado_questao->num_rows > 0) {
        // Retornou um registro - recuperar o ID da questao
        $row = $resultado_questao->fetch_assoc();
        $questao_codigo = $row["QUE_CODIGO"];   
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

        // Salvar a alternativa no banco de dados"
        $consulta = "INSERT INTO tbl_alternativas (QUE_CODIGO, ALT_DESCRICAO,USU_CODIGO_CAD, USU_CODIGO_ALT, ALT_STATUS) VALUES ('$questao_codigo', '$descricao_alternativa', '$usuario_codigo','$usuario_codigo', '$checkbox_status')";
        

        if (mysqli_query($mysqli,$consulta) === TRUE) {
           // echo mysqli_insert_id($mysqli);
            echo "Ok"; 
          
          //echo "questoes.php?codigo=" . $row["FOR_CODIGO"] . "&titulo=" . urlencode($row["FOR_TITULO"]) . "&descricao=" . urlencode($row["FOR_DESCRICAO"]);
        } else {
            echo "Erro ao salvar alternativa: " . mysqli_error($mysqli)->error;
        }
    }

?>