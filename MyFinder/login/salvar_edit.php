<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obter os dados enviados do formulário
  $id_produtos = mysqli_real_escape_string($conexao, $_POST['id_produtos']);
  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
  $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
  $link = mysqli_real_escape_string($conexao, $_POST['link']);
  $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
  $imagem = mysqli_real_escape_string($conexao, $_POST['imagem']);

  // Atualizar os dados do produto no banco de dados usando uma instrução preparada
  $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', link='$link', preco='$preco', imagem='$imagem' WHERE id_produtos='$id_produtos'";
  $result = mysqli_query($conexao, $sql);
  
 $data = date('Y-m-d');
  $sql = "INSERT INTO historicoProdutos (nome, preco, data, id_produtos) VALUES ('$nome', '$preco', '$data', '$id_produtos')";
  $result = mysqli_query($conexao, $sql);


  // Redirecionar para o arquivo "MeusProdutos.php" após salvar as alterações
 header("Location: MeusProdutos.php");
  exit();
}
?>
