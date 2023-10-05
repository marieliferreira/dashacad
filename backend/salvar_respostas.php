<?php
include("conexao.php");

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
                    'questao_codigo' => $questao_id,
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
        $resultado_usuario = mysqli_query($mysqli, $consulta_usuario);
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
            // Fora do loop de respostas
            $nota_total = 0;
            $questoes_certas = 0; // Inicializa o número de questões corretas

            foreach ($respostas as $resposta) {
                // Verifique se a alternativa escolhida pelo aluno está marcada como "correta" no banco de dados
                $alternativa_id = $resposta['alternativa_id'];
                $questao_id = $resposta['questao_codigo'];

                $query_verificar_codigo_questao = "SELECT QUE_CODIGO FROM tbl_alternativas WHERE ALT_CODIGO = '$alternativa_id'";
                $result_verificar_codigo_questao = $mysqli->query($query_verificar_codigo_questao);

                if ($result_verificar_codigo_questao->num_rows > 0) {
                    $row_codigo_questao = $result_verificar_codigo_questao->fetch_assoc();
                    $questao_codigo = $row_codigo_questao['QUE_CODIGO'];

                    $query_verificar_correta = "SELECT ALT_STATUS FROM tbl_alternativas WHERE ALT_CODIGO = '$alternativa_id' AND ALT_STATUS = 'certo'";
                    $result_verificar_correta = $mysqli->query($query_verificar_correta);

                    if ($result_verificar_correta->num_rows > 0) {
                        // Se a alternativa for correta, adicione pontos à nota total
                        $questoes_certas++;
                    }
                }
            }

            // Após processar todas as respostas, calcule a nota final
            if (count($respostas) > 0) {
                $nota_total = ($questoes_certas * 10) / count($respostas);
            } else {
                $nota_total = 0;
            }

            // O código do formulário agora é acessado corretamente usando $_POST
            $codigo_formulario = $_POST['codigo_formulario'];

            // Insira a nota total na tabela tbl_nota_formulario
            $query_inserir_nota = "INSERT INTO tbl_nota_formulario (FOR_CODIGO, NFO_NOTA, USU_CODIGO_CAD, USU_CODIGO_ALT, NFO_TOTAL_QUESTOES_CERTAS, FOR_STATUS) VALUES ('$codigo_formulario', '$nota_total', '$usuario_codigo', '$usuario_codigo', '$questoes_certas', 'respondido')";
            $result_inserir_nota = $mysqli->query($query_inserir_nota);

            if (!$result_inserir_nota) {
                echo "Erro ao inserir nota: " . $mysqli->error;
            } else {

                // Obtenha o ID da última linha inserida
                $last_insert_id = $mysqli->insert_id;

                // Após inserir a nota, você pode recuperar os valores da tabela para exibir no modal
                $query_resposta_total = "SELECT NFO_NOTA, NFO_TOTAL_QUESTOES_CERTAS FROM tbl_nota_formulario WHERE NFO_CODIGO = '$last_insert_id' AND USU_CODIGO_CAD = '$usuario_codigo'";
                $result_resposta_total = $mysqli->query($query_resposta_total);

                if (!$result_resposta_total) {
                    echo "Erro ao buscar informações da nota: " . $mysqli->error;
                } else {
                    // Exiba as informações no modal
                    $row_resposta_total = $result_resposta_total->fetch_assoc();
                    $nota_total = $row_resposta_total['NFO_NOTA'];
                    $total_questoes = $row_resposta_total['NFO_TOTAL_QUESTOES_CERTAS'];

                    echo '<h5 id="modal-title">Resultados:</h5>';
                    echo '<p>Nota: ' . $nota_total . '</p>';
                    echo '<p>Questões certas: ' . $total_questoes . ' de ' . count($respostas) . '</p>';
                }
            }
        }
    }
    $mysqli->close();
} else {
    echo "Método de requisição inválido.";
}
?>
