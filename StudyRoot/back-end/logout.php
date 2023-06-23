<?php
    session_start();
    unset($_SESSION["id"]);
    session_destroy();
    print "<script>location.href='../telas/index.php'</script>";
    exit;