<?php
    include('protect.php');
    include("conexao.php");

    $nome_mae = filter_input(INPUT_POST, 'nome_placa_mae', FILTER_SANITIZE_STRING);

    $soquete_mae = filter_input(INPUT_POST, 'soquete_mae', FILTER_SANITIZE_STRING);

    $marca = filter_input(INPUT_POST, 'marca_mae', FILTER_SANITIZE_STRING);

    $preco = filter_input(INPUT_POST, 'preco_mae', FILTER_SANITIZE_STRING);

    $query = "select nome_mae from placa_mae where nome_mae = '{$nome_mae}'";

    $resultado = mysqli_query($mysqli, $query);

    $row = mysqli_num_rows($resultado);

    if(empty($nome_mae) || empty($soquete_mae) || empty($marca) || empty($preco)) {
        $erro_geral = "Todos os campos precisam ser preenchidos!";
    }else if ($preco < 0){
        $mensagem_preco_invalido = "Insira um preço válido!";
    }else if(preg_match('/^[a-zA-Z0-9\s]+$/', $marca)) {
        if(preg_match('/^[a-zA-Z0-9\s-]+$/', $nome_mae)) {
            if(preg_match('/^[a-zA-Z0-9\s]+$/', $soquete_mae)) {
                if($row == 0){
                    $sql = "insert into placa_mae (soquete_mae, marca, preco, nome_mae) values('$soquete_mae', '$marca', $preco, '$nome_mae')";
            
                    $result = mysqli_query($mysqli, $sql);
            
                    if(mysqli_insert_id($mysqli)) {
                        $mensagem_placa_mae_cadastrada = "Placa Mãe cadastrada com sucesso!";
                    }
                }else {
                    $mensagem_placa_mae_nao_cadastrada = "Placa Mãe não cadastrada com sucesso!";
                }
            }else {
                $mensagem_soquete_invalido = "O campo soquete só pode conter letras e numeros!";
            }
        }else {
            $mensagem_nome_invalido = "O campo nome só pode conter letras, números e '-'!";
        }
    }else {
        $mensagem_marca_invalido = "O campo marca só pode conter letras e números!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Placa-Mãe</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <a href="../index.php"><button class="titulo">SóNosCompiuter</button></a>
    </header>
    <h1>Cadastro de Placa Mãe</h1>
    <form action="" method="POST">
        <div class="games">

            <div>
                <p class="pgames">Nome da Placa Mãe:</p>
                <input class="label orçamento" type="text" id="nome_placa_mae" name="nome_placa_mae">
            </div>

            <p class="pgames">Soquete Placa Mãe:</p>
            <input class="label orçamento" type="text" id="soquete_mae" name="soquete_mae">

            <div>
                <p class="pgames">Marca:</p>
                <input class="label orçamento" type="text" id="marca_mae" name="marca_mae">
            </div>

            <p class="pgames">Preço:</p>
            <input class="label orçamento" type="number" id="preco_mae" name="preco_mae">

            <div class="cadastrar-container">
                <button class="cadastrar" type="submit">Cadastrar</button>
                <button class="cadastrar" type="button"><a class="style-href"
                        href="painel_placa_mae.php">Voltar</a></button>
            </div>
            <?php
                if(isset($erro_geral)){
                    echo "<div class='info'>".$erro_geral."</div>";
                }
                
                if(isset($mensagem_placa_mae_cadastrada)){
                    echo "<div class='success'>".$mensagem_placa_mae_cadastrada."</div>";
                }

                if(isset($mensagem_soquete_invalido)){
                    echo "<div class='info'>".$mensagem_soquete_invalido."</div>";
                }

                if(isset($mensagem_preco_invalido)){
                    echo "<div class='info'>".$mensagem_preco_invalido."</div>";
                }

                if(isset($mensagem_placa_mae_nao_cadastrada)){
                    echo "<div class='info'>".$mensagem_placa_mae_nao_cadastrada."</div>";
                }

                if(isset($mensagem_nome_invalido)){
                    echo "<div class='info'>".$mensagem_nome_invalido."</div>";
                }

                if(isset($mensagem_marca_invalido)){
                    echo "<div class='info'>".$mensagem_marca_invalido."</div>";
                }
            ?>
        </div>
    </form>
</body>

</html>