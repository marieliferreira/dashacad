<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home_aluno.css">
    <title>DashAcad</title>
</head>
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
<body>
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

      <div class="container-sm">
        <div class="row align-items-start" >
          <div class="menu-aluno col" id="menu-aluno-formulario" >
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-file-earmark-text text-center" viewBox="0 0 16 16" id="icone-form">
          <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
          <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
          </svg>
            <h4 class="text-center" id="h4-formulario">Formulários</h4>
            <div>
            <a href="../frontend/exibe_formulario_aluno.php">Acessar</a>
            </div>
          </div>
          <div class="menu-aluno col" id="menu-aluno-respondidos" >
            <i class="fas fa-check-square text-center"></i>
            <h4 class="text-center" id="h4-respondidos">Respondidos</h4>
            <div>
            <a href="../frontend/exibe_formularios_respondidos.php">Acessar</a>
            </div>
          </div>
          <div class="menu-aluno col" id="menu-aluno-nparciais" >
          <i class="fas fa-graduation-cap text-center"></i>
            <h4 class="text-center" id="h4-notas-parciais">Notas Parciais</h4>
            <div>
            <a href="../frontend/exibe_notas_parciais.php">Acessar</a>
            </div>
          </div>
        </div>
        <div class="row align-items-start" >
          <div class="menu-aluno col" id="menu-aluno-formulario" >
          <i class="fas fa-calendar text-center"></i>
            <h4 class="text-center" id="h4-agenda">Agenda</h4>
            <div>
            <a href="https://workspace.google.com/intl/pt-BR/products/calendar/" target="_blank">Acessar</a>
            </div>
          </div>
          <div class="menu-aluno col" id="menu-aluno-respondidos" >
            <i class="fas fa-book text-center"></i>
            <h4 class="text-center" id="h4-disciplinas">Disciplinas</h4>
            <div>
            <a href="../frontend/exibe_disciplina.php">Acessar</a>
            </div>
          </div>
          <div class="menu-aluno col" id="menu-aluno-nparciais" >
            <i class="fas fa-user text-center"></i>
            <h4 class="text-center" id="h4-perfil">Perfil</h4>
            <div>
            <a href="">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      
    

    <footer class="rodape-tela-principal">
      <center>
        <p class="rodape-texto-tela-principal"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16" style="margin: 0 5px 0 0;" >
          <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z"/>
        </svg>Todos os direitos reservados<a href="" style="margin: 0 0 0 20px;" >Política de privacidade </a>|<a href=""> Termos</a> </p>
      </center>
    </footer>
</body>
</html>

<script src="script.js" ></script>