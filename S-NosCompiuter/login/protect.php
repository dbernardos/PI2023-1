<?php 
    if(!isset($_SESSION)) {
        session_start();
    }
    
    if(!isset($_SESSION['id'])) {
        die("Você não tem acesso a essa página! Realize o login: <a href=\"indexlogin.php\">Entrar</a>");
    }
?>