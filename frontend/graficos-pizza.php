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
    <link rel="stylesheet" href="chart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script src="script.js"></script>
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
                <a class="nav-link active" aria-current="page" href="exibe_turma.php" id="nav-link-visualizar-turma" style="display:none">Visualizar</a>
            </li>
            <li class="nav-item">
                <button id="btn-disciplina" onclick="exibirCadastrarDisciplina()">Disciplina <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                  <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg> </button>
                <a class="nav-link active" aria-current="page" href="cadastro_disciplina.php" id="nav-link-cadastrar-disciplina" style="display:none">Cadastrar</a>
                <a class="nav-link active" aria-current="page" href="exibe_disciplina.php" id="nav-link-visualizar-disciplina" style="display:none">Visualizar</a>
            </li>
            <li class="nav-item">
                <button id="btn-formulario" onclick="exibirCriarFormulario()">Formulário <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                </svg></button>
                <a class="nav-link active" aria-current="page" href="formulario.php" id="nav-link-criar-formulario" style="display:none">Criar</a>
                <a class="nav-link active" aria-current="page" href="exibe-formulario.php" id="nav-link-visualizar-formulario" style="display:none">Visualizar</a>
            </li>
            <li class="nav-item">
                <button  id="btn-calendario"><a href="https://workspace.google.com/intl/pt-BR/products/calendar/" target="_blank" style="text-decoration: none; color: inherit;">Calendário<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/></svg></a> </button>
            </li>
          </ul>
            </div>
              
<div id="div-tbl">
<span ><a  class="fa fa-arrow-left" id="btn-voltar-disciplina" href="home.php"></a></span>
    <h4 id="h4-form">Gráficos de pizza</h1>
    <br>
    <br>
    <p>
    <a id="grafico-n1" class="grafico" href="pizza-acertos.php">Desempenho do aluno por formulário</a>
    </p>
    <p>
        <a id="grafico-n2" class="grafico" href="quant-aluno-turma.php">Quantidade de alunos por turma</a>
    </p>

    
</div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous">


    <div id="menu-div-transparente"></div>

    <script>

    function toggleMenu() {
      var menuVertical = document.querySelector(".menu-vertical");
      menuVertical.classList.toggle("menu-oculto");
    }


document.addEventListener("DOMContentLoaded", function() {
    // Obtém o botão hamburguer pelo ID
    var btnHamburguer = document.getElementById("btn-hamburguer");
    
    // Obtém a div transparente pelo ID
    var divTransparente = document.getElementById("menu-div-transparente");
    
    // Adiciona um evento de clique ao botão hamburguer
    btnHamburguer.addEventListener("click", function() {
        // Verifica o estado atual da div transparente
        if (divTransparente.style.display === "block") {
            // Se estiver visível, oculta a div
            divTransparente.style.display = "none";
        } else {
            // Se estiver oculta, mostra a div
            divTransparente.style.display = "block";
        }
    });
});

</script>
</body>
</html>

