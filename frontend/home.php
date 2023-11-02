<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
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
    <div class="menu-vertical">
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
            <div id="body-home">
              <button onclick="window.location.href = 'formulario.php';"  id="btn-criar-form">Criar formulário <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#023D54" class="bi bi-plus-lg" viewBox="0 0 16 16">
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
    <div id="div-branca-grafico">
            <div id="div-azul-grafico"><h6>Quantidade de alunos por turma</h6></div>
            <canvas id="quant-aluno"></canvas>
    </div>
    <footer class="rodape-tela-principal">
      <center>
        <p class="rodape-texto-tela-principal"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16" style="margin: 0 5px 0 0;" >
          <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z"/>
        </svg>Todos os direitos reservados<a href="" style="margin: 0 0 0 20px;" >Política de privacidade </a>|<a href=""> Termos</a> </p>
      </center>
    </footer>

    <script>

    // Obtém o elemento do botão pelo ID
    var btnLinha = document.getElementById("btn-linha");

    // Adiciona um evento de clique ao botão
    btnLinha.addEventListener("click", function() {
        // Redireciona para a página chart.php
        window.location.href = "linha-evolucao.php";
    });

    var btnPizza = document.getElementById("btn-pizza");

    // Adiciona um evento de clique ao botão
    btnPizza.addEventListener("click", function() {
        // Redireciona para a página chart.php
        window.location.href = "pizza-acertos.php";
    });

    var btnColuna = document.getElementById("btn-coluna");

    // Adiciona um evento de clique ao botão
    btnColuna.addEventListener("click", function() {
        // Redireciona para a página chart.php
        window.location.href = "comparativo-media.php";
    });

    var btnBarra = document.getElementById("btn-barra");

    // Adiciona um evento de clique ao botão
    btnBarra.addEventListener("click", function() {
        // Redireciona para a página chart.php
        window.location.href = "barra-formularios-respondidos.php";
    });

        document.addEventListener("DOMContentLoaded", function() {
            // Obtenha o contexto do canvas
            var ctx = document.getElementById('quant-aluno').getContext('2d');

            // Faça uma solicitação AJAX para obter os dados do servidor
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../backend/quant-aluno.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var dados = JSON.parse(xhr.responseText);
                    
                    // Extrai os nomes das turmas e a quantidade de alunos em cada turma
                    var turmas = dados.map(function(item) {
                        return item.TUR_SERIE;
                    });
                    var quantidadeAlunos = dados.map(function(item) {
                        return item.quantidade_alunos;
                    });

                    // Criação do gráfico
                    var chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: turmas,
                            datasets: [{
                                label: 'Quantidade de Alunos por Turma',
                                data: quantidadeAlunos,
                                backgroundColor: ['rgba(0, 255, 0, 0.5)', 'rgba(255, 0, 0, 0.5)', 'rgba(0, 0, 255, 0.5)', 'rgba(255, 165, 0, 0.5)'],
                                borderColor: ['rgba(0, 255, 0, 1)', 'rgba(255, 0, 0, 1)', 'rgba(0, 0, 255, 1)', 'rgba(255, 165, 0, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>