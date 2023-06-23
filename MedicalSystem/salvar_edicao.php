<?php
include('protect.php');
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtenha os dados enviados do formulário

  $altura = mysqli_real_escape_string($conexao, $_POST['altura']);
  $peso = mysqli_real_escape_string($conexao, $_POST['peso']);
  $idade = mysqli_real_escape_string($conexao, $_POST['idade']);
  $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
  $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
  $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
  $relato = mysqli_real_escape_string($conexao, $_POST['relato']);
  $relato_id = mysqli_real_escape_string($conexao, $_POST['relato_id']);
  
  // Atualize os dados da história no banco de dados usando uma instrução preparada
  $sql = "UPDATE relato SET altura=?, peso=?, idade=?, sexo=?, titulo=?, observacao=?, relatoD=? WHERE idR=?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("ssissssi", $altura, $peso, $idade, $sexo, $titulo, $observacao, $relato, $relato_id);
  $stmt->execute();
  
  // Redirecione para o arquivo "visualizar_meu_relato.php" após salvar as alterações
  header("Location: meusRelatos.php");
  exit();
}
?>
