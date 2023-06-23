


<?php
include('../login/protect.php');
require_once('../login/conexao.php');
// Recuperar os dados do cliente para exibir no formulário de edição
$id_cliente = isset($_SESSION["user"]) ? $_SESSION["user"] : 0;

if ($id_cliente > 0) {
    $sql = "SELECT * FROM cliente WHERE id_cliente = $id_cliente";
    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
        $nome = $cliente["nome"];
        $email = $cliente["email"];
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não fornecido.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $senha = md5($senha);

    // Atualizar o registro do cliente no banco de dados
    $sql = "UPDATE cliente SET nome = '$nome', email = '$email', senha = '$senha' WHERE id_cliente = $id_cliente";

    if ($conexao->query($sql) === true) {
      ?>
      <div class="alert alert-success">
        <p>Usuário editado com sucesso</p>
        <br>
        <a href="../login/posLogin.php">Voltar a tela principal</a>
      </div>
      <?php

     

// Redirecionar o usuário para outra página

    } else {
      ?>
      <div class="alert alert-danger">
        <p>Falha ao editar usuário!</p>
        <br>
        <a href="../login/posLogin">Voltar aos Meus produtos</a>
      </div>
      <?php
    }
}

// Recuperar os dados do cliente para exibir no formulário de edição


$sql = "SELECT * FROM cliente WHERE id_cliente = $id_cliente";
$resultado = $conexao->query($sql);
if ($resultado->num_rows > 0) {
    $cliente = $resultado->fetch_assoc();
    $nome = $cliente["nome"];
    $email = $cliente["email"];
    $senha = $cliente["senha"];
} else {
    echo "Cliente não encontrado.";
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>MyFinder</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='MeusProdutos.css'>
    <link rel = 'stylesheet' type = 'text/css' media='screen' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.bundle.min.js'></script>
    <script src='main.js'></script>
</head>
<body>
   
  
  <!--MENU de notificação-->
     
    <nav class="navbar bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="color: white">
            MyFinder
          </a>
          
        </div>
      </nav>
      <!--fim do nome do site-->

      <!--MENU de notificação-->
          <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../login/posLogin.php" style="color: white">Principal</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active meu-produto" aria-current="page" href="../login/MeusProdutos.php" style="color: white">Meus Produtos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active configuracoes" aria-current="page" href="../Configuracoes/configuracoes.php" style="color: white">Configurações</a>
                  </li>
                 
                </ul>

               


              </div>
            </div>
          </nav>
          <div class="text-center">
          <form class="form-signin" method="post">
    <div class="border border-dark p-2 mb-2 border-2 border cadastro" id="borda">
        <h1 class="h3 mb-3 font-weight-normal align-self-center">Editar Usuário</h1>
        <label for="inputNome" class="sr-only"></label> 
        <input type="text" name="nome" id="inputNome" class="form-control" placeholder="Nome"  value="<?php echo $nome; ?>" required autofocus>
        <label for="inputEmail" class="sr-only"></label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email"  value="<?php echo $email; ?>"required>
        <label for="inputPassword" class="sr-only"></label>
        <input type="password" id="pass" name="senha" id="inputPassword" class="form-control" placeholder="Senha"  required>
        <input  id="check" type="checkbox"> Visualizar senha</input>
       

        <script> 
        check.onclick = togglePassword;
        function togglePassword(){
            if(check.checked)pass.type = "text";
            else pass.type = "password"
        }
        
        
        
        </script>
        <div id="botaologin">
        <br>
    <button class="btn btn-Lg btn-dark btn-block" type="submit">Enviar</button>
    <button class="btn btn-Lg btn-dark btn-block" type="reset">Limpar</button>
    </div>
  
    <p class="mt-5 mb-3 text-muted">Desde 2023</p>
    </form>   
    </div>

    <style>
    .text-center{
      max-width: 50%;
      margin-top: 50px;
      margin-left: 25%;
    }
    
    
    
    </style>
  

   
</body>
      <!--Fim do menu-->
       
      
</body>
</html>