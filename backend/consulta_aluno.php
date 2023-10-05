<?php
// inclua o arquivo de conexão com o banco de dados aqui
include("conexao.php");

// query para buscar as turmas
$consulta = "SELECT USU_NOME FROM tbl_usuario WHERE USU_TIPO = 'Aluno'";
$result = $mysqli->query($consulta);

// verifica se foram encontradas turmas
if ($result->num_rows > 0) {
  // cria um array com as turmas encontradas
  $turmas = array();
  while ($row = $result->fetch_assoc()) {
    $turmas[] = $row;
  }

  // converte o array em JSON e envia como resposta
  header('Content-Type: application/json');
  echo json_encode($turmas);
} else {
  echo "Nenhum aluno encontrado no banco de dados.";
}

?>