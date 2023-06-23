<?php  

include('protect.php');
include('conexao.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>MyFinder</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='posLogin.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.bundle.min.js'></script>

</head>

<body>
    <!-- Nome do site-->

    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                MyFinder
            </a>
            <div class="btnPrincipal">
                <button class="glow-on-hover" id="btnLogin" onclick="window.location.href = '../login/Login.php'"
                    style=" float: rigth">Logout</button>

            </div>
        </div>
    </nav>
    <!--fim do nome do site-->

    <!--MENU de notificação-->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./posLogin.php">Principal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active meu-produto" aria-current="page" href="./MeusProdutos.php">Meus
                            Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active configuracoes" aria-current="page"
                            href="../Configuracoes/configuracoes.php">Configurações</a>
                    </li>

                </ul>




            </div>
        </div>
    </nav>


    <div class="bg-dark" style="height: 300px">
        <section id="oferta">
            <div class="box-search bg-dark">
                <form class="d-flex justify-content-center" role="search" method="POST">


                    <input class="form-control me-2 pesquisa" type="search" placeholder="Pesquisar..." name="pesquisar"
                        id="pesquisar" aria-label="Search">
                    <button onclick="searchData()" class="btn btn-outline-light botao" type="submit">Pesquisar</button>

                </form>

            </div>
        </section>
    </div>
    <h1 class="adaptive-heading">MyFinder ---------------------------------------------------</h1>
    <br>

    <?php
          if(!isset($_POST['pesquisar']) || ($_POST['pesquisar']) == ''){
            ?>

    <table>
        <tr>

            <?php
      //$pesquisa = mysqli_real_escape_string ($conexao,trim($_POST['titulo']));
      $sql_code = "SELECT * FROM produtos";
      $sql_query = $conexao->query($sql_code) or die("Falha na execução do banco de dados" . $conexao->error);
      
      $cont = 0;
      
      while($dados = $sql_query->fetch_assoc()){
        $cont++;
        ?>
            <form action="VejaMaisLogin.php" method="POST">
                <td>
                    <div class="card" style="width: 18rem;" name="card">
                        <div class="card text-center">
                            <div class="card-header" name="titulo" id="titulo" method="POST">
                                <?php echo $dados['nome']?>
                            </div>
                            <div class="card-body">
                                <img class="card-text" style="width: 250px; height:200px;"
                                    src="<?php echo $dados['imagem']; ?>" alt="Imagem do produto">
                                <p class="card-text">Preço: <?php echo $dados['preco']?></p>

                                <p class="card-text"><?php echo $dados['descricao']?></p>

                                <a href="<?php echo $dados['link']?>" class="btn btn-Lg btn-dark btn-block"
                                    target="_blank">Visitar</a>



                                <?php
                    $id_produtos2 = $dados['id_produtos'];
                    //echo"oi".$id_produtos2;
                  ?>
                                <input type="text" class="form-control" name="id_produtos"
                                    value="<?php echo $id_produtos2 ?>" hidden>
                                <button class="btn btn-Lg btn-dark btn-block" type="submit" name="botaoId">Veja
                                    Mais</button>



                            </div>
                        </div>
                    </div>
                </td>
            </form>
            <style>
            .card-text {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            </style>

            <?php 
        if($cont == 6){
          $cont = 0;
          ?>
        </tr>
        <tr>
            <?php 
        }
      } 
      ?>





    </table>


    <?php 
          } else{

            $pesquisa = mysqli_real_escape_string ($conexao,trim($_POST['pesquisar']));
            $sql_code = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%'";

           $sql_query = $conexao->query($sql_code) or die("Falha na execução do banco de dados" . $conexao->error);

            if($sql_query->num_rows == 0){
          ?>

    <table>
        <tr>

        <tr>
            <td colspan="3">Nenhum resultado encontrado...</td>
        </tr>
        <?php }


            else{
              $cont = 0;
              while($dados = $sql_query->fetch_assoc()){
                $cont++;
                ?>
        <tr>
            <td>
                <form action="VejaMaisLogin.php" method="POST">
            </td>
            <td>
                <div class="card" style="width: 18rem;" name="card">
                    <div class="card text-center">
                        <div class="card-header" name="titulo" id="titulo" method="POST">
                            <?php echo $dados['nome']?>
                        </div>
                        <div class="card-body">
                            <img class="card-text" style="width: 250px; height:200px;"
                                src="<?php echo $dados['imagem']; ?>" alt="Imagem do produto">
                            <p class="card-text">Preço: R$<?php echo $dados['preco']?></p>

                            <p class="card-text"><?php echo $dados['descricao']?></p>

                            <a href="<?php echo $dados['link']?>" class="btn btn-Lg btn-dark btn-block"
                                target="_blank">Visitar</a>



                            <?php
                    $id_produtos2 = $dados['id_produtos'];
                    //echo"oi".$id_produtos2;
                  ?>
                            <input type="text" class="form-control" name="id_produtos"
                                value="<?php echo $id_produtos2 ?>" hidden>
                            <button class="btn btn-Lg btn-dark btn-block" type="submit" name="botaoId">Veja
                                Mais</button>



                        </div>
                    </div>
                </div>
            </td>
            </form>
            <style>
            .card-text {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            </style>
        </tr>
        <?php
              }
            }
            ?>
        <?php 
        if($cont == 6){
          $cont = 0;
          ?>
        </tr>
        <tr>
            <?php 
        }
          }
      ?>
    </table>


    <!--Cards-->



    <br>
    <br>








    <!--Fim do menu-->


    <!--Imagem de ofertas e promoções    
        <section id = "oferta">
            <div id = "ofertas">
                <img src="../imagens/ofertas.png" allign = "middle"/>
              </div>
        </section>
        Fim da imagem-->


</body>

</html>