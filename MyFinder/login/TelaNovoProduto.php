<?php

include('protect.php');

?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar novo produto</title>
    <link rel='stylesheet' type='text/css' media='screen' href='configuraçoes.css'>
    <link rel = 'stylesheet' type = 'text/css' media='screen' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.bundle.min.js'></script>
    <script src='main.js'></script>

    
   
    <link rel='stylesheet' type='text/css' media='screen' href='telaNovoProduto.css'>
    
</head>
 
<body class="text-center">
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
              <a class="navbar-brand" href="./posLogin.php" style="color: white">Principal</a>
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
      <!--Fim do menu-->
      <br>
      <br>
      <br>
      <div class="add">
    
<form class="form-signin" action="NovoProduto.php" method="post" enctype="multipart/form-data">
    <div class="border border-dark p-2 mb-2 border-2 border" id="borda">
        <h1 class="h3 mb-3 font-weight-normal align-self-center">Adicione um novo produto</h1>
        <label for="inputNome" class="sr-only"></label> 
        <input type="text" name="nome" id="inputNome" class="form-control" placeholder="Nome do produto..." required autofocus>
       
       
        <label for="inputPreco" class="sr-only"></label>
        <input  type="text" name="preco" id="valorContaReceber" class="form-control" placeholder="Digite o preço..." maxlength="10" required >
       
       <script>
  var input = document.getElementById('valorContaReceber');

  input.addEventListener('keypress', function(event) {
    var key = event.key;

    // Verifica se a tecla pressionada é um número, vírgula ou ponto
    if (!/[\d,\.]/.test(key)) {
      event.preventDefault();
  
    }
  });
</script>

        
        
        
        <label for="inputDescricao" class="sr-only"></label>
        <input type="text" name="descricao" id="inputdescricao" class="form-control" placeholder="Descrição..." required>
        <label for="inputPassword" class="sr-only"></label>
        <input type="text" name="link" id="inputLink" class="form-control" placeholder="Link..." required>
        <label for="inputLink" class="sr-only"></label>
        <label for="imagem">Selecione uma imagem:</label> 
  <input type="file"  name="file">
  <br>
  <br>
  <br>



        <div id="botaoNovo">
    <button class="btn btn-Lg btn-dark btn-block" type="submit" onclick="verificar()" ; name="acao" value="enviar">Adicionar</button>
    <button class="btn btn-Lg btn-dark btn-block" type="reset" onclick="limpar()";>Limpar</button>
    </div>
    <p class="mt-5 mb-3 text-muted">Desde 2023</p>
    </form> 
    <p id="mesg"></p>  

 

   
   

    
    </div>
    </div>
    <script src="./inputMask/jquery.inputmask.js"></script>
    <script src="./js/erro.js"></script>
    
</body>
 
</html>