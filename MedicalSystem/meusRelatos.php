<div id="texto" style="margin-top: 4%;">
  <?php
  include 'protect.php';
  require_once 'conexao.php';

  $sql = "SELECT * FROM relato WHERE doctor_id = '".$_SESSION['id']."'";
  $all_relato = $conexao->query($sql);

  if ($all_relato->num_rows == 0) {
    echo "<h1>Se anima a realizar uma publicação!<br>Dessa forma, você podera ver as suas histórias nesta secção da página!.</h1>";
  } else  {
    $doctor_id = $_SESSION['id'];

    $sql = "SELECT * FROM relato WHERE doctor_id = '$doctor_id'";
    $all_relato = $conexao->query($sql);

    if (!$all_relato) {
      exit("Erro ao executar a consulta: " . $conexao->error);
    }
  }
  ?>
</div>


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
  <link rel="stylesheet" type="text/css" href="./css/busca.css">
  <script src='./js/bootstrap.bundle.js'></script>
</head>

<body id="body">
  <header>
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="./usuario_Pos_login.php">MedicalSystem</a>

        <form class="d-flex" role="search" action="busca_resultado_pl.php" method="GET">
          <input name="busca" class="form-control me-2" type="search" placeholder="Faça uma pesquisa" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>

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
              <li class="nav-item">
                <a class="nav-link" href="relato.php">
                  <span data-feather="book" style="color: white;"></span>&nbsp;&nbsp;Relatar
                </a>
              </li>

              <li class="nav-item"><a class="nav-link" href="meusRelatos.php">
                <span data-feather="book-open" style="color: white;"></span>&nbsp;&nbsp;Meus Relatos
              </a>
            </li>

              <li class="nav-item">
                <a class="nav-link" href="busca_pl.php">
                  <span data-feather="globe" style="color: white;"></span>&nbsp;&nbsp;Navegar
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="fas fa-sign-out-alt nav_icon"></i>
                  <span data-feather="log-out" style="color: white;"></span>&nbsp;&nbsp;Sair
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>

<main>
  <?php
  $count = 0;
  while ($row = $all_relato->fetch_assoc()) {
  ?>
    <div class="card border-dark text-bg-dark mb-3" style="max-width: 18rem; margin-top: 2%; margin-left: 3%; display: inline-block; width: 18rem; height: auto;">
      <div class="card-body" style="height: 8rem;">
        <h5 class="card-title" style="text-align: center;" name="titulo" id="tituloID"><b><?php echo substr($row["titulo"], 0, 50); ?></b></h5>
        <p class="card-text" name="relato" id="relatoID"><?php echo substr($row["relatoD"], 0, 95) ?></p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item" name="altura" id="alturaID"><b>Altura:</b><?php echo $row["altura"]; ?>Mt</li>
        <li class="list-group-item" name="peso" id="pesoID"><b>Peso:</b><?php echo $row["peso"]; ?>Kg</li>
        <li class="list-group-item" name="idade" id="IdadeID"><b>Idade:</b><?php echo $row["idade"]; ?>anos</li>
        <li class="list-group-item" name="sexo" id="sexoID"><b>Sexo:</b><?php echo $row["sexo"]; ?></li>
      </ul>
      <div class="card-body" style="text-align: center">
        <form method="GET" action="./visualizar_meu_relato_pl.php">
          <input type="hidden" name="relato_id" value="<?php echo $row['idR']; ?>">
          <button class="btn btn-primary" type="submit">Visualizar</button>
        </form>
      </div>
    </div>
  <?php
  }
  ?>
</main>

  <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="./js/feather.mim.js"></script>
  <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
  <script type="text/javascript" src="./js/menu.js"></script>

</body>

</html>