<?php
// Importar archivo de conexión a la base de datos
session_start();
require_once 'conexao.php';

include('protect.php');

// Inicializar variables de entrada de usuario
$altura = '';
$idade = '';
$sexo = '';
$dataR = '';
$relato = '';

// Verificar si se han enviado datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['altura'])) {
        $altura = mysqli_real_escape_string($conexao, $_POST['altura']);
      }

    if (isset($_POST['idade'])) {
        $idade = mysqli_real_escape_string($conexao, $_POST['idade']);
      }
      
      if (isset($_POST['sexo'])) {
        $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
      }
      
      if (isset($_POST['dataR'])) {
        $dataR = mysqli_real_escape_string($conexao, $_POST['dataR']);
      }
      
      if (isset($_POST['relato'])) {
        $relato = mysqli_real_escape_string($conexao, $_POST['relato']);
      }

   // Preparar consulta de inserción de en el relato
   $sql = "INSERT INTO relato (altura, idade, sexo, dataR, relato) VALUES ('$altura', '$idade', '$sexo', '$dataR', '$relato')";

   
   // Executa a query SQL
    if (mysqli_query($conexao, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . mysqli_error($conexao);
    }

    // Redireccionar al usuario a la página de inicio de sesión
    header("Location: usuario_Pos_login.php");

// Guardar datos en variables de sesión
$_SESSION['altura'] = $altura;
$_SESSION['idade'] = $idade;
$_SESSION['sexo'] = $sexo;
$_SESSION['dataR'] = $dataR;
$_SESSION['relato'] = $relato;
 

// Cerrar la conexión a la base de datos
mysqli_close($conexao);
    }
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MedicalSystem</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/relato.css">
</head>
<header>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./usuario_Pos_login.php">MedicalSystem</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

</header>

<body id="corpo">
  
  <form method="POST">
    
    <div class="mb-3 texto">
      <h1 class="paciente">Dados do paciente</h1>
      <label class="altura" for="altura">Altura:</label>
      <input type="text" class="form-control" id="altura" name="altura" placeholder="Digite sua altura" required>
      
      <label for="idade" class="idade">Idade:</label>
      <input type="number" class="form-control" id="idade" name="idade" placeholder="Digite sua idade" required>
      
      <label for="sexo" class="idade">Sexo:</label>
      <input type="text" class="form-control" id="sexo" name="sexo" placeholder="F (para femenino) ou M (para masculino)" required>
      
      <label for="data" class="data">Data:</label>
      <input type="date" class="form-control" id="dataR" name="dataR" placeholder="Digite a data" required>
      
    </div>
    
    <div class="mb-3 texto">
      <label for="relato" class="form-label" style="margin-left: 50%;">Editar relato</label>
      <textarea class="form-control" id="relato" name="relato" rows="3" required></textarea>
    </div>
    
    <div style="text-align: center;">

    <input id="btn" type="submit" value="Editar" style="margin-left: 50px;">

    </div>
    
  </form>
  
  <script src='./js/bootstrap.bundle.js'></script>
  <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="./js/feather.mim.js"></script>
  <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
  <script type="text/javascript" src="./js/menu.js"></script>
</body>

</html>