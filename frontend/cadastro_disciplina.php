
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-form.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <title>DashAcad</title>
</head>
<body>

  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
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
<span><button id="btn-hamburguer" onclick="toggleMenu()">&#9776;</button></span>
        <div class="container-fluid">
            <div class="row col-md-12">
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-4 div-foto-perfil">
                    <img src = <?php echo "'" . $foto_usuario . "'";?> alt="Foto do perfil" id="img-fluid-usuario" class="img-fluid rounded-circle" >
                  </div>
                    <div class="col-sm-8">
                      <h6 id="nome-usuario"><?php echo $nome_usuario;?></h6>
                      <p id="email-usuario"><?php echo $email_usuario;?></p>
                    </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <img src="imagens/Logo-DashAcad01.png" alt="Logo do site" id="img-fluid-logo" class="img-fluid">
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
    <div class="menu-vertical menu-oculto">
        <ul class="nav flex-column">
            <li class="nav-item">
                <button id="btn-turma" onclick="exibirCadastrarTurma()">Turmas<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16" style="margin: 0 0 0 5px;"> 
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                </svg></button>
                <a class="nav-link active" aria-current="page" href="cadastro_turma.php" id="nav-link-cadastrar-turma" style="display:none">Cadastrar</a>
                <a class="nav-link active" aria-current="page" href="#" id="nav-link-visualizar-turma" style="display:none">Visualizar</a>
            </li>
            <li class="nav-item">
                <button id="btn-disciplina" onclick="exibirCadastrarDisciplina()">Disciplina <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                  <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg> </button>
                <a class="nav-link active" aria-current="page" href="#" id="nav-link-cadastrar-disciplina" style="display:none">Cadastrar</a>
                <a class="nav-link active" aria-current="page" href="#" id="nav-link-visualizar-disciplina" style="display:none">Visualizar</a>
            </li>
   
            </ul>
            <button onclick="window.location.href = 'formulario.html';"  id="btn-criar-form">Criar formulário <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#023D54" class="bi bi-plus-lg" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
              </svg></button>
          <h5 id="graficos">Gráficos</h4>
          <div class="container text-center">
              <div class="row align-items-start" id="btn-deslizar">
                <div class="col" >
                    <button id="btn-pizza">
                        <img id="img-btn-pizza" src="imagens/pizza.png" alt="imagem do botão gráfico-pizza">
                    </button>
                    <label id="lbl-pizza" for="btn-pizza">Pizza</label>
                </div>
                <div class="col">
                  <button id="btn-linha">
                      <img id="img-btn-linha" src="imagens/linha.png" alt="imagem do botão gráfico-linha">
                  </button>
                  <label id="lbl-linha" for="">Linha</label>
                </div>
                <div class="col">
                  <button id="btn-coluna">
                      <img id="img-btn-coluna" src="imagens/colunas.png" alt="imagem do botão gráfico-coluna">
                  </button>
                  <label id="lbl-coluna" for="">Colunas</label>
                </div>
                <div class="col">
                  <button id="btn-barra">
                      <img id="img-btn-barra" src="imagens/barras.png" alt="imagem do botão gráfico-barra">
                  </button>
                  <label id="lbl-barra" for="">Barras</label>
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
 
  
  <script src="script.js" ></script>


  <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>

  <div id="transparente"></div>

<div id="modal-registro-disciplina">
    <div id="div-registro-disciplina">
    <span><a  class="fa fa-arrow-left" id="btn-voltar-turma" href="home.php"></a></span>
      <form action="../backend/registro_disciplina.php" method="POST" >
        <h4 id="h4-reg-disciplina">Cadastrando Disciplina</h4>
        <label id="nome-disciplina" for="nome-disciplina">Insira um nome para a nova disciplina:</label>
        <p id="p-disciplina">Exemplo: História</p>
        <input type="text" id="input-nome-disciplina" name="input-nome-disciplina"><br><br>
        <button id="btn-salvar-disciplina"  type ="submit">Criar</button>
      </form>
    </div>
  </div>
  
</body>
</html>



