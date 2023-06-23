<?php
    session_start();

    require_once('config.php');

    if(isset($_POST['salvaTexto'])){
        $idAnotacao = $_POST['idAnotacao'];
        $texto = $_POST['editor'];
        $paginaQueEnviou = $_POST['pagina'];

        $row = $conn->query("UPDATE anotacao SET conteudo = '$texto' WHERE id_anotacao = $idAnotacao");

        if($row){
            print "<script>location.href='../telas/$paginaQueEnviou'</script>";
        } else{
            print "<script>alert('Não foi possível salvar o texto, tente denovo depois.'); location.href='../telas/$paginaQueEnviou'</script>";
        }
    }
?>