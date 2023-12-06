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

<div class="cabecalho-branco-home">
<span><button id="btn-hamburguer" onclick="toggleMenu()">&#9776;</button></span>
        <div class="container-fluid">
            <div class="row col-md-12">
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-4 div-foto-perfil">
                    <img src = <?php echo "'" . $foto_usuario . "'";?> alt="Foto do perfil" id="img-fluid-usuario" class="img-fluid rounded-circle" >
                  </div>
                    <div class="col-sm-8">
                      <h6 id="nome-usuario"><?php echo $nome_usuario;?></h6>
                      <p id="email-usuario"><?php echo $email_usuario;?></p>
                    </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <img src="imagens/Logo-DashAcad01.png" alt="Logo do site" id="img-fluid-logo" class="img-fluid">
              </div>
              <div class="col-sm-4 text-right botao-logout">
                    <a href="login.html"><svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" fill="currentColor"      class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></a>
                </svg>
              </div>
            </div>
          </div>


<div id="div-tbl">
<span ><a class="fa fa-arrow-left" id="btn-voltar-notas-parciais" href="home_aluno.php"></a></span>
    <h4 id="h4-form-notas-parciais">Notas Parciais</h1>

    <?php
        include("../backend/conexao.php");

        // Executa a nova consulta SQL para calcular a média das notas por disciplina
        $sql = "SELECT f.DIS_CODIGO, AVG(nf.NFO_NOTA) AS MEDIA_NOTA
        FROM tbl_formulario f
        INNER JOIN tbl_nota_formulario nf ON f.FOR_CODIGO = nf.FOR_CODIGO 
        WHERE nf.USU_CODIGO_CAD = '$codigo_usuario' AND nf.FOR_STATUS = 'respondido'
        GROUP BY f.DIS_CODIGO";

        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr id=exibe-notas-parciais><th id=exibe-notas-parciais-disciplina>Disciplina</th><th class='espaco-entre'>Média</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    // Obtém o nome da disciplina com base no código
                    $disciplinaSql = "SELECT DIS_NOME FROM tbl_disciplina WHERE DIS_CODIGO = " . $row["DIS_CODIGO"];
                    $disciplinaResult = $mysqli->query($disciplinaSql);
                    $disciplinaNome = "Sem Disciplina";

                    if ($disciplinaResult && $disciplinaResult->num_rows > 0) {
                        $disciplinaRow = $disciplinaResult->fetch_assoc();
                        $disciplinaNome = $disciplinaRow["DIS_NOME"];
                    }

                    echo "<tr id=exibe-notas-parciais-nota>";
                    echo "<td id='exibe-disciplina' class='espaco-entre-nota'>" . $disciplinaNome . "</td>";
                    echo "<td id='exibe-nota' class='espaco-entre-nota'>" . round($row["MEDIA_NOTA"], 2) . "</td>"; // Arredonda a média para duas casas decimais
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p class='msg-vazio'>Não foram encontrados registros.</p>";
            }

            $result->free();
        } else {
            echo "Erro ao executar a consulta: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        // ... (seu código existente)

        $mysqli->close();
        ?>
    
</div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous">


</body>
</html>

<script src="form.js"></script>


