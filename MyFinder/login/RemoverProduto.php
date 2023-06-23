<?php
require_once('conexao.php');


// Verificar se foi fornecido um valor para 'id_produtos'
if (isset($_POST['id_produtos'])) {
  $id_produtos = mysqli_real_escape_string($conexao, $_POST['id_produtos']);

  // Verificar se há registros relacionados na tabela 'historicoprodutos'
  $sql_check = "SELECT * FROM historicoprodutos WHERE id_produtos = ?";
  $stmt_check = mysqli_prepare($conexao, $sql_check);
  mysqli_stmt_bind_param($stmt_check, "i", $id_produtos);
  mysqli_stmt_execute($stmt_check);
  mysqli_stmt_store_result($stmt_check);
  $num_rows = mysqli_stmt_num_rows($stmt_check);

  if ($num_rows > 0) {
    // Existem registros relacionados na tabela 'historicoprodutos'
    $sql_delete = "DELETE FROM historicoprodutos WHERE id_produtos = ?";
    $stmt_delete = mysqli_prepare($conexao, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $id_produtos);
    mysqli_stmt_execute($stmt_delete);

    if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
      // Produto excluído com sucesso
      ?>
      <div class="alert alert-success">
        <p>Histórico excluído com sucesso!</p>
        <br>
        <a href="./MeusProdutos.php">Voltar aos Meus produtos</a>
      </div>
      <?php
    } else {
      // Falha ao excluir o produto
      ?>
      <div class="alert alert-danger">
        <p>Falha ao excluir o histórico!</p>
        <br>
        <a href="./MeusProdutos.php">Voltar aos Meus produtos</a>
      </div>
      <?php
    }
  }

  mysqli_stmt_close($stmt_check);
  } 

    // Não existem registros relacionados na tabela 'historicoprodutos', pode excluir o produto

    $sql_delete = "DELETE FROM produtos WHERE id_produtos = ?";
    $stmt_delete = mysqli_prepare($conexao, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $id_produtos);
    mysqli_stmt_execute($stmt_delete);

    if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
      // Produto excluído com sucesso
      ?>
      <div class="alert alert-success">
        <p>Produto excluído com sucesso!</p>
        <br>
        <a href="./MeusProdutos.php">Voltar aos Meus produtos</a>
      </div>
      <?php
    } else {
      // Falha ao excluir o produto
      ?>
      <div class="alert alert-danger">
        <p>Falha ao excluir o produto!</p>
        <br>
        <a href="./MeusProdutos.php">Voltar aos Meus produtos</a>
      </div>
      <?php
    }
  

 
  mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>
