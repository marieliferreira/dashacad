<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <title>Editar Perfil</title>
</head>
<body>

<?php
    session_start();
    
    if(!isset($_SESSION['nome'])){
        echo "<script>window.location.href = 'login.html'; </script>";
    } else {
        // Recupere as informações do usuário da sessão ou do banco de dados
        $codigo_usuario = $_SESSION['codigo-usuario'];
        $nome_usuario = $_SESSION['nome'];
        $email_usuario = $_SESSION['email'];
        $foto_usuario = $_SESSION['foto'];
        $senha_usuario = $_SESSION['senha'];
    }

    if(isset($_POST['botao-salvar'])){
        // Obtenha os dados do formulário
        $novo_nome = $_POST['novo-nome'];
        $novo_email = $_POST['novo-email'];
        $novo_email = $_POST['nova-senha'];
        // Atualize os dados no banco de dados (você precisará implementar essa lógica)
        
        // Atualize as informações na sessão
        $_SESSION['nome'] = $novo_nome;
        $_SESSION['email'] = $novo_email;
        $_SESSION['senha'] = $nova_senha;
        // Redirecione o usuário de volta para a página de perfil
        header("Location: perfil.php");
    }
?>

<div class="container">
    <h1>Editar Perfil</h1>
    <form method="post" action="../backend/editar_perfil_usuario.php">
        <div class="mb-3">
            <label for="novo-nome" class="form-label">Novo Nome:</label>
            <input type="text" class="form-control" id="novo-nome" name="novo-nome" value="<?php echo $nome_usuario; ?>">
        </div>
        <div class="mb-3">
            <label for="novo-email" class="form-label">Novo Email:</label>
            <input type="email" class="form-control" id="novo-email" name="novo-email" value="<?php echo $email_usuario; ?>">
        </div>
        <div class="mb-3">
            <label for="novo-email" class="form-label">Nova Senha:</label>
            <input type="password" class="form-control" id="nova-senha" name="nova-senha" value="<?php echo $email_usuario; ?>">
        </div>
        <!-- Adicione mais campos conforme necessário -->
        <button type="submit" class="btn btn-primary" name="botao-salvar">Salvar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</body>
</html>
