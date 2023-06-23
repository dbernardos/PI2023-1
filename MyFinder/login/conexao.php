<?php
$servername = "localhost";
$database = "myfinder";
$username = "root";
$password = "";
// Create connection
$conexao = mysqli_connect($servername, $username, $password, $database) or die ('Não foi possível conectar');


//$mysqli = new mysqli($servername, $username, $password, $database);
// Check connection
//if ($mysqli->connect_errno) {
//    die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
//}
//echo "Conectado com sucesso";
//mysqli_close($mysqli);
?>