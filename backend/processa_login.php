<?php

include("conexao.php");

if(isset($_POST['input-email']) || isset($_POST['input-senha'])){

    if(strlen($_POST['input-email']) == 0){
        echo "Falha ao logar, por favor preencha com seu email!";
    } else if (strlen($_POST['input-senha']) == 0){
        echo "Falha ao logar, por favor preencha com sua senha!";
    } else {
        $email = $mysqli->real_escape_string($_POST['input-email']);
        $senha = $mysqli->real_escape_string($_POST['input-senha']);

        $consulta = "SELECT * FROM tbl_usuario WHERE USU_EMAIL = '$email' AND USU_SENHA = '$senha'";

        $resultado = $mysqli->query($consulta) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $resultado->num_rows;

        if($quantidade == 1){
            $usuario = $resultado->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['codigo-usuario'] = $usuario['USU_CODIGO'];
            $_SESSION['nome'] = $usuario['USU_NOME'];
            $_SESSION['email'] = $usuario['USU_EMAIL'];
            $_SESSION['foto'] = $usuario['USU_FOTO'];


            $tipo = $usuario['USU_TIPO'];


            if ($tipo == 'Aluno') {
                echo "Aluno"; // Custom value for student role
            } else if ($tipo == 'Professor') {
                echo "Professor"; // Custom value for teacher role
            } 

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos.";
        }

    }
}

?>