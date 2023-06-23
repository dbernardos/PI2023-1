<?php

session_start();



if(!isset($_SESSION['user'])){
    die("Você nao pode acessar esta pagina porque nao está logado.");
}
?>