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
    <div class="cabecalho-branco-home">


        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="imagens/foto.png" alt="Foto do perfil" class="img-fluid rounded-circle">
                  </div>
                  <div class="col-sm-8">
                    <h6 id="nome-usuario">Nome do usuário</h6>
                    <p id="email-usuario">emaildousuário@gmail</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <img src="imagens/Logo-DashAcad01.png" alt="Logo do site" class="img-fluid">
              </div>
              <div class="col-sm-4 text-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"      class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
              </div>
            </div>
          </div>      
    </div>

    <?php
      // Verifica se o parâmetro "codigo" foi fornecido na URL
      if (isset($_GET['codigo'])) {
          $codigo = $_GET['codigo'];

          // Verifica se os parâmetros "titulo" e "descricao" foram fornecidos na URL
          if (isset($_GET['titulo']) && isset($_GET['descricao'])) {
              $codigo = $_GET['codigo'];
              $titulo = $_GET['titulo'];
              $descricao = $_GET['descricao'];

             
          }
      }

       // Salva a questão no banco de dados


      ?>



    <div id="titulo-form">
        <spam>
          <label id="lbl-codigo-form" for=""><?php echo 'F' . $codigo . '.' ?></label>
          <label id="input-titulo-form" for=""> <?php echo $titulo ?> </label>
        </spam>
        <label id="input-desc-form" for="" > <?php echo $descricao ?> </label>
    </div>
    
      <div id="resultado" ></div>

      <form>
        <div id="div-new-questao">
            <h6 for="">Nova pergunta:</h6>
            <input type="text" id="input-new-questao" name="input-new-questao">
            <input type="hidden" id="codigo-formulario" name="codigo-formulario" value=<?php echo $codigo;?>>
            <!-- <a href="#" class= "btn btn-dark d-block" onclick="addQuestion()" id="btn-criar-questao">Criar</a> -->
            <a href="#" class= "btn btn-dark d-block" id="btn-criar-questao">Criar</a>

            <!-- <div id="mensagem" ></div> -->
          </div>
      </form>
    

      <span ><a  class="fa fa-arrow-left" id="btn-voltar" href="home.php"></a></span>
      

     

      

    <form action="" id="questions-form" method="POST">
      
    </form>
    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous">
    </script>

    <!--<script>
      $(document).ready(function() {
        $(".add-option-btn").click(function() {
            var questaoId = $(this).data('atividade-id');
            $('#atividadeId-edicao').val(atividadeId);
        });
      });
    </script>-->

    <script>
        // $(document).ready(function() {
        //   console.log("teste");
        // });

        // Verifica se existem dados armazenados no localStorage
        $(document).ready(function() {
        // Verifica se existem dados armazenados no localStorage
        if (localStorage.getItem('questoes')) {
          // Recupera os dados das questões
          const questoes = JSON.parse(localStorage.getItem('questoes'));

          // Percorre as questões e adiciona ao formulário
          questoes.forEach((questao) => {
            // Verificar se a questão pertence ao formulário atual
            if (questao.codigo_formulario === <?php echo json_encode($codigo); ?>) {
              addQuestion(questao.codigo_questao, questao.nome_questao);
            }
          });
        }
      });

      $(document).ready(function() {
        // Verifica se existem dados armazenados no localStorage
        if (localStorage.getItem('alternativas')) {
          // Recupera os dados das questões
          const alternativas = JSON.parse(localStorage.getItem('alternativas'));

          // Percorre as questões e adiciona ao formulário
          alternativas.forEach((alternativa) => {
            addOption(alternativa.codigo_alternativa, alternativa.nome_alternativa);
          });
        }
      });

        $("#btn-criar-questao").click(
            function() {
                // alert("Teste");
                $("#resultado").text("");
                var novaQuestao = $("#input-new-questao").val();
                var codigoFormulario = $("#codigo-formulario").val();

              if (codigoFormulario === <?php echo json_encode($codigo); ?>) {

                $.ajax({
                  method: "POST",
                  url: "../backend/registro-questao.php",
                  data: {
                    'input-new-questao': novaQuestao,
                    'codigo-formulario': codigoFormulario,
                  }
                }).done(function(codigoQuestao) {
                  if (codigoQuestao > 0) {
                    $("#mensagem").fadeIn();
                    setTimeout(function() {
                      $("#mensagem").fadeOut();
                    }, 3000);
                  }

                  // Armazena os dados das questões no localStorage
                  const questaoData = {
                    codigo_formulario: codigoFormulario,
                    codigo_questao: codigoQuestao,
                    nome_questao: novaQuestao,
                  };

                  if (localStorage.getItem('questoes')) {
                    // Recupera os dados existentes
                    const questoes = JSON.parse(localStorage.getItem('questoes'));
                    // Adiciona a nova questão aos dados existentes
                    questoes.push(questaoData);
                    // Atualiza os dados no localStorage
                    localStorage.setItem('questoes', JSON.stringify(questoes));
                  } else {
                    // Cria um novo array de questões e adiciona a primeira questão
                    const questoes = [questaoData];
                    // Armazena os dados no localStorage
                    localStorage.setItem('questoes', JSON.stringify(questoes));
                  }
                  // Adicione a nova questão ao formulário
                  // Adicione a nova questão ao formulário
                    addQuestion(questaoData.codigo_questao, questaoData.nome_questao);
                  });
              } else {
                console.log("A nova questão não pertence ao formulário atual.");
              }
            }
        );

        $("#btn-salvar-opcao").click(
            function() {
                // alert("Teste");
                $("#resultado").text("");
                var novaAlternativa = $("#option-text").val();
                var codigoAlternativa = $("#option-hidden").val();

                $.ajax({
                  method: "POST",
                  url: "../backend/registro_alternativa.php",
                  data: {
                    'option-text': novaAlternativa,
                    'option-hidden': codigoAlternativa,
                  }
                }).done(function(codigoAlternativa) {
                  if (codigoAlternativa > 0) {
                    $("#mensagem").fadeIn();
                    setTimeout(function() {
                      $("#mensagem").fadeOut();
                    }, 3000);
                  }
                  addOption(codigoAlternativa, novaAlternativa);

                  // Armazena os dados das questões no localStorage
                  const alternativaData = {
                    codigo_alternativa: codigoAlternativa,
                    nome_alternativa: novaAlternativa,
                  };

                  if (localStorage.getItem('alternativas')) {
                    // Recupera os dados existentes
                    const alternativas = JSON.parse(localStorage.getItem('alternativas'));
                    // Adiciona a nova questão aos dados existentes
                    questoes.push(alternativaData);
                    // Atualiza os dados no localStorage
                    localStorage.setItem('alternativas', JSON.stringify(alternativas));
                  } else {
                    // Cria um novo array de questões e adiciona a primeira questão
                    const alternativas = [alternativaData];
                    // Armazena os dados no localStorage
                    localStorage.setItem('alternativas', JSON.stringify(alternativas));
                  }
                  }
                  
                );
            }
        );
              
    </script>
<!--<script>
        // $(document).ready(function() {
        //   console.log("teste");
        // });

    $("#id-btn-salvar-opcao").click(function() {
      $("#resultado").text("");
      var descricao_alternativa = $("#option-text").val();
      var questao_codigo = $("#option-hidden").val();
      var checkbox = $("#option-checkbox").val();
    
    $.ajax({
        method: "POST",
        url: "../backend/registro_alternativa.php",
        data: { 
            'option-text': descricao_alternativa,
            'option-hidden': questao_codigo,
            'option-checkbox': checkbox
        }
    }).done(function(resposta,codigo_alternativa) {
            console.log(codigo_alternativa);

            if (resposta == 'Ok') {
                window.location = "../frontend/home.php";
            } else {
                $("#login_error").text(resposta);
            }
        });
    });
              
    </script>-->



</body>
</html>

<script src="form.js"></script>
