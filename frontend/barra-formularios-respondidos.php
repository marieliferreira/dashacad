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
                        <img src="<?php echo $foto_usuario; ?>" alt="Foto do perfil" class="img-fluid rounded-circle">
                    </div>
                    <div class="col-sm-8">
                        <h6 id="nome-usuario"><?php echo $nome_usuario; ?></h6>
                        <p id="email-usuario"><?php echo $email_usuario; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <img src="imagens/Logo-DashAcad01.png" alt="Logo do site" class="img-fluid">
            </div>
            <div class="col-sm-4 text-right botao-logout">
                <a href="login.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                         class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="print-container">
    <div id="div-fundo-grafico">
        <a class="fa fa-arrow-left no-print" id="btn-voltar-registro" href="home.php"></a>
        <form id="filtro-form">
            <h4 id="h4-reg-form" class="print-only">Gráfico de barra</h4>
            <label id="lbl-disciplina-barra" for="disciplina-barra">Disciplina:</label>
            <select id="disciplina-barra" name="disciplina-barra">
                <option value="">Escolha a disciplina</option>
            </select>
            <a id="btn-filtrar-barra" class="no-print" type="button">Filtrar</a>
        </form>
        <button id="btn-imprimir" class="no-print" type="button">Imprimir Gráfico</button>
        <div>
            <canvas id="myChart" class="print-only" style="width:100%;max-width:700px"></canvas>
        </div>

        <script
          src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                // Chama a função ao carregar a página
                preencheSelectDisciplina();
            });

            function preencheSelectDisciplina() {
            // faz uma solicitação AJAX para o arquivo PHP
            $.ajax({
                url: '../backend/consulta-disciplina.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                // adiciona cada disciplina como uma opção no campo select
                for (var i = 0; i < data.length; i++) {
                    $('#disciplina-barra').append($('<option>', {
                    value: data[i].DIS_CODIGO,
                    text: data[i].DIS_NOME
                    }));
                }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
            }

            $('#btn-filtrar-barra').on('click', function () {
    var disciplinaSelecionada = $('#disciplina-barra').val();

    $.ajax({
        type: "POST",
        url: "../backend/disciplina-barra.php",
        data: {
            "disciplina_barra": disciplinaSelecionada
        },
        success: function (data) {
            if (data) {
                // Crie um gráfico de barras com os dados recebidos do PHP
                criarGraficoBarras(data);
            } else {
                console.error("Dados inválidos ou vazios.");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Erro na solicitação AJAX:", textStatus, errorThrown);
            // Trate o erro, exiba uma mensagem para o usuário, etc.
        }
    });
});

function criarGraficoBarras(data) {
    // Os dados retornados do PHP devem ser um array associativo com os códigos de formulário e a quantidade de respostas
    var codigosFormulario = [];
    var totalRespostas = [];

    for (var i = 0; i < data.length; i++) {
        codigosFormulario.push(data[i].FOR_CODIGO);
        totalRespostas.push(data[i].total_respostas);
    }

    // Crie um gráfico de barras usando a biblioteca Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: codigosFormulario,
            datasets: [{
                label: 'Total de Respostas',
                data: totalRespostas,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor de fundo das barras
                borderColor: 'rgba(75, 192, 192, 1)', // Cor da borda das barras
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

            // Manipula o clique no botão "Imprimir"
            $('#btn-imprimir').on('click', function () {
                // Chame a função para imprimir o gráfico
                imprimirGrafico();
            });

            function imprimirGrafico() {
                window.print();
            }

            
        </script>
    </div>
</div>
</body>
</html>
