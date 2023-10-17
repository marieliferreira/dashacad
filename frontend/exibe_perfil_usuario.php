<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4 div-foto-perfil">
                    <img src="<?php echo $foto_usuario; ?>" alt="Foto do perfil" class="img-fluid rounded-circle">
                </div>
                <div class="col-sm-8">
                    <h6 id="nome-usuario"><?php echo $nome_usuario; ?></h6>
                    <p id="email-usuario"><?php echo $email_usuario; ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="conteudo-perfil">
                <h1>Perfil do Usuário</h1>
                <p><strong>Nome:</strong> <?php echo $nome_usuario; ?></p>
                <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
                <p><strong>Foto:</strong> <img src="<?php echo $foto_usuario; ?>" alt="Foto do Usuário"></p>
                <!-- Adicione mais informações do perfil aqui -->
            </div>
            <div class="botoes-perfil">
                <!-- Botão para editar perfil -->
                <a href="../frontend/editar_perfil_usuario.php" class="btn btn-primary">Editar Perfil</a>
                
                <!-- Botão para fazer logout -->
                <form method="post" action="perfil.php">
                    <button type="submit" name="botao-logout" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</body>
</html>
