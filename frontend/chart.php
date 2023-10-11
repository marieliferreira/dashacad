<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="chart.css">
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

<div class="cabecalho-branco-home no-print">


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
  
<div class="print-container">
  <div id="div-fundo-grafico">
  <a class="fa fa-arrow-left" id="btn-voltar-registro" href="home.php"></a>
    <form id="filtro-aluno-form" >
          <h4 id="h4-reg-form" class="print-only">Gráfico de linhas</h4>
    
          <label id="lbl-aluno" for="aluno">Alunos:</label>
          <select id="aluno" name="aluno" >
          <option value="">Selecione um aluno</option>
          </select>
    
          <a id="btn-filtrar" class="no-print" type ="button">Filtrar</a>
    </form>

    <button id="btn-imprimir" class="no-print" type="button">Imprimir Gráfico</button>

        <script
          src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
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
      <div>
        <canvas id="myChart" class="print-only" style="width:100%;max-width:700px"></canvas>
      </div>

      
    <script>
        $(document).ready(function () {
        // Manipula o clique no botão "Filtrar"
        $('#btn-filtrar').on('click', function () {
            // Obtem o valor selecionado do <select>
            var alunoSelecionado = $('#aluno').val();
            // Realiza a solicitação AJAX com o valor do aluno selecionado
            $.ajax({
                type: "POST",
                url: "../backend/chart.php",
                data: { aluno: alunoSelecionado },
                dataType: "json",
                success: function (data) {
                    // Processa os dados e cria o gráfico
                    if (data && data.length > 0) {
                        var formularioarray = [];
                        var notaarray = [];
                        for (var i = 0; i < data.length; i++) {
                            formularioarray.push(data[i].FOR_CODIGO); // Pegando o formulario
                            notaarray.push(data[i].NFO_NOTA); // Pegando a nota
                        }
                        criarGrafico(formularioarray, notaarray);
                    } else {
                        console.error("Dados inválidos ou vazios.");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        });

        // Manipula o clique no botão "Imprimir"
        $('#btn-imprimir').on('click', function () {
            // Chame a função para imprimir o gráfico
            imprimirGrafico();
        });

        function imprimirGrafico() {
            window.print();
        }

        });
        // Função para criar o gráfico
        // Função para criar o gráfico
// Função para criar o gráfico
function criarGrafico(formulario, nota) {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = null;

    
    // Verifica se já existe um gráfico e o destrói
    if (chart !== null) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formulario,
            datasets: [{
                label: 'Nota',
                backgroundColor: 'transparent',
                borderColor: 'blue',
                data: nota
            }]
        },
        options: {
          title: { // Adicione esta seção para o título
            display: true,
            text: 'Evolução do aluno', // Substitua por seu título desejado
            fontSize: 16, // Tamanho da fonte do título
            fontColor: 'black' // Cor da fonte do título
        },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Formulários', // Substitua 'Eixo X' pelo rótulo desejado para o eixo X
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Notas', // Substitua 'Eixo Y' pelo rótulo desejado para o eixo Y
                    },
                }],
            }
        }
    });
}


    </script>
    
  </div>
</div>
</body>
</html>