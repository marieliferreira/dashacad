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
<?php
session_start();

if (!isset($_SESSION['nome'])) {
    echo "<script>window.location.href = 'login.html'; </script>";
} else {
    $codigo_usuario = $_SESSION['codigo-usuario'];
    $nome_usuario = $_SESSION['nome'];
    $email_usuario = $_SESSION['email'];
    $foto_usuario = $_SESSION['foto'];
}

if (isset($_POST['botao-logout'])) {
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
                    <img src=<?php echo "'" . $foto_usuario . "'";?> alt="Foto do perfil" class="img-fluid rounded-circle" >
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
                    <a href="login.html"><svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></a>
                </svg>
              </div>
            </div>
          </div>
          
    </div>

    <?php
    include("../backend/conexao.php");

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

    // 1. Consulta SQL para buscar questões e alternativas
    $query = "SELECT q.QUE_CODIGO AS questao_id, q.QUE_DESCRICAO AS questao_texto, a.ALT_CODIGO AS alternativa_id, a.ALT_DESCRICAO AS alternativa_texto 
    FROM tbl_questao q 
    LEFT JOIN tbl_alternativas a ON q.QUE_CODIGO = a.QUE_CODIGO WHERE q.FOR_CODIGO = '$codigo'";

    $result = $mysqli->query($query);
    ?>

    <div id="titulo-form">
        <span>
            <label id="lbl-codigo-form" for=""><?php echo 'F' . $codigo . '.' ?></label>
            <label id="input-titulo-form" for=""> <?php echo $titulo ?> </label>
        </span>
        <label id="input-desc-form" for=""> <?php echo $descricao ?> </label>
    </div>
    
    <div id="questions-form">
        <form id="form-questao" method="POST">
            <!-- Substitua "processar_respostas.php" pelo script que processará as respostas -->
            <input type="hidden" id="codigo_formulario" name="codigo_formulario" value="<?php echo $codigo ?>">
            <?php
            if ($result) {
                $questions = []; // Crie um array para armazenar as questões
                $current_question_number = 0; // Inicialize o número da questão
                while ($row = $result->fetch_assoc()) {
                    $question_id = $row['questao_id'];
                    if (!isset($questions[$question_id])) {
                        // Se a questão ainda não estiver no array, crie-a
                        $current_question_number++; // Incrementa o número da questão
                        $questions[$question_id] = [
                            'questao_texto' => $row['questao_texto'],
                            'alternativas' => [],
                            'numero' => $current_question_number, // Armazena o número
                            'questao_codigo' => $question_id,
                        ];
                    }
                    // Adicione a alternativa à questão correspondente
                    $questions[$question_id]['alternativas'][] = [
                        'alternativa_id' => $row['alternativa_id'],
                        'alternativa_texto' => $row['alternativa_texto'],
                    ];
                }

                // Itera pelas questões e exibe-as
                foreach ($questions as $question) {
                    echo '<div id="div-questao">';
                    echo '<p id="p-questao"><strong>Questão ' . $question['numero'] . ': </strong>' . $question['questao_texto'] . '</p>';
                    
                    
                    foreach ($question['alternativas'] as $alternative) {
                        echo '<label id=lbl-alt>';
                        echo '<input class = "input-alt" type="radio" id="questao_' . $question['numero'] . '" name="questao_' . $question['numero'] . '" value="' . $alternative['alternativa_id'] . '">';
                        echo '<label id="lbl-alt" for="questao_' . $question['questao_codigo'] . '">' . $alternative['alternativa_texto'];
                        echo '</label><br>';
                    }
                    echo '</div>';
                    
                }
                
                //print_r ($questions);
            }
            ?>
            
            <input id="botao-enviar-respostas" type="submit" value="Enviar Respostas">
            
        </form>
    </div>

    <!-- Modal para exibir os resultados -->
    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="resultadoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="modal-respostas" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultadoModalLabel">Resultados:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-resultados">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    
        <script>
        // Use JavaScript para abrir o modal após a submissão do formulário
        document.getElementById("form-questao").addEventListener("submit", function (e) {
            e.preventDefault(); // Evita que o formulário seja enviado normalmente
            var modalBody = document.getElementById("modal-body-resultados");
            modalBody.innerHTML = '<h5 class="modal-title">Enviando Respostas...</h5>'; // Mensagem de carregamento
            var myModal = new bootstrap.Modal(document.getElementById("resultadoModal"));
            myModal.show();

            // Envie o formulário usando Ajax
            var formData = new FormData(this);
            fetch("../backend/salvar_respostas.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.text())
            .then(result => {
                // Atualize o conteúdo do modal com os resultados
                modalBody.innerHTML = result;
            })
            .catch(error => {
                console.error("Erro ao enviar o formulário:", error);
                modalBody.innerHTML = '<p>Ocorreu um erro ao enviar as respostas.</p>';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"></script>
</body>
</html>
