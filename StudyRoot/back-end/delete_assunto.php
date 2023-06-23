<?php
    require('config.php');

    $id = $_POST["idAssuntoDelelete"];
    $pagina = $_POST["pagina"];

    if($conn){
        $verificaAnotacoes = $conn->query("SELECT * FROM anotacao WHERE id_assunto_fk = $id");

        if($verificaAnotacoes){
            $deleteAnotacoes = $conn->query("DELETE FROM anotacao WHERE id_assunto_fk = $id");

            if($deleteAnotacoes){
                $deleteAssunto = $conn->query("DELETE FROM assunto WHERE id_assunto = $id");

                if($deleteAssunto){
                    print "<script>location.href='../telas/$pagina'</script>";
                }
            }
        } else {
            $deleteAssunto = $conn->query("DELETE FROM assunto WHERE id_assunto = $id");

            if($deleteAssunto){
                print "<script>location.href='../telas/$pagina'</script>";
            }

        }
    }
    print "<script>alert('Não foi possível deletar'); location.href='../telas/$pagina'</script>";
?>