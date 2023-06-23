<?php
$host = "localhost";
$db = "db_sonoscompiuter";
$user = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$db", $user, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
}
?>
