<?php
    session_start();

    require_once('config.php');

    if(isset($_POST['cadastrar'])){
        $titulo = $_POST['titulo'];
        $resumo = $_POST['resumo'];
        $estudante = $_SESSION['id'];
        $paginaQueEnviou = $_POST['pagina'];

        $tituloFormatado = trim(preg_replace('/\s+/', ' ', $titulo));

        $tamanhoDoTitulo = mb_strlen($tituloFormatado);

        $resumoFormatado = trim(preg_replace('/\s+/', ' ', $resumo));

        $tamanhoDoResumo = mb_strlen($resumoFormatado);

        $tituloRepetido = $conn->query("SELECT * FROM assunto WHERE id_estudante_fk = '$estudante' AND titulo = '$tituloFormatado'");

        $linha = $tituloRepetido->fetch_object();

        $qtd = $tituloRepetido->num_rows;

        if($qtd > 0){
            printf("<script>alert('O título %s já é registrado na sua conta'); location.href='../telas/$paginaQueEnviou'</script>", $linha->titulo);
        } else if($titulo == NULL || $titulo = "" || $tituloFormatado == NULL || $tamanhoDoTitulo > 52 || $tamanhoDoResumo > 300){
            print "<script>alert('Sem gracinhas, tente denovo, da maneira correta, o título é obrigatório, deve conter no máximo 52 caractéres e não pode ser vazio ou apenas conter espaços em branco. Assim como o resumo deve conter no máximo 300 caractéres.'); location.href='../telas/$paginaQueEnviou'</script>";
        } else {
            $row = $conn->query("INSERT INTO assunto (id_assunto, titulo, resumo, id_estudante_fk) VALUES (NULL, '$tituloFormatado', '$resumoFormatado', '$estudante');");
        }

        if($row){
            print "<script>location.href='../telas/$paginaQueEnviou'</script>";
        } else{
            print "<script>alert('Não foi possível cadastrar'); location.href='../telas/$paginaQueEnviou'</script>";
        }
    }
?>