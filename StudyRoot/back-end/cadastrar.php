<?php
    session_start();

    require_once('config.php');
    include('bcrypt.php');

    if(isset($_POST['cadastrar'])){
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $emailFormatado = preg_replace('/\s+/', '', $email);
        $senhaFormatada = preg_replace('/\s+/', '', $senha);
        $usuarioFormatado = preg_replace('/\s+/', '', $usuario);

        $hash = Bcrypt::hash($senhaFormatada);

        $sql = "SELECT * FROM  estudante WHERE email = '$emailFormatado'";

        $res = $conn->query($sql);

        $qtd = $res->num_rows;

        if($qtd>0){
            print "<script>alert('Email já utilizado! Cadastro não realizado'); location.href='../telas/cadastro.php'</script>";
        } else if($emailFormatado == NULL || $emailFormatado == "" || $usuarioFormatado == NULL || $usuarioFormatado == "" || $senhaFormatada == NULL || $senhaFormatada == ""){
            print "<script>alert('Informações vazias ou com apenas espaços em branco! Cadastro não realizado'); location.href='../telas/cadastro.php'</script>";
        } else {
            $row = $conn->query("INSERT INTO estudante (usuario, email, senha) VALUE ('$usuarioFormatado', '$emailFormatado', '$hash')");
        }

        if($row){
            $select = $conn->query($sql);

            $res = $select->fetch_object();

            $_SESSION["id"] = $res->id_estudante;

            print "<script>location.href='../telas/home.php'</script>";
        } else{
            print "<script>alert('Não foi possível cadastrar.'); location.href='../telas/cadastro.php'</script>";
        }
    }
?>