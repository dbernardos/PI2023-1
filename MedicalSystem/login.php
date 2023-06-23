<?php
session_start(); // Inicie a sessão no início do arquivo

include('conexao.php');

$erro = ''; // Variável para armazenar a mensagem de erro

if(isset($_POST['email']) && isset($_POST['senha'])){ // Verifique se os campos email e senha estão definidos
    if(strlen($_POST['email']) == 0){
        $erro = "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0){
        $erro = "Preencha sua senha";
    } else {
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        // Verificar se o usuário existe
        $sql_code = "SELECT * FROM usuario WHERE email = '$email'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            // Verificar a senha
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: usuario_Pos_login.php");
                exit(); // Saia do script após redirecionar
            } else {
                $erro = "E-mail ou senha inválida!";
            }
        } else {
            $erro = "E-mail ou senha inválida!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>MedicalSystem</title>
    <link rel="icon" href="./img/M4.png" type="image/x-icon">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <style>
        .error-message {
            color: red;
            text-align: left;
            margin-top: 12px;
            margin-left: 5px;
        }
    </style>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">MedicalSystem</a>
        </div>
    </nav>
</header>

<body class=" text-center">

    <div class="backgroundL">
        <form action="" method="POST" class="form-signin">

            <h1 class="h3 mb-3 font-weight-normal" style="font-size: 28px;">Entrar</h1>

            <div class="inputContainer">
                <input type="text" id="inputLogin" class="input" placeholder="a" name="email" required autofocus>
                <label for="inputLogin" class="label">E-mail</label>
            </div>

            <div class="inputContainer">
                <input type="password" id="inputSenhaL" class="input" placeholder="a" name="senha" required>
                <label for="inputSenhaL" class="label">Senha</label>
            </div>

            <?php if(!empty($erro)): ?>
                <p class="error-message"><?php echo $erro; ?></p> <!-- Exibe a mensagem de erro -->
            <?php endif; ?>

            <button class="btn btn-lg btn-primary btn-block" style="margin-top: 30px;" type="submit">Log-in</button>
            <p style="text-center; margin-top: 20px"><a href="./registro.php">Criar uma conta?</a></p>

        </form>
    </div>

</body>

</html>
