<?php
include('protect.php');

$telefone = '';
$emailM = '';

if (isset($_GET['idM'])) {
  $idM = $_GET['idM'];
  // Obtenha as informações da história específica
  $sql = "SELECT * FROM medicalsystem WHERE idM = '$idM'";
  $result = $conexao->query($sql);
  $row = $result->fetch_assoc();
  $telefone = $row["telefone"];
  $emailM = $row["emailM"];
}

if (!isset($_SESSION)) {
    session_start();
}

require_once 'conexao.php';
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

      <a class="navbar-brand" href="#">
        <?php
              echo "<h3>" . $_SESSION["nome"] . "</h3>";
              ?>
      </a>

      <form class="d-flex" role="search" action="busca_resultado_pl.php" metho="GET">
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

<body id="body">

  <main style="margin-top: 35px;">
    <!-- Carrossel de itens -->
    <div id="carrossel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carrossel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carrossel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carrossel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img//img6.png" class="d-block w-100" salt="balbblablab">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#777" />
          </svg>

          <div class="container">
            <div class="carousel-caption text-start">

              <h1>Medical System</h1>
              <p>O melhor site que você ja Visitou!</p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/img6.png" class="d-block w-100" alt="balbblablab">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#777" />
          </svg>

          <div class="container">
            <div class="carousel-caption">
              <h1>Entre e tire todas as suas Dúvidas!</h1>
              <p></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/img6.png" class="d-block w-100" alt="balbblablab">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#777" />
          </svg>

          <div class="container">
            <div class="carousel-caption text-end">
              <h1>1° do Mundo!</h1>
              <p>Você nunca viu um igual a este!</p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carrossel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
          class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carrossel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Próximo</span>
      </button>
    </div>
    </div>

    <footer class="container">
  <hr class="featurette-divider">
  <div class="text-center">
    <p class="text-center">
      &copy; 2022–<?php echo date('Y'); ?> | MedicalSystem | Nefi López - Gabriel Santana |
    </p>
    <p>
      <a href="tel:<?php echo $telefone; ?>">
        <span data-feather="phone" style="color: black;"></span>
      </a>
      <a href="mailto:<?php echo $emailM; ?>">
        <span data-feather="mail" style="color: black;"></span>
      </a>
    </p>
  </div>
</footer>

    <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="./js/feather.mim.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>

</body>

</html>