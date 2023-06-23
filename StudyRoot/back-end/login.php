<?php
    session_start();

    include('config.php');
    include('bcrypt.php');

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if( empty($_POST) || (empty($_POST['email'])) || (empty($_POST['senha'])) || $email == "" || $senha == "" ){
        print "<script>alert('Email e/ou senha incorreto(s)'); location.href='../telas/index.php';</script>";
    }

    $sql = "SELECT * FROM estudante WHERE email = '{$email}'";

    $res = $conn->query($sql) or die($conn->error);

    $row = $res->fetch_object();

    $qtd = $res->num_rows;

    $hash = $row->senha;

     if($qtd > 0){
        if(Bcrypt::check($senha, $hash)){
            $_SESSION["id"] = $row->id_estudante;
        } else {
            print "<script>alert('Email e/ou senha incorreto(s)'); location.href='../telas/index.php';</script>";
        }
        print "<script>location.href='../telas/home.php'</script>";
    }