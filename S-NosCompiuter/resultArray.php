<?php 
    // obtém dados (string) enviados pelo JavaScript e transforma em array PHP
    //transforma a string de itens separados em array
    $array_produtos = filter_input(INPUT_POST, 'array', FILTER_SANITIZE_SPECIAL_CHARS);
    $array_produtos = explode(",", $array_produtos); 
    $array_string = implode(",", $array_produtos); 

    //mostra o conteúdo do array 
     //print_r($array_produtos); 

    echo "<input type='hidden' name='txtsoftwares' id='txtsoftwares' value='$array_string'> <br><br>";
?>

 