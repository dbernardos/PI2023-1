<?php
include('protect.php');

require_once 'conexao.php';

// Verificar se foi fornecido um valor para 'relato_id'
if (isset($_POST['relato_id'])) {
  $relato_id = mysqli_real_escape_string($conexao, $_POST['relato_id']);

  $sql = "DELETE FROM relato WHERE idR = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $relato_id);
  
  if ($stmt->execute()) {
    header("Location: meusRelatos.php");
  } else {
    echo "Erro ao excluir postagem: " . $stmt->error;
  }

  $stmt->close();
  $conexao->close();
}
?>
