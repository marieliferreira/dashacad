<?php
include("../backend/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicialize arrays para armazenar informações das respostas
    $respostas = [];

    // Iterar pelos campos do formulário (cada campo corresponde a uma resposta)
    foreach ($_POST as $key => $value) {
        // Verifique se o campo começa com "questao_" para identificar as respostas
        if (strpos($key, 'questao_') === 0) {
            $questao_id = substr($key, 8); // Extrai o ID da questão do nome do campo
            $alternativa_id = $value; // O valor do campo é o ID da alternativa selecionada

            // Consulta SQL para buscar a descrição da alternativa com base no ID
            $query_alternativa = "SELECT ALT_DESCRICAO FROM tbl_alternativas WHERE ALT_CODIGO = '$alternativa_id'";
            $result_alternativa = $mysqli->query($query_alternativa);

            // Verifique se a consulta foi bem-sucedida
            if ($result_alternativa) {
                $row_alternativa = $result_alternativa->fetch_assoc();

                // Crie um array com informações da resposta
                $resposta = [
                    'questao_id' => $questao_id,
                    'alternativa_id' => $alternativa_id,
                    'alternativa_descricao' => $row_alternativa['ALT_DESCRICAO'],
                ];

                // Adicione a resposta ao array de respostas
                $respostas[] = $resposta;
            } else {
                echo "Erro ao buscar descrição da alternativa: " . $mysqli->error;
            }
        }
    }

     session_start(); // Certifique-se de chamar session_start() no início do seu script

    // O usuário está logado, então podemos pegar o seu código
   if (isset($_SESSION['codigo-usuario'])) {
    $usu_codigo = $_SESSION['codigo-usuario'];
    $consulta_usuario = "SELECT USU_CODIGO FROM tbl_usuario WHERE USU_CODIGO = '$usu_codigo'";
    $resultado_usuario = mysqli_query($mysqli,$consulta_usuario);
    } else {
    echo "Erro: Usuário não está logado.";
    return;
    }



    if ($resultado_usuario->num_rows > 0) {
        // Retornou um registro - recuperar o ID do usuário
        $row = $resultado_usuario->fetch_assoc();
        $usuario_codigo = $row["USU_CODIGO"];

        // Agora você pode inserir as respostas no banco de dados, incluindo o código do formulário
        if (!empty($respostas)) {
            foreach ($respostas as $resposta) {
                $questao_id = $resposta['questao_id'];
                $alternativa_id = $resposta['alternativa_id'];
                $alternativa_descricao = $resposta['alternativa_descricao'];

                 // O código do formulário agora é acessado corretamente usando $_POST
                $codigo_formulario = $_POST['codigo_formulario'];
    
                // Consulta SQL para inserir a resposta no banco de dados, incluindo o código do formulário
                $query_inserir_resposta = "INSERT INTO tbl_resposta_aluno (QUE_CODIGO, ALT_CODIGO, ALT_DESCRICAO, FOR_CODIGO, USU_CODIGO_CAD, USU_CODIGO_ALT) VALUES ('$questao_id', '$alternativa_id', '$alternativa_descricao', '$codigo_formulario', '$usuario_codigo', '$usuario_codigo')";
    
                // Execute a consulta para inserir a resposta
                $result_inserir_resposta = $mysqli->query($query_inserir_resposta);
    
                if (!$result_inserir_resposta) {
                    echo "Erro ao inserir resposta: " . $mysqli->error;
                }
            }

            // Agora, calcule a nota com base nas respostas
            $nota_total = 0;

            foreach ($respostas as $resposta) {
                // Verifique se a alternativa escolhida pelo aluno está marcada como "correta" no banco de dados
                $alternativa_id = $resposta['alternativa_id'];
                $questao_id = $resposta['questao_id'];

                $query_verificar_correta = "SELECT ALT_STATUS FROM tbl_alternativas WHERE ALT_CODIGO = '$alternativa_id' AND QUE_CODIGO = '$questao_id' AND ALT_STATUS = 'certo'";
                $result_verificar_correta = $mysqli->query($query_verificar_correta);

                if ($result_verificar_correta->num_rows > 0) {
                    // Se a alternativa for correta, adicione pontos à nota total
                    $nota_total += 1; // Pode ajustar essa lógica de acordo com o valor das questões
                }
            }

            // Insira a nota total na tabela tbl_nota_formulario
            $query_inserir_nota = "INSERT INTO tbl_nota_formulario (FOR_CODIGO, NFO_NOTA, USU_CODIGO_CAD, USU_CODIGO_ALT) VALUES ('$codigo_formulario', '$nota_total', '$usuario_codigo', '$usuario_codigo')";
            $result_inserir_nota = $mysqli->query($query_inserir_nota);

            if (!$result_inserir_nota) {
                echo "Erro ao inserir nota: " . $mysqli->error;
            }else{
                // Exiba a nota e a quantidade de questões certas em um card body
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Resultados:</h5>';
                echo '<p class="card-text">Nota: ' . $nota_total . '</p>';
                echo '<p class="card-text">Questões certas: ' . $nota_total . ' de ' . count($respostas) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        }
            
    }
    $mysqli->close();
} else {
    echo "Método de requisição inválido.";
}
?>
