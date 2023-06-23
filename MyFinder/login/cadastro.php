
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastre-se</title>
    <link rel='stylesheet' type='text/css' media='screen' href='configuraçoes.css'>
    <link rel = 'stylesheet' type = 'text/css' media='screen' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.bundle.min.js'></script>
    <script src='main.js'></script>
    <link rel="stylesheet" href="./loginCss/cadastro.css">
</head>
 
<body class="text-center">
<form class="form-signin" action="cadastrar.php" method="post">
    <div class="border border-dark p-2 mb-2 border-2 border cadastro" id="borda">
        <h1 class="h3 mb-3 font-weight-normal align-self-center">Cadastre-se</h1>
        <label for="inputNome" class="sr-only"></label> 
        <input type="text" name="nome" id="inputNome" class="form-control" placeholder="Nome" required autofocus>
        <label for="inputEmail" class="sr-only"></label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required>
        <label for="inputPassword" class="sr-only"></label>
        <input type="password" id="pass" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
        <input  id="check" type="checkbox"> Visualizar senha</input>
        <script> 
        check.onclick = togglePassword;
        function togglePassword(){
            if(check.checked)pass.type = "text";
            else pass.type = "password"
        }
        
        
        
        </script>
        <div id="botaologin">
    <button class="btn btn-Lg btn-dark btn-block" type="submit">Enviar</button>
    <button class="btn btn-Lg btn-dark btn-block" type="reset">Limpar</button>
    </div>
    <h8>Já tem cadastro? <a href="../login/Login.php">Clique aqui!</a></h8>
    <p class="mt-5 mb-3 text-muted">Desde 2023</p>
    </form>   
    </div>
    
</body>
 
</html>