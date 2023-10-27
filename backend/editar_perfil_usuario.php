<?php
    include("conexao.php");

    session_start();
    
    if(!isset($_SESSION['nome'])){
        echo "<script>window.location.href = 'login.html'; </script>";
    } else {
        // Recupere as informações do usuário da sessão ou do banco de dados
        $codigo_usuario = $_SESSION['codigo-usuario'];
        $nome_usuario = $_SESSION['nome'];
        $email_usuario = $_SESSION['email'];
        $foto_usuario = $_SESSION['foto'];
        $senha_usuario = $_SESSION['senha'];
    }

    if(isset($_POST['botao-salvar'])){
        // Obtenha os dados do formulário
        $novo_nome = $_POST['novo-nome'];
        $novo_email = $_POST['novo-email'];
        $nova_senha = $_POST['nova-senha'];
        
        // Prepare e execute a consulta SQL de UPDATE
        $sql = "UPDATE tbl_usuario SET USU_NOME='$novo_nome', USU_EMAIL='$novo_email', USU_SENHA='$nova_senha' WHERE USU_CODIGO=$codigo_usuario";

        if ($mysqli->query($sql) === TRUE) {
            // Atualize as informações na sessão
            $_SESSION['nome'] = $novo_nome;
            $_SESSION['email'] = $novo_email;
            $_SESSION['senha'] = $nova_senha;
            // Redirecione o usuário de volta para a página de perfil
            header("Location: ../frontend/exibe_perfil_usuario.php");
        } else {
            echo "Erro ao executar a consulta: " . $mysqli->error;
        }

        // Feche a conexão
        $mysqli->close();
    }
?>
