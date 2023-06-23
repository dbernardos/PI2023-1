<?php
    include('protect.php');
    include('conexao.php');

    //se o id vier vazio redireciona para o painel
    if(!isset($_GET['id'])) {
        header("Location: painel.php");
        exit;
    }
    //verifica se o id veio e atribui ele a uma variavel
    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    }

    $sql = "SELECT * from requisito_software where id = $id";
    $result = $mysqli->query($sql);
    $row = $result->FETCH_ASSOC();

    $nome_software = $row['nome'];
    $pontuacao_cpu_software = $row['pontuacao_cpu'];
    $pontuacao_gpu_software = $row['pontuacao_gpu'];

    $nome = filter_input(INPUT_POST, 'nome_software', FILTER_SANITIZE_STRING);
    
    $pontuacao_gpu = filter_input(INPUT_POST, 'pontuacao_gpu', FILTER_SANITIZE_STRING);

    $pontuacao_cpu = filter_input(INPUT_POST, 'pontuacao_cpu', FILTER_SANITIZE_STRING);

    $query = "select nome_cpu from cpu where nome_cpu = '{$nome}'";

    $resultado = mysqli_query($mysqli, $query);

    $row = mysqli_num_rows($resultado);

    if($nome == "" || $pontuacao_cpu == "" || $pontuacao_gpu == "") {
        $erro_geral = "Todos os campos precisa ser preenchidos!";
    }else if ($pontuacao_cpu < 0){
        $mensagem_pontuacao_cpu_invalido = "Insira uma pontuação de CPU válida!";
    }else if ($pontuacao_gpu < 0){
        $mensagem_pontuacao_gpu_invalido = "Insira uma pontuaçâo de GPU válida!";
    }else{
        $sql = "UPDATE requisito_software set nome = '$nome', pontuacao_cpu = '$pontuacao_cpu', pontuacao_gpu = '$pontuacao_gpu' where id = '$id'";

        $result = mysqli_query($mysqli, $sql);

        header('Location: painel_software.php'); 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Softwares</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <a href="index.php"><button class="titulo">SóNosCompiuter</button></a>
    </header>
    <h1>Edição de Softwares</h1>
    <form action="" method="POST">
        <div class="games">
            <div>
                <p class="pgames">Nome do Software:</p>
                <input class="label orçamento" type="text" id="nome_software" name="nome_software"
                    value="<?php echo $nome_software; ?>">
            </div>

            <p class="pgames">Pontuação GPU:</p>
            <input class="label orçamento" type="number" id="pontuacao_gpu" name="pontuacao_gpu"
                value="<?php echo $pontuacao_cpu_software; ?>">

            <div>
                <p class="pgames">Pontuação CPU:</p>
                <input class="label orçamento" type="number" id="pontuacao_cpu" name="pontuacao_cpu"
                    value="<?php echo $pontuacao_gpu_software; ?>">
            </div>

            <div class="cadastrar-container">
                <button class="cadastrar" type="submit">Editar</button>
                <button class="cadastrar" type="button"><a class="style-href"
                        href="painel_software.php">Voltar</a></button>
            </div>
            <?php
                if(isset($erro_geral)){
                    echo "<div class='info'>".$erro_geral."</div>";
                }
                
                if(isset($mensagem_pontuacao_cpu_invalido)){
                    echo "<div class='info'>".$mensagem_pontuacao_cpu_invalido."</div>";
                }

                if(isset($mensagem_pontuacao_gpu_invalido)){
                    echo "<div class='info'>".$mensagem_pontuacao_gpu_invalido."</div>";
                }

                if(isset($mensagem_software_cadastrada)){
                    echo "<div class='success'>".$mensagem_software_cadastrada."</div>";
                }

                if(isset($mensagem_software_nao_cadastrado)){
                    echo "<div class='info'>".$mensagem_software_nao_cadastrado."</div>";
                }
            ?>
        </div>
    </form>
</body>

</html>