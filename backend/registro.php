<?php

    include("conexao.php");
      
      // Obtém os dados do formulário
      //$ra = $_POST['input-ra'];
      $nome = $_POST['input-nome-completo'];
      $email = $_POST['input-email-institucional'];
      $senha = $_POST['input-senha-registro'];
      $valorRadio = $_POST['radio-tipo-usuario'];
      $turma = $_POST['select-turma'];


     $uploadDir = "../imagens-upload/";
     $nomeArquivo = $_FILES['imagem']['name'];
     $caminhoCompleto = $uploadDir . $nomeArquivo;

     if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
       echo "Arquivo enviado com sucesso";
     } else {
       echo "Erro ao enviar o arquivo";
     }


     // Salvar o caminho da imagem no banco de dados
     $caminhoImagem = $caminhoCompleto;
      
      // Insere os dados no banco de dados
      //$sql = "INSERT INTO tbl_usuario (USU_NOME, USU_EMAIL, USU_SENHA, USU_FOTO, USU_TIPO) VALUES ('$nome', '$email', '$senha', '$caminhoImagem', '$valorRadio')";
      

      if ($valorRadio == 'aluno'){
        $sql = "INSERT INTO tbl_usuario(USU_NOME, USU_EMAIL, USU_SENHA, USU_FOTO, USU_TIPO, TUR_SERIE) VALUES ('$nome', '$email', '$senha', '$caminhoImagem', 'Aluno', '$turma')";
      } else {
        $sql = "INSERT INTO tbl_usuario (USU_NOME, USU_EMAIL, USU_SENHA, USU_FOTO, USU_TIPO) VALUES ('$nome', '$email', '$senha', '$caminhoImagem', 'Professor')";
      }

      if (mysqli_query($mysqli,$sql) === TRUE) {
        //echo "Usuário registrado com sucesso!";
        header("Location: ../frontend/login.html");
      } else {
        echo "Erro ao registrar usuário: " . $sql->error;
      }
?>