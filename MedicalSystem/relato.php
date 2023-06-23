<?php
// Importar arquivo de conexão de banco de dados

require_once 'conexao.php';

include('protect.php');

// Inicializar variáveis ​​de entrada do usuário

$altura = '';
$peso = '';
$idade = '';
$sexo = '';
$dataR = '';
$observacao = '';
$relatoD = '';
$titulo = '';

// Verifique se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['altura'])) {
        $altura = mysqli_real_escape_string($conexao, $_POST['altura']);
    }

    if (isset($_POST['peso'])) {
        $peso = mysqli_real_escape_string($conexao, $_POST['peso']);
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

    if (isset($_POST['observacao'])) {
        $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
    }

    if (isset($_POST['relatoD'])) {
        $relatoD = mysqli_real_escape_string($conexao, $_POST['relatoD']);
    }

    if (isset($_POST['titulo'])) {
        $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    }

    // Obter ID do médico atual da variável de sessão
    $doctor_id = $_SESSION['id'];

    // Preparar Consulta de Inserção na História
    $sql = "INSERT INTO relato (altura, peso, idade, sexo, dataR, titulo, observacao, relatoD, doctor_id) 
            VALUES ('$altura', '$peso', '$idade', '$sexo', STR_TO_DATE('$dataR', '%Y-%m-%d'), '$titulo', '$observacao', '$relatoD', '$doctor_id')";

    //Executar a consulta SQL
    if (mysqli_query($conexao, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . mysqli_error($conexao);
    }

    // Redirecionar o usuário para a página de login
    header("Location: usuario_Pos_login.php");
    exit;
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
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
    <link rel="stylesheet" type="text/css" href="./css/relato.css">
</head>

<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./usuario_Pos_login.php">MedicalSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

</header>

<body id="corpo">

    <form method="POST">

        <div class="mb-3 texto backgroundR">
            <h1 class="paciente">Dados do paciente</h1>

            <label for="altura">Altura (M):</label>
            <input type="text" class="form-control" id="altura" name="altura" placeholder="Exemplo: 1.84" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" required>

            <label for="peso">Peso (Kg):</label>
            <input type="text" class="form-control" id="peso" name="peso" placeholder="Exemplo: 65.4" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" required>

            <label for="idade">Idade:</label>
            <input type="text" class="form-control" id="idade" name="idade" placeholder="Exemplo: 20" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required><br>

            <label for="sexo">Sexo: </label>
            <select class="form-control" id="sexo" name="sexo" style="width: 100%" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>

            <label for="data">Data:</label>
            <input type="date" class="form-control" id="dataR" name="dataR" placeholder="dd/mm/aa" required
            min="1800-01-01" max="<?php echo date('Y-m-d'); ?>" pattern="\d{1,2}/\d{1,2}/\d{2}">

            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo do relato" required>
        </div>

        <div class="mb-3 texto observaçao">
        <label for="observacao" class="form-label">Observação</label>
          <textarea class="form-control" id="observacao" name="observacao" rows="6" style="resize: vertical; max-height: 6em; overflow-y: auto;" required></textarea>
        </div>

        <div class="mb-3 texto relato">
            <label for="relatoD" class="form-label" style="margin-left: 47%;text-align:"><H4>Faça seu relato</H4></label>
            <textarea class="form-control" id="relatoD" name="relatoD" rows="8" style="resize: vertical; max-height: 14em; overflow-y: auto;" required></textarea>
        
            <div style="text-align: center; margin-top: -30px;">
                <input id="btn" type="submit" value="Publicar" style="margin-left: 50px; background-color: black;">
            </div>

        </div>
    </form>

    <script src='./js/bootstrap.bundle.js'></script>
    <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="./js/feather.mim.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>
</body>

</html>