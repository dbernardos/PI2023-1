<?php
// Importar arquivo de conexão do banco de dados

session_start();
require_once 'conexao.php';

// Inicializar variáveis ​​de entrada do usuário
$nome = '';
$email = '';
$especialidade = '';
$crm = '';
$senha = '';

// Verifique se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'])) {
        $nome = ucfirst(mysqli_real_escape_string($conexao, $_POST['nome']));
    }

    if (isset($_POST['email'])) {
        $email = strtolower(mysqli_real_escape_string($conexao, $_POST['email']));
    }

    if (isset($_POST['especialidade'])) {
        $especialidade = mysqli_real_escape_string($conexao, $_POST['especialidade']);
    }

    if (isset($_POST['crm'])) {
        $crm = mysqli_real_escape_string($conexao, $_POST['crm']);
    }

    if (isset($_POST['senha'])) {
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Criptografar a senha
    }

    // Verifique se o e-mail já existe no banco de dados
    $sql = "SELECT email FROM usuario WHERE email = '$email'";
    $verificarEmail = mysqli_query($conexao, $sql);
    $countEmail = mysqli_num_rows($verificarEmail);

    // Verifique se o CRM já existe no banco de dados

    $sql = "SELECT CRM FROM usuario WHERE CRM = '$crm'";
    $verificarCRM = mysqli_query($conexao, $sql);
    $countCRM = mysqli_num_rows($verificarCRM);

    if ($countEmail > 0) {
        // Se o e-mail já existir, mostre uma mensagem de erro ao usuário e não insira os dados do usuário
        $erro = "O e-mail já existe. Tente novamente com um e-mail diferente.";
    } elseif ($countCRM > 0) {
        //Se o CRM já existir, mostre uma mensagem de erro ao usuário e não insira os dados do usuário
        $erro = "O CRM já existe. Por favor, tente novamente com um CRM diferente.";
    } else {
        // Preparar consulta para inserir usuário
        $sql = "INSERT INTO usuario (nome, email, especialidade, CRM, senha) VALUES ('$nome', '$email', '$especialidade', '$crm', '$senha_hash')";

        // Executar a consulta SQL
        if (mysqli_query($conexao, $sql)) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir os dados: " . mysqli_error($conexao);
        }

        // Redirecionar o usuário para a página de login
        header("Location: login.php");

        // Salvar dados em variáveis ​​de sessão
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['especialidade'] = $especialidade;
        $_SESSION['CRM'] = $crm;
        $_SESSION['senha'] = $senha_hash;

        // Fechar a conexão com o banco de dados
        mysqli_close($conexao);
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
    <link rel="stylesheet" type="text/css" href="./css/registro2.css">

    <style>
        .error-message {
            color: red;
            text-align: left;
            margin-top: 12px;
            margin-left: 5px;
        }
    </style>

</head>

<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">MedicalSystem</a>
    </nav>

</header>

<body class=" text-center">

        <div class="backgroundR">

        <form class="form-signin" method="POST">

                <div class="inputContainer">

                    <input type="text" id="inputNome" class="input" name="nome" placeholder="a" required autofocus>
                    <label for="inputNome" class="label">Nome de usuario</label>

                </div>
                
                <div class="inputContainer">

                    <input type="email" id="inputEmail" class="input" name="email" placeholder="a" required>
                    <label for="inputEmail" class="label">E-mail</label>

                </div>

                <div class="inputContainer">

                <select class="form-select" id="inputEspecialidade" class="input" name="especialidade"  aria-label="Default select example" placeholder="a" required>
                    <option selected>Especialidade</option>
                    <option value="Alergista">Alergista</option>
                    <option value="Alergista pediátrico">Alergista pediátrico</option>
                    <option value="Anátomopatologista">Anátomopatologista</option>
                    <option value="Anestesiologista">Anestesiologista</option>
                    <option value="Angiologista">Angiologista</option>
                    <option value="Cardiologista">Cardiologista</option>
                    <option value="Cardiologista pediátrico">Cardiologista pediátrico</option>
                    <option value="Cirurgião buco-maxilo-facial">Cirurgião buco-maxilo-facial</option>
                    <option value="Cirurgião cardiovascular">Cirurgião cardiovascular</option>
                    <option value="Cirurgião cranio-maxilo-facial">Cirurgião cranio-maxilo-facial</option>
                    <option value="Cirurgião da mão">Cirurgião da mão</option>
                    <option value="Cirurgião de cabeça e pescoço">Cirurgião de cabeça e pescoço</option>
                    <option value="Cirurgião do aparelho digestivo">Cirurgião do aparelho digestivo</option>
                    <option value="Cirurgião geral">Cirurgião geral</option>
                    <option value="Cirurgião oncológico">Cirurgião oncológico</option>
                    <option value="Cirurgião pediátrico">Cirurgião pediátrico</option>
                    <option value="Cirurgião plástico">Cirurgião plástico</option>
                    <option value="Cirurgião torácico">Cirurgião torácico</option>
                    <option value="Cirurgião vascular">Cirurgião vascular</option>
                    <option value="Coloproctologista">Coloproctologista</option>
                    <option value="Dentista">Dentista</option>
                    <option value="Dermatologista">Dermatologista</option>
                    <option value="Educador Fisico">Educador Fisico</option>
                    <option value="Endocrinologista">Endocrinologista</option>
                    <option value="Endocrinologista pediátrico">Endocrinologista pediátrico</option>
                    <option value="Endoscopista">Endoscopista</option>
                    <option value="Enfermeiro">Enfermeiro</option>
                    <option value="Especialista em Administração em Saúde">Especialista em Administração em Saúde</option>
                    <option value="Especialista em Biomedicina">Especialista em Biomedicina</option>
                    <option value="Especialista em Clínica Médica">Especialista em Clínica Médica</option>
                    <option value="Especialista em Diagnóstico por imagem">Especialista em Diagnóstico por imagem</option>
                    <option value="Especialista em Dor">Especialista em Dor</option>
                    <option value="Especialista em Harmonização orofacial">Especialista em Harmonização orofacial</option>
                    <option value="Especialista em Medicina do adolescente">Especialista em Medicina do adolescente</option>
                    <option value="Especialista em Medicina Estética">Especialista em Medicina Estética</option>
                    <option value="Especialista em Medicina Fisica e Reabilitação">Especialista em Medicina Fisica e Reabilitação</option>
                    <option value="Especialista em Medicina Nuclear">Especialista em Medicina Nuclear</option>
                    <option value="Especialista em Medicina Preventiva">Especialista em Medicina Preventiva</option>
                    <option value="Especialista em Neonatologia">Especialista em Neonatologia</option>
                    <option value="Especialista em Reprodução Humana">Especialista em Reprodução Humana</option>
                    <option value="Especialista em Ultrassonografia">Especialista em Ultrassonografia</option>
                    <option value="Fisioterapeuta">Fisioterapeuta</option>
                    <option value="Fonoaudiólogo">Fonoaudiólogo</option>
                    <option value="Gastroenterologista">Gastroenterologista</option>
                    <option value="Gastroenterologista pediátrico">Gastroenterologista pediátrico</option>
                    <option value="Generalista">Generalista</option>
                    <option value="Geneticista">Geneticista</option>
                    <option value="Geriatra">Geriatra</option>
                    <option value="Ginecologista">Ginecologista</option>
                    <option value="Hematologista">Hematologista</option>
                    <option value="Hematologista pediátrico">Hematologista pediátrico</option>
                    <option value="Hepatologista">Hepatologista</option>
                    <option value="Homeopata">Homeopata</option>
                    <option value="Infectologista">Infectologista</option>
                    <option value="Infectologista pediátrico">Infectologista pediátrico</option>
                    <option value="Intensivista">Intensivista</option>
                    <option value="Mastologista">Mastologista</option>
                    <option value="Médico Acupunturista">Médico Acupunturista</option>
                    <option value="Médico citopatologista">Médico citopatologista</option>
                    <option value="Médico clinico geral">Médico clinico geral</option>
                    <option value="Médico de emergência">Médico de emergência</option>
                    <option value="Médico de família">Médico de família</option>
                    <option value="Médico de tráfego">Médico de tráfego</option>
                    <option value="Médico do esporte">Médico do esporte</option>
                    <option value="Médico do Sono">Médico do Sono</option>
                    <option value="Médico do trabalho">Médico do trabalho</option>
                    <option value="Médico hiperbarista">Médico hiperbarista</option>
                    <option value="Médico perito">Médico perito</option>
                    <option value="Nefrologista">Nefrologista</option>
                    <option value="Nefrologista pediátrico">Nefrologista pediátrico</option>
                    <option value="Neurocirurgião">Neurocirurgião</option>
                    <option value="Neurofisiologista">Neurofisiologista</option>
                    <option value="Neurologista">Neurologista</option>
                    <option value="Neurologista pediátrico">Neurologista pediátrico</option>
                    <option value="Nutricionista">Nutricionista</option>
                    <option value="Nutrólogo">Nutrólogo</option>
                    <option value="Odontopediatra">Odontopediatra</option>
                    <option value="Oftalmologista">Oftalmologista</option>
                    <option value="Oncologista">Oncologista</option>
                    <option value="Ortodontista">Ortodontista</option>
                    <option value="Ortopedista - Traumatologista">Ortopedista - Traumatologista</option>
                    <option value="Osteopata">Osteopata</option>
                    <option value="Otorrino">Otorrino</option>
                    <option value="Patologista clínico">Patologista clínico</option>
                    <option value="Pediatra">Pediatra</option>
                    <option value="Pneumologista">Pneumologista</option>
                    <option value="Pneumologista pediátrico">Pneumologista pediátrico</option>
                    <option value="Podologista">Podologista</option>
                    <option value="Psicanalista">Psicanalista</option>
                    <option value="Psicólogo">Psicólogo</option>
                    <option value="Psicopedagogo">Psicopedagogo</option>
                    <option value="Psiquiatra">Psiquiatra</option>
                    <option value="Quiropraxista">Quiropraxista</option>
                    <option value="Radiologista">Radiologista</option>
                    <option value="Radioterapeuta">Radioterapeuta</option>
                    <option value="Reumatologista">Reumatologista</option>
                    <option value="Reumatologista pediátrico">Reumatologista pediátrico</option>
                    <option value="Sexólogo">Sexólogo</option>
                    <option value="Técnico em Métodos Gráficos em Cardiologia">Técnico em Métodos Gráficos em Cardiologia</option>
                    <option value="Técnico em radiologia">Técnico em radiologia</option>
                    <option value="Técnico em Saúde bucal">Técnico em Saúde bucal</option>
                    <option value="Terapeuta complementar">Terapeuta complementar</option>
                    <option value="Terapeuta ocupacional">Terapeuta ocupacional</option>
                    <option value="Urologista">Urologista</option>
                    </select>
                </div>
                <div class="inputContainer">

                    <input type="text" id="inputCRM" class="input" name="crm" placeholder="a" required>
                    <label for="inputCRM" class="label">Numero de registro (CRM)</label>

                </div>

                <div class="inputContainer">

                    <input type="password" id="inputSenhaR" class="input" name="senha" placeholder="a" required>
                    <label for="inputSenhaR" class="label">Senha</label>

                </div>

                <?php if(!empty($erro)): ?>
                <p class="error-message"><?php echo $erro; ?></p> <!-- Exibe a mensagem de erro -->
                <?php endif; ?>

                <br><button class=" btn btn-lg btn-primary btn-block" type="submit"
                    style="margin-top: 60px; width: 250px; height: 48px;">Continuar</button>

            </form>

        <div class="form-check" style="margin-top: -90px; margin-left: 18px;">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="aceito" required>
            <label class="form-check-label" style="margin-left: -40px;" for="flexCheckDefault">
                Aceito os termos e condições
            </label>
        </div>

</div>

<script>
    var checkbox = document.getElementById('flexCheckDefault');
    var form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        if (!checkbox.checked) {
            event.preventDefault(); // Impedir que o formulário seja enviado
            alert('Você deve aceitar os Termos e Condições.');
        }
    });
</script>


<script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="./js/feather.mim.js"></script>
<script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="./js/menu.js"></script>

</body>

</html>