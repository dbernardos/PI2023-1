<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Melhor Aplicativo de Estudo</title>
</head>

<body>
    <?php
        session_start();
        if(isset($_SESSION["id"])){
            print "<script>location.href='../telas/home.php';</script>";
        }
    ?>

    <img src="../img/logo.jpeg" class="logo">
  
    <form action="../back-end/cadastrar.php" method="post">

        <input type="text" name="usuario" class="login-usuario" placeholder="Usuario">

        <input type="email" name="email" class="login-email" placeholder="Email">

        <input type="password" name="senha" class="login-password" placeholder="Senha">

        <button name="cadastrar" class="login-btn">Cadastrar</button>      
    </form>

    <h3><a class="link" href="./index.php">Já possui uma conta?</a></h3>

</body>
</html>