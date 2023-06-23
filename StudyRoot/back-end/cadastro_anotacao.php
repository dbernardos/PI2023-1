<?php
   session_start();

   require_once('config.php');
   
   if (isset($_POST['cadastrar'])) {
       $titulo = $_POST['tituloAnotacao'];
       $assunto = $_POST['idAssuntoInsertAnotacao'];
       $paginaQueEnviou = $_POST['paginaAnotacao'];
       $estudante = $_SESSION['id'];
   
       $tituloFormatado = trim(preg_replace('/\s+/', ' ', $titulo));
   
       $tamanhoDoTitulo = mb_strlen($tituloFormatado);
   
       $stmt = $conn->prepare("SELECT * FROM assunto WHERE id_estudante_fk = ? AND id_assunto = ?");
       $stmt->bind_param("ii", $estudante, $assunto);
       $stmt->execute();
       $resultado = $stmt->get_result();
       $qtdLinhas = $resultado->num_rows;
   
       if ($qtdLinhas > 0) {
           $stmt = $conn->prepare("SELECT * FROM anotacao WHERE id_assunto_fk = ? AND titulo = ?");
           $stmt->bind_param("is", $assunto, $tituloFormatado);
           $stmt->execute();
           $resultadoTitulo = $stmt->get_result();
           $linha = $resultadoTitulo->fetch_object();
           $qtdTitulo = $resultadoTitulo->num_rows;
   
           if ($qtdTitulo > 0) {
               printf("<script>alert('O título %s já é registrado na sua conta'); location.href='../telas/%s'</script>", htmlspecialchars($linha->titulo), htmlspecialchars($paginaQueEnviou));
           } elseif ($tituloFormatado == NULL || $tituloFormatado == "" || $tamanhoDoTitulo > 24) {
               print "<script>alert('Sem gracinhas. Tente novamente da maneira correta. O título é obrigatório, deve conter no máximo 24 caracteres e não pode ser vazio ou apenas conter espaços em branco.'); location.href='../telas/" . htmlspecialchars($paginaQueEnviou) . "'</script>";
           } else {
               $stmt = $conn->prepare("INSERT INTO anotacao (id_anotacao, titulo, id_assunto_fk) VALUES (NULL, ?, ?)");
               $stmt->bind_param("si", $tituloFormatado, $assunto);
               $stmt->execute();
               $qtdLinhasAfetadas = $stmt->affected_rows;
   
               if ($qtdLinhasAfetadas > 0) {
                   print "<script>location.href='../telas/" . htmlspecialchars($paginaQueEnviou) . "'</script>";
               } else {
                   print "<script>alert('Não foi possível cadastrar'); location.href='../telas/" . htmlspecialchars($paginaQueEnviou) . "'</script>";
               }
           }
       } else {
           print "<script>location.href='../telas/home.php'</script>";
       }
   } else {
       print "deu ruim seu marolas";
   }
?>