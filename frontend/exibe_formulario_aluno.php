<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>DashAcad</title>
</head>
<body>

<?php

    session_start();
    
    if(!isset($_SESSION['nome'])){
      echo "<script>window.location.href = 'login.html'; </script>";
    }
    else{
      $codigo_usuario = $_SESSION['codigo-usuario'];
      $nome_usuario = $_SESSION['nome'];
      $email_usuario = $_SESSION['email'];
      $foto_usuario = $_SESSION['foto'];
    }

    if(isset($_POST['botao-logout'])){
      session_destroy();
      header("Location: login.html");
  }
		

?>

<div class="cabecalho-branco-home">
  
  
          <div class="container-fluid">
              <div class="row col-md-12">
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-4 div-foto-perfil">
                      <img src = <?php echo "'" . $foto_usuario . "'";?> alt="Foto do perfil" class="img-fluid rounded-circle" >
                    </div>
                      <div class="col-sm-8">
                        <h6 id="nome-usuario"><?php echo $nome_usuario;?></h6>
                        <p id="email-usuario"><?php echo $email_usuario;?></p>
                      </div>
                  </div>
                </div>
                <div class="col-sm-4 text-center">
                  <img src="imagens/Logo-DashAcad01.png" alt="Logo do site" class="img-fluid">
                </div>
                <div class="col-sm-4 text-right botao-logout">
                      <a href="login.html"><svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" fill="currentColor"      class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></a>
                  </svg>
                </div>
              </div>
            </div>
            
      </div>
<span ><a  class="fa fa-arrow-left" id="btn-voltar" href="home_aluno.php"></a></span>
<div id="div-tbl">

    <h4 id="h4-form">Formulários</h1>

    <?php
    
    include("../backend/conexao.php");
    
    // Consulta SQL para selecionar as colunas da tabela "tbl-formulario"
    $sql = "SELECT * FROM tbl_formulario";

    
    // Executa a consulta SQL
    if ($result = $mysqli->query($sql)) {
    
        // Verifica se há registros
        if ($result->num_rows > 0) {
    
            // Exibe os dados em uma tabela HTML
            echo "<table border = 1>";
            
    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td id='tbl-cod-form'>" . $row["FOR_CODIGO"] . "</td>";
                echo "<td id='tbl-titulo-form'>" . $row["FOR_TITULO"] . "</td>";
            
                // Consulta SQL para obter o nome da disciplina com base no código
                $disciplinaSql = "SELECT DIS_NOME FROM tbl_disciplina WHERE DIS_CODIGO = " . $row["DIS_CODIGO"];
            
                // Executa a consulta para obter o nome da disciplina
                $disciplinaResult = $mysqli->query($disciplinaSql);
            
                // Verifica se há registros
                if ($disciplinaResult && $disciplinaResult->num_rows > 0) {
                    $disciplinaRow = $disciplinaResult->fetch_assoc();
                    $disciplinaNome = $disciplinaRow["DIS_NOME"];
                    echo "<td id='tbl-disciplina-nome'>" . $disciplinaNome . "</td>";
                } else {
                    echo "<td id='tbl-disciplina-nome'>Nome da Disciplina não encontrado</td>";
                }
            
                
                echo "<td> <a class='btn-responder' href='formulario-aluno.php?codigo=" . urlencode($row["FOR_CODIGO"]) . "&titulo=" . urlencode($row["FOR_TITULO"]) . "&descricao=" . urlencode($row["FOR_DESCRICAO"]) . "'>Responder</a></td>";
                echo "</tr>";
            }
            
    
    
            echo "</table>";
    
            // Libera o resultado
            $result->free();
        } else {
            echo "Não foram encontrados registros.";
        }
    
    } else {
        echo "Erro ao executar a consulta: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    // Fecha a conexão
    $mysqli->close();
    
    ?>
</div>

   




    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous">


</body>
</html>

<script src="form.js"></script>


