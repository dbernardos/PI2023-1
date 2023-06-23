<?php
require_once '../conexao.php';

if (isset($_GET['relato_id'])) {
  $relato_id = $_GET['relato_id'];
  // Obter as informações da história específica
  $sql = "SELECT * FROM relato WHERE idR = '$relato_id'";
  $result = $conexao->query($sql);
  $row = $result->fetch_assoc();
  $altura = $row["altura"];
  $peso = $row["peso"];
  $idade = $row["idade"];
  $sexo = $row["sexo"];
  $dataR = $row["dataR"];
  $titulo = $row["titulo"];
  $observacao = $row["observacao"];
  $relato = $row["relatoD"];
  $usuario_id = $row["doctor_id"];
}

if (isset($usuario_id)) {
  $sql = "SELECT * FROM usuario WHERE id = '". $usuario_id."'";
  $result = $conexao->query($sql);
  $row = $result->fetch_assoc();
  $nome = $row["nome"];
  $especialidade = $row["especialidade"];
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MedicalSystem</title>
  <link rel="icon" href="../img/M4.png" type="image/x-icon">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <script src='../js/bootstrap.bundle.js'></script>
</head>

<header>
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">MedicalSystem</a>
    <link rel="icon" href="./img/M4.png" type="image/x-icon">

      <form class="d-flex" role="search" action="busca_resultado_V.php" metho="GET">
        <input name="busca2" class="form-control me-2" type="search" placeholder="Faça uma pesquisa" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
      </form>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
        </div>
      </div>
    </div>

</header>

<body>

<div class="row coluna" style="margin-left: 10%; margin-top: 2%">
    <div class="card mx-auto bg-dark">
      <div class="card-body text-white" style="text-align: center;">
        <h1><?php echo $titulo; ?></h1>
        <p class="card-text" name="relato" id="relatoID"></p>
      </div>
      <div class="card-body d-flex justify-content-between text-white">
        <p><b>Altura: <?php echo $altura; ?> Mt </b></p>
        <p><b>Peso: <?php echo $peso; ?> Kg </b></p>
      </div>
      <div class="card-body d-flex justify-content-between text-white">
        <p><b>Idade: <?php echo $idade; ?> años </b></p>
        <p><b>Sexo: <?php echo $sexo; ?> </b></p>
      </div>
    </div>
  </div><br>

  <div class="" style="margin-left: 10%; margin-right: 10%;">
    <div class="card mx-auto bg-dark text-white" >
      <h3 style="text-align: center;">Observações</h3>
      <div class="card-body text-white text-justify">
      <p class="card-text"><b><?php echo $observacao; ?></b></p>
  </div>
    </div>
      </div><br><br>

  <div class="" style="margin-left: 10%; margin-right: 10%;">
    <div class="card mx-auto bg-dark">
      <div class="card-body text-white text-justify">
        <p class="card-text"><b><?php echo $relato; ?></b></p><br><br>
        <p class="card-text" style="margin-left: 90%;"><b>Escrito por: <?php echo $nome; ?></b></p><br>
        <p class="card-text" style="margin-left: 90%;"><b>Especialidade: <?php echo $especialidade; ?></b></p><br>

        <div style="display: flex; justify-content: space-between;">
          <a style="margin-right: auto;" href="busca_V.php" class="btn btn-primary botao">Voltar</a>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../js/feather.mim.js"></script>
    <script type="text/javascript" src="../js/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>

</body>

</html>