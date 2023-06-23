<?php
    session_start();
    require_once('config.php');

    if(isset($_POST['atualizar'])){
        $idAssunto = $_POST['idAssunto'];
        $titulo = $_POST['tituloAtt'];
        $resumo = $_POST['resumoAtt'];
        $pagina = $_POST['pagina'];
        $estudante = $_SESSION['id'];

        $tituloFormatado = trim(preg_replace('/\s+/', ' ', $titulo));
        $tamanhoDoTitulo = mb_strlen($tituloFormatado);

        $resumoFormatado = trim(preg_replace('/\s+/', ' ', $resumo));
        $tamanhoDoResumo = mb_strlen($resumoFormatado);

        $tituloNaoAlterou = $conn->query("SELECT * FROM assunto WHERE id_estudante_fk = '$estudante' AND titulo = '$tituloFormatado' AND id_assunto = '$idAssunto'");
        $linhaNa = $tituloNaoAlterou->fetch_object();
        $qtdNa = $tituloNaoAlterou->num_rows;

        $resumoNaoAlterou = $conn->query("SELECT * FROM assunto WHERE id_estudante_fk = '$estudante' AND resumo = '$resumoFormatado' AND id_assunto = '$idAssunto'");
        $linhaRNa = $resumoNaoAlterou->fetch_object();
        $qtdRNa = $resumoNaoAlterou->num_rows;

        if($tituloFormatado == "" || $tituloFormatado == NULL || $tamanhoDoTitulo > 20 || $tamanhoDoResumo > 300){
            print "<script>alert('Sem gracinhas, tente denovo, da maneira correta, o título é obrigatório, deve conter no máximo 20 caractéres e não pode ser vazio ou apenas conter espaços em branco. Assim como o resumo deve conter no máximo 300 caractéres.'); location.href='../telas/$pagina'</script>";
        } else if($qtdNa > 0 && $qtdRNa > 0){
            print "<script>location.href='../telas/$pagina'</script>";

        } else if($qtdRNa > 0){
            $res = $conn->query("UPDATE assunto SET titulo = '$tituloFormatado' WHERE id_assunto = '$idAssunto'");
            print "<script>location.href='../telas/$pagina'</script>";
        } else if($qtdNa > 0){
            $res = $conn->query("UPDATE assunto SET resumo = '$resumoFormatado' WHERE id_assunto = '$idAssunto'");
            print "<script>location.href='../telas/$pagina'</script>";
        } else {
            $res = $conn->query("UPDATE assunto SET titulo = '$tituloFormatado', resumo = '$resumoFormatado' WHERE id_assunto = '$idAssunto'");
        }

        if($res){
            print "<script>location.href='../telas/$pagina'</script>";
        } else{
            print "<script>alert('Não foi possível cadastrar'); location.href='../telas/$pagina'</script>";
        }
    }
?>