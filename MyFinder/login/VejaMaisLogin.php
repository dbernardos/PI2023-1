<?php

include("conexao.php");
include('protect.php');

if (isset($_POST['botaoId'])) {
    $id_produtos = $_POST['id_produtos'];

    // Estabelecer a conexão com o banco de dados
    $conexao = mysqli_connect("localhost", "root", "", "myfinder");

    // Verificar se a conexão foi estabelecida com sucesso
    if (mysqli_connect_errno()) {
        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
        exit();
    }

    // Preparar a consulta SQL
    $sql_code = "SELECT * FROM produtos WHERE id_produtos = '$id_produtos'";
    $resultado = mysqli_query($conexao, $sql_code);
   


    // Verificar se a consulta foi executada com sucesso
    if ($resultado) {
        // Verificar se foram encontrados registros
        if (mysqli_num_rows($resultado) > 0) {
            // Loop para processar cada registro retornado pela consulta
            while ($row = mysqli_fetch_assoc($resultado)) {
                // Acessar os valores retornados do banco de dados
                $id = $row['id_produtos'];
                $nome = $row['nome'];
                $preco  = $row['preco'];
                $descricao = $row['descricao'];
                $link = $row['link'];
                $imagem = $row['imagem'];

                // Realizar qualquer ação necessária com os valores obtidos
            }
        } else {
            echo "Nenhum registro encontrado.";
        }
    } else {
        echo "Erro na execução da consulta: " . mysqli_error($conexao);
    }

   
   

    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veja Mais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./VejaMais.css">
</head>

<body>


    <h1><?php echo " " . $nome . "<br>";?></h1>
    <hr>




    <div class="veja">
        <div class="img">
            <img class="imgVeja" src="<?php echo $imagem; ?>" alt="Imagem do produto">
        </div>
        <div class="info-produto">
            <h5>Preço: </h5>
            <p>R$ <?php  echo $preco ?></p>
            <h5>Descrição: </h5>
            <p><?php echo $descricao; ?></p>

            <div class="botoes-produto">
                <div class="flex-item">
                    <a href="<?php echo $link; ?>" class="btn btn-lg btn-dark btn-block" target="_blank">Visitar</a>
                </div>
                <div class="flex-item">
                    <form method="POST" action="tela_editLogin.php">
                        <input type="hidden" name="id_produtos" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-lg btn-dark btn-block">Editar</button>

                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <h2> Histórico de Preços: </h2>
 

    <br>

    <?php  $sql_code_his = "SELECT * FROM historicoprodutos WHERE id_produtos = '$id_produtos'";

// Executar a consulta SQL
$resultado_his = mysqli_query($conexao, $sql_code_his);

// Verificar se a consulta foi executada com sucesso
if ($resultado_his) {
    // Verificar se foram encontrados registros
    if (mysqli_num_rows($resultado_his) > 0) {
        // Array para armazenar os valores do histórico de produtos
        $dados_historico = array();

        // Loop para processar cada registro retornado pela consulta
        while ($row = mysqli_fetch_assoc($resultado_his)) {
            // Acessar os valores retornados do banco de dados
            $id_historico = $row['id_historico'];
            $id_produtos_his = $row['id_produtos'];
            $nome_his = $row['nome'];
            $preco_his = $row['preco'];
            $data_his = $row['data'];

            // Armazenar os valores em um array
            $dados_historico[] = array(
                'id_historico' => $id_historico,
                'id_produtos_his' => $id_produtos_his,
                'nome_his' => $nome_his,
                'preco_his' => $preco_his,
                'data_his' => $data_his
            );
        }
        $cont = 1;
        ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Data</th>
            </tr>
        </thead>

        <?php

        // Verificar se foram encontrados registros
        if (!empty($dados_historico)) {
            // Loop para acessar os valores armazenados no array
            foreach ($dados_historico as $historico) {
                // Acessar os valores individualmente
                $id_historico = $historico['id_historico'];
                $id_produtos_his = $historico['id_produtos_his'];
                $nome_his = $historico['nome_his'];
                $preco_his = $historico['preco_his'];
                $data_his = $historico['data_his'];

                ?>


        <tbody>
            <tr>
                <th scope="row"><?php 
      
      echo $cont;
      
      
      ?></th>
                <td> <?php echo $nome_his; ?></td>
                <td>R$ <?php echo $preco_his; ?></td>

                <td><?php echo date('d/m/Y', strtotime($data_his)); ?></td>
            </tr>
        </tbody>


        <?php
            $cont++;}?>
    </table>




    <?php
        } else {
            echo "Nenhum registro encontrado.";
        }
    } else {
        echo "Nenhum registro encontrado.";
    }
} else {
    echo "Erro na execução da consulta: " . mysqli_error($conexao);
}
// Fechar a conexão com o banco de dados
mysqli_close($conexao);
}

?>





</body>

</html>