<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="editar-usuario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <title>DashAcad - Perfil</title>
</head>
<body>

<?php
    session_start();
    
    if(!isset($_SESSION['nome'])){
        echo "<script>window.location.href = 'login.html'; </script>";
    } else {
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


<div class="container">
    <div class="row">
        <div class="col-sm-5 mx-auto"> <!-- Adicione a classe mx-auto aqui -->
            <div class="conteudo-perfil text-center">
            <span ><a  class="fa fa-arrow-left" id="btn-voltar-home" href="home_aluno.php"></a></span>
                <div id="borda-perfil" class="text-center">
                    <h3 id="h3-titulo-perfil">Perfil do Usuário</h3>
                    <p><strong></strong> <img id="editar-foto" src="<?php echo $foto_usuario; ?>" alt="Foto do Usuário"></p>
                    <p id="editar-nome"><strong>Nome:</strong> <?php echo $nome_usuario; ?></p>
                    <p id="editar-email"><strong>Email:</strong> <?php echo $email_usuario; ?></p>
                    <a href="../frontend/editar_perfil_usuario.php" class="btn-editar">Editar Perfil</a>
                </div>
                <!-- Adicione mais informações do perfil aqui -->
            </div>
                <!-- Botão para fazer logout -->
                
                    <a href="../frontend/login.html" type="button" name="botao-logout" class="btn-logout">Logout</a>
                
            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</body>
</html>
