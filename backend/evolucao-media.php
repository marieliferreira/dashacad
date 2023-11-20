<?php
include("conexao.php");

// Consulta SQL para obter a média de notas por disciplina ao longo do tempo
$sql = 
    "SELECT 
        df.DIS_NOME AS Disciplina,
        AVG(nf.NFO_NOTA) AS MediaPeriodo,
        DATE_FORMAT(f.FOR_DT_ENTREGA, '%m') AS Mes
    FROM tbl_nota_formulario nf
    INNER JOIN tbl_formulario f ON nf.FOR_CODIGO = f.FOR_CODIGO
    INNER JOIN tbl_disciplina df ON f.DIS_CODIGO = df.DIS_CODIGO
    GROUP BY df.DIS_NOME, DATE_FORMAT(f.FOR_DT_ENTREGA, '%Y-%m')
    ORDER BY df.DIS_NOME, DATE_FORMAT(f.FOR_DT_ENTREGA, '%Y-%m')";

$result = mysqli_query($mysqli, $sql);

if ($result->num_rows > 0) {
    // Array para armazenar os resultados
    $data = array();

    // Loop através dos resultados da consulta
    while ($row = $result->fetch_assoc()) {
        $data[$row['Disciplina']][] = array(
            'Mes' => $row['Mes'],
            'MediaPeriodo' => $row['MediaPeriodo']
        );
    }

    // Preencher com valores nulos para os meses ausentes
    $allDisciplinas = array(); // Lista de todas as disciplinas
    foreach ($data as $disciplina => $periodos) {
        $allDisciplinas[] = $disciplina;
        $months = array_column($periodos, 'Mes');
        $allMonths = array_map('intval', $months);
        $missingMonths = array_diff(range(1, 12), $allMonths);
        foreach ($missingMonths as $missingMonth) {
            $data[$disciplina][] = array(
                'Mes' => $missingMonth,
                'MediaPeriodo' => null
            );
        }
    }

    // Organizar os resultados por disciplina e, em seguida, por período
    foreach ($data as &$disciplinaData) {
        usort($disciplinaData, function ($a, $b) {
            return intval($a['Mes']) - intval($b['Mes']);
        });
    }
    unset($disciplinaData);

    // Defina o cabeçalho de resposta apenas se houver dados para enviar
    if (!empty($data)) {
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "Nenhum dado encontrado"));
    }
} else {
    echo "Nenhum resultado encontrado";
}
?>
