<?php
    include('protect.php');
    include("conexao.php");
    //pego as variaveis
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if($login == "" || $senha == "") {
        $erro_geral = "Todos os campos precisam ser preenchidos!";
    }else if (preg_match('/^[a-zA-Z0-9]+$/', $login) && preg_match('/^[a-zA-Z0-9]+$/', $senha)) {
            $senha = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);

            $sql = "insert into admin_login(login, senha) values('$login', '$senha')";
        
            $result = mysqli_query($mysqli, $sql);
        
            if(mysqli_insert_id($mysqli)) {
                $mensagem_login_cadastrado = "Login administrativo cadastrado com sucesso!";
            }
    } else {
        $mensagem_caracteres_invalidos_letras_numeros = "Os campos login e senha só podem conter letras e números!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Login Administrativo</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <a href="../index.php"><button class="titulo">SóNosCompiuter</button></a>
    </header>
    <h1>Cadastro de Login de Adiministrador</h1>
    <form action="" method="POST">
        <div class="games">
            <div>
                <p class="pgames">Login:</p>
                <input class="label orçamento" type="text" id="login" name="login">
            </div>

            <p class="pgames">Senha:</p>
            <input class="label orçamento" type="text" id="senha" name="senha">

            <div class="cadastrar-container">
                <button class="cadastrar" type="submit">Cadastrar</button>
                <button class="cadastrar" type="button"><a class="style-href" href="painel_login.php">Voltar</a></button>
            </div>
            <?php
                if(isset($erro_geral)){
                    echo "<div class='info'>".$erro_geral."</div>";
                }
                
                if(isset($mensagem_caracteres_invalidos_letras_numeros)){
                    echo "<div class='info'>".$mensagem_caracteres_invalidos_letras_numeros."</div>";
                }

                if(isset($mensagem_login_cadastrado)){
                    echo "<div class='success'>".$mensagem_login_cadastrado."</div>";
                }
            ?>
        </div>
    </form>
</body>

</html>