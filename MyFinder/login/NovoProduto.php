<?php
//echo $_SERVER['REQUEST_METHOD'];

include("conexao.php");
include('protect.php');


$nome = mysqli_real_escape_string($conexao,trim($_POST['nome']));
$preco = mysqli_real_escape_string($conexao,trim($_POST['preco'])); 
$descricao = mysqli_real_escape_string($conexao,trim($_POST['descricao']));
$link = mysqli_real_escape_string($conexao,trim($_POST['link'])); 
// $imagem = date("Ymd").date("His").mysqli_real_escape_string($conexao,trim($_POST['imagem'])); 
$imagem = ""; 


//include("conexao.php");

 if(isset($_POST['acao'])){
     $arquivo = $_FILES['file'];
     $arquivoNovo = explode('.', $arquivo['name']);
     if($arquivoNovo[sizeof($arquivoNovo)-1] !='jpg'){
         die('Este tipo de arquivo não pode fazer upload ou este campo não poder ser vazio');

     }else{
         echo "Upload ok!";
         $imagem = 'imagensProduto/' .date("Ymd").date("His").$arquivo['name'];
         move_uploaded_file($arquivo['tmp_name'], $imagem);
     }
 }
 
 
//if(isset($_POST['btnAddProduto'])) {
    $sql = "SELECT COUNT(*) AS total FROM produtos WHERE nome = '".$nome."'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);


    if($row['total'] == 1 || $nome == ""){
        $_SESSION['produtos_existe'] = true;
        echo "produto ja existe";
        header('Location: TelaNovoProduto.php');
        exit;
    }

    $fk_cliente = $_SESSION['user'];
    

    $sql = "INSERT INTO produtos (nome, preco, descricao, link, imagem, fk_cliente) VALUES ('$nome', '$preco', '$descricao', '$link', '$imagem', '$fk_cliente')";
    $result = mysqli_query($conexao, $sql);
  $id_produtos = mysqli_insert_id($conexao);
  
    $data = date("Y-m-d");
    $sql = "INSERT INTO historicoProdutos (nome, preco, data, id_produtos) VALUES ('$nome', '$preco', '$data', '$id_produtos')";
    $result = mysqli_query($conexao, $sql);


   header("Location: MeusProdutos.php");








?>
