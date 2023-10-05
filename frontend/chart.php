<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/><a>
              </svg>
            </div>
          </div>
        </div>
        
  </div>
  

  <form action="../backend/registro_formulario.php" method="POST" >
        <h4 id="h4-reg-form">Gráfico de barras</h4>
        
        <label id="lbl-aluno" for="aluno">Alunos:</label>
        <select id="aluno" name="aluno" ></select>
        
        <button id="btn-salvar-form"  type ="submit">Criar</button>
      </form>

      <script src="chart.js"></script>    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
      // chama a função ao carregar a página
      preencheSelectAluno();
    });

  function preencheSelectAluno() {
      // faz uma solicitação AJAX para o arquivo PHP
      $.ajax({
        url: '../backend/consulta_aluno.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
          // adiciona cada turma como uma opção no campo select
          for (var i = 0; i < data.length; i++) {
            $('#aluno').append($('<option>', {
              value: data[i].USU_CODIGO,
              text: data[i].USU_NOME
            }));
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  </script>


    <canvas id="myChart"></canvas>


    
    
</body>
</html>