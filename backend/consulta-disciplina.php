<?php
// inclua o arquivo de conexão com o banco de dados aqui
include("conexao.php");

// query para buscar as disciplinas
$consulta = "SELECT DIS_NOME FROM tbl_disciplina";
$result = $mysqli->query($consulta);

// verifica se foram encontradas disciplinas
if ($result->num_rows > 0) {
  // cria um array com as disciplinas encontradas
  $disciplinas = array();
  while ($row = $result->fetch_assoc()) {
    $disciplinas[] = $row;
  }

  // converte o array em JSON e envia como resposta
  header('Content-Type: application/json');
  echo json_encode($disciplinas);
} else {
  echo "Nenhuma disciplina encontrada no banco de dados.";
}

?>