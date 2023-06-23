<?php

$hostname = "localhost";
$bancodedados = "medicalsystem";
$usuario = "root";
$senha = "";

$conexao = mysqli_connect($hostname, $usuario, $senha, $bancodedados) or die ("Não foi possivel conectar");

//if ($mysqli->connect_errno) {

   // echo "Falha ao conectar (" . $mysqli->connect_errno . ") " . $msqli->connect_errno;

//} else
    //echo "Conectado ao Banco de Dados";

?>