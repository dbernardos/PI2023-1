<?php
require_once '../conexao.php';
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

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="../login.php">
           <span data-feather="user" style="color: white;"></span>&nbsp;&nbsp; Iniciar sessão</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../registro.php">
            <span data-feather="user-plus" style="color: white;"></span>&nbsp;&nbsp; Criar uma Conta</a>
          </li>
        </ul>

        <form class="d-flex" role="search" action="busca_resultado_V.php" metho="GET">
        <input name="busca2" class="form-control me-2" type="search" placeholder="Faça uma pesquisa" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>

      </div>
    </div>
  </nav>

</header>

<body id="body">
<main>
    <?php
    if (!isset($_GET['busca2'])) {
    ?>

    <?php
    } else {
        $pesquisa = mysqli_real_escape_string($conexao, $_GET['busca2']);

        $sql_code = "SELECT * FROM relato WHERE relatoD LIKE '%$pesquisa%' OR titulo LIKE '%$pesquisa%' OR relatoD LIKE '%$pesquisa%'";

        $sql_query = $conexao->query($sql_code) or die("ERRO ao consultar! " . $conexao->error);

        if ($sql_query->num_rows == 0) {
    ?>
            <h1>Upss... Nenhum resultado encontrado</h1>
    <?php
        } else {
            while ($row = $sql_query->fetch_assoc()) {
    ?>
  <div class="card border-dark text-bg-dark mb-3" style="max-width: 18rem; margin-top: 8.3%; margin-left: 3%; margin-top: 2%; display: inline-block; width: 18rem; height: auto;">
    <div class="card-body" style="height: 8rem;">
      <h5 class="card-title" style="text-align: center;" name="titulo" id="tituloID"><b>
        <?php echo substr($row["titulo"], 0, 50); ?>
      </b></h5>
      <p class="card-text" name="relato" id="relatoID">
      <?php echo substr($row["relatoD"], 0, 95); ?>
      </p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item" name="altura" id="alturaID"><b>Altura:</b>
        <?php echo $row["altura"]; ?> Mt
      </li>
      <li class="list-group-item" name="peso" id="pesoID"><b>Peso:</b>
        <?php echo $row["peso"]; ?> Kg
      </li>
      <li class="list-group-item" name="idade" id="IdadeID"><b>Idade:</b>
        <?php echo $row["idade"]; ?> anos
      </li>
      <li class="list-group-item" name="sexo" id="sexoID"><b>Sexo:</b>
        <?php echo $row["sexo"]; ?>
      </li>
    </ul>
    <div class="card-body" style="text-align: center;">
      <form method="GET" action="./vizualizar_relato_V.php">
        <input type="hidden" name="relato_id" value="<?php echo $row['idR']; ?>">
        <button class="btn btn-primary" type="submit">Visualizar</button>
      </form>
    </div>
  </div>
    <?php
          }
       }
    }
    ?>
</main>

    <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="./js/feather.mim.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>
    
</body>