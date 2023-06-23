<?php
include('protect.php');
require_once 'conexao.php';

// Verifique se um valor foi fornecido para 'relato_id'

if (isset($_GET['relato_id'])) {
  $relato_id = mysqli_real_escape_string($conexao, $_GET['relato_id']);
  
  // Obtenha as informações da história específica usando uma declaração preparada
  $sql = "SELECT * FROM relato WHERE idR = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $relato_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  
  // Verifique se a história foi encontrada
  if ($row) {
    $altura = $row["altura"];
    $peso = $row["peso"];
    $idade = $row["idade"];
    $sexo = $row["sexo"];
    $dataR = $row["dataR"];
    $titulo = $row["titulo"];
    $observacao = $row["observacao"];
    $relato = $row["relatoD"];
    $usuario_id = $row["doctor_id"];
    
    // Obtenha o nome de usuário usando uma instrução preparada
    if (isset($usuario_id)) {
      $sql = "SELECT * FROM usuario WHERE id = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row_usuario = $result->fetch_assoc();
      $nome = $row_usuario["nome"];
      $especialidade = $row_usuario["especialidade"];
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MedicalSystem</title>
  <link rel="icon" href="./img/M4.png" type="image/x-icon">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
  <script src='./js/bootstrap.bundle.js'></script>
</head>

<header>

  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

      <a class="navbar-brand" href="./usuario_Pos_login.php">
        <?php
              echo "<h3>" . $_SESSION["nome"] . "</h3>";
              ?>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

            <li class="nav-item"><a class="nav-link" href="relato.php">
                <span data-feather="book" style="color: white;"></span>&nbsp;&nbsp;Relatar
              </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="meusRelatos.php">
                <span data-feather="book-open" style="color: white;"></span>&nbsp;&nbsp;Meus Relatos
              </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="busca_pl.php">
                <span data-feather="globe" style="color: white;"></span>&nbsp;&nbsp;Navegar
              </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt nav_icon"></i>
                <span data-feather="log-out" style="color: white;"></span>&nbsp;&nbsp;Sair</a>
            </li>
        </div>
      </div>
    </div>
  </nav>

</header>

<body>
  <div class="row coluna" style="margin-left: 10%; margin-top:6%">
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
          <a style="margin-right: auto;" href="meusRelatos.php" class="btn btn-primary botao">Voltar</a>
          <form action="editar.php" method="GET">
            <input type="hidden" name="relato_id" value="<?php echo $row['idR']; ?>">
            <button type="submit" class="btn btn-light botao">Editar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="./js/feather.mim.js"></script>
  <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
  <script type="text/javascript" src="./js/menu.js"></script>
</body>
</html>