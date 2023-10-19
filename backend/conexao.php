<?php
$hostname = "localhost";
$bancodedados = "bd_dashacad_03";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_error) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die(); // Encerra o script em caso de falha na conexão
}
?>
