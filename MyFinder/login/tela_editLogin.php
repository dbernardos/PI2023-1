<?php

include("conexao.php");
include('protect.php');

if (isset($_POST['id_produtos'])) {
    $id_produtos = $_POST['id_produtos'];

    // Estabelecer a conexão com o banco de dados
    $conexao = mysqli_connect("localhost", "root", "", "myfinder");

    // Verificar se a conexão foi estabelecida com sucesso
    if (mysqli_connect_errno()) {
        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
        exit();
    }

    // Preparar a consulta SQL
    $sql_code = "SELECT * FROM produtos WHERE id_produtos = '$id_produtos'";

    // Executar a consulta SQL
    $resultado = mysqli_query($conexao, $sql_code);

    // Verificar se a consulta foi executada com sucesso
    if ($resultado) {
        // Verificar se foram encontrados registros
        if (mysqli_num_rows($resultado) > 0) {
            // Loop para processar cada registro retornado pela consulta
            while ($row = mysqli_fetch_assoc($resultado)) {
                // Acessar os valores retornados do banco de dados
                $id = $row['id_produtos'];
                $nome = $row['nome'];
                $preco  = $row['preco'];
                $descricao = $row['descricao'];
                $link = $row['link'];
                $imagem = $row['imagem'];

                // Realizar qualquer ação necessária com os valores obtidos
            }
        } else {
            echo "Nenhum registro encontrado.";
        }
    } else {
        echo "Erro na execução da consulta: " . mysqli_error($conexao);
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./telaNovoProduto.css">
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
                    <a class="nav-link active configuracoes" aria-current="page" href="../Configuraçoes/configuracoes.php" style="color: white">Configurações</a>
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
    <div class="container">
    
        <form class="form-signin" method="POST" action="salvar_editLogin.php">
        <div class="border border-dark p-2 mb-2 border-2 border" id="borda">
        <h1 class="h3 mb-3 font-weight-normal align-self-center">Edite um produto</h1>
            <input type="hidden" name="id_produtos" value="<?php echo $id; ?> " hidden>
            <div class="form-group">
          
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" hidden>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text"  class="form-control" id="preco" name="preco" value="<?php echo $preco; ?>" required>
                
                <script>
  var input = document.getElementById('preco');

  input.addEventListener('keypress', function(event) {
    var key = event.key;

    // Verifica se a tecla pressionada é um número, vírgula ou ponto
    if (!/[\d,\.]/.test(key)) {
      event.preventDefault();
    }
  });
</script>

            </div>
            <div class="form-group">
                
                <textarea class="form-control" id="descricao" name="descricao" rows="3" hidden><?php echo $descricao; ?></textarea>
            </div>
            <div class="form-group">
               
                <input type="text" class="form-control" id="link" name="link" value="<?php echo $link; ?>" hidden>
            </div>
            <div class="form-group">
            
                <input type="text" class="form-control" id="imagem" name="imagem" value="<?php echo $imagem; ?>" hidden>
                <br>
  <br>
  <br>
                <div id="botaoNovo">
    <button class="btn btn-Lg btn-dark btn-block" type="submit" name="acao" value="enviar">Salvar</button>
    <button class="btn btn-Lg btn-dark btn-block" type="submit" onclick="window.location.href = '../login/MeusProdutos.php'">Cancelar</button>
    
    </div>
    <p class="mt-5 mb-3 text-muted">Desde 2023</p>
        </form>
    </div>
</div>
</body>

</html>
