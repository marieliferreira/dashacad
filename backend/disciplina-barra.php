<?php
include("conexao.php");

if(isset($_POST['disciplina_barra'])){
    $disciplinaCodigo = $_POST['disciplina_barra'];

    // Consulta para contar a quantidade de respostas para cada formulário
    $query = "SELECT f.FOR_CODIGO, COUNT(n.FOR_STATUS) AS total_respostas 
              FROM tbl_formulario f 
              LEFT JOIN tbl_nota_formulario n ON f.FOR_CODIGO = n.FOR_CODIGO 
              WHERE f.DIS_CODIGO = $disciplinaCodigo 
              AND n.FOR_STATUS = 'respondido' 
              GROUP BY f.FOR_CODIGO";

        $resultados = array();
        $result = mysqli_query($mysqli, $query);

        if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
             $resultados[] = $row;
         }
        }

    header('Content-Type: application/json');

    // Envia os dados como resposta para a requisição AJAX
    echo json_encode($resultados); // $resultados deve ser um array associativo com os dados do banco de dados
}
?>
