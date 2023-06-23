<?php
    include('protect.php');
    include('conexao.php');

    
    $nome_cpu = filter_input(INPUT_POST, 'nome_cpu', FILTER_SANITIZE_STRING);

    $marca_cpu = filter_input(INPUT_POST, 'marca_cpu', FILTER_SANITIZE_STRING);

    $soquete_cpu = filter_input(INPUT_POST, 'soquete_cpu', FILTER_SANITIZE_STRING);

    $preco_cpu = filter_input(INPUT_POST, 'preco_cpu', FILTER_SANITIZE_STRING);

    $pontuacao_cpu = filter_input(INPUT_POST, 'pontuacao_cpu', FILTER_SANITIZE_STRING);

    $nome_gpu_integrado = filter_input(INPUT_POST, 'gpu_integrada', FILTER_SANITIZE_STRING);

    $query = "select nome_cpu from cpu where nome_cpu = '{$nome_cpu}'";

    $resultado = mysqli_query($mysqli, $query);

    $row = mysqli_num_rows($resultado);

    if($nome_cpu == "" || $marca_cpu == "" || $soquete_cpu == "" || $preco_cpu == "" || $pontuacao_cpu == "") {
        $erro_geral = "Todos os campos a não ser GPU Integrada precisam ser preenchidos!";
    }else if ($pontuacao_cpu < 0){
        $mensagem_pontuacao_invalido = "Insira uma pontuaçâo válida!";
    }else if ($preco_cpu < 0){
        $mensagem_preco_invalido = "Insira um preço válido!";
    }else if (preg_match('/^[a-zA-Z0-9\s-]+$/', $nome_gpu_integrado) || $nome_gpu_integrado == "") {
        if(preg_match('/^[a-zA-Z0-9]+$/', $soquete_cpu)) {
            if(preg_match('/^[0-9]+$/', $preco_cpu) || preg_match('/^[0-9]+$/', $pontuacao_cpu)) {
                if (preg_match('/^[a-zA-Z0-9\s-]+$/', $nome_cpu)) {
                    if(preg_match('/^[a-zA-Z0-9]+$/', $marca_cpu)){
                        if($row == 0){
                            $sql = "insert into cpu (marca, soquete, pontuacao, preco, nome_cpu, gpu_integrado) values('$marca_cpu', '$soquete_cpu', $pontuacao_cpu, '$preco_cpu', '$nome_cpu', '$nome_gpu_integrado')";
                
                            $result = mysqli_query($mysqli, $sql);
                
                            if(mysqli_insert_id($mysqli)) {
                                $mensagem_cpu_cadastrada = "CPU cadastrada com sucesso!";
                            }
                        }else if($row >= 1) {                                           
                            $mensagem_cpu_nao_cadastrada = "CPU já cadastrada!";
                        }
                    }else {
                        $mensagem_marca_invalida = "O campo marca só pode conter letras e números!";
                    }
                } else {
                    $mensagem_caracteres_invalidos_letras_numeros = "Os campos nome e marca só podem conter letras e números!";
                }
            }else{
                $mensagem_caracteres_invalidos_numeros = "Os campos pontuaçãoe e preço só podem conter números inteiros!";
            }
        }else {
            $mensagem_soquete_invalido = "O campo soquete só pode conter letras e números!";
        }
    }else {
        $mensagem_nome_gpu_integrado_invalido = "O campo GPU Integrada só pode conter letras e números!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro CPU</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <a href="../index.php"><button class="titulo">SóNosCompiuter</button></a>
  </header>

    <h1>Cadastro de CPU</h1>
    <form action="" method="POST">
        <div class="games">
            <div>
                <p class="pgames">Nome da CPU:</p> 
                <input class="label orçamento" type="text" id="nome_cpu" name="nome_cpu">
            </div>

            <p class="pgames">Marca:</p> 
            <input class="label orçamento" type="text" id="marca_cpu" name="marca_cpu">

            <div>
                <p class="pgames">Soquete CPU:</p> 
                <input class="label orçamento" type="text" id="soquete_cpu" name="soquete_cpu">
            </div>

            <div>
                <p class="pgames">Pontuação:</p> 
                <input class="label orçamento" type="text" id="pontuacao_cpu" name="pontuacao_cpu">
            </div>

            <p class="pgames">Preço:</p> 
            <input class="label orçamento" type="text" id="preco_cpu" name="preco_cpu">

            <div>
                <p class="pgames">GPU Integrada:</p>
                <input class="label orçamento" type="text" id="gpu_integrada" name="gpu_integrada">
            <div>

            
            <div class="cadastrar-container">
                <button class="cadastrar" type="submit">Cadastrar</button>
                <button class="cadastrar" type="button"><a class="style-href" href="painel_cpu.php">Voltar</a></button>
            </div>

            <?php
                if(isset($erro_geral)){
                    echo "<div class='info'>".$erro_geral."</div>";
                }
                
                if(isset($mensagem_cpu_cadastrada)){
                    echo "<div class='success'>".$mensagem_cpu_cadastrada."</div>";
                }

                if(isset($mensagem_soquete_invalido)){
                    echo "<div class='info'>".$mensagem_soquete_invalido."</div>";
                }
                
                if(isset($mensagem_pontuacao_invalido)){
                    echo "<div class='info'>".$mensagem_pontuacao_invalido."</div>";
                }

                if(isset($mensagem_preco_invalido)){
                    echo "<div class='info'>".$mensagem_preco_invalido."</div>";
                }

                if(isset($mensagem_cpu_nao_cadastrada)){
                    echo "<div class='info'>".$mensagem_cpu_nao_cadastrada."</div>";
                }

                if(isset($mensagem_caracteres_invalidos)){
                    echo "<div class='info'>".$mensagem_caracteres_invalidos."</div>";
                }

                if(isset($mensagem_caracteres_invalidos_letras_numeros)){
                    echo "<div class='info'>".$mensagem_caracteres_invalidos_letras_numeros."</div>";
                }

                if(isset($mensagem_caracteres_invalidos_numeros)){
                    echo "<div class='info'>".$mensagem_caracteres_invalidos_numeros."</div>";
                }

                if(isset($mensagem_marca_invalida)){
                    echo "<div class='info'>".$mensagem_marca_invalida."</div>";
                }

                if(isset($mensagem_nome_gpu_integrado_invalido)){
                    echo "<div class='info'>".$mensagem_nome_gpu_integrado_invalido."</div>";
                }
            ?>
        </div>
    </form>
</body>
</html>