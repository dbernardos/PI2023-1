<script src="../js/logout.js"></script>

<?php
    include('protect.php')
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <a href="../index.php"><button class="titulo">SóNosCompiuter</button></a>
    </header>
    <main>

        <h1>Bem vindo aos painéis</h1>

        <div class="painel">
            <div class="flexbox">
                <div class="div-painel">
                    <p class="painel-p"><a class="style-href" href="painel_cpu.php">Painel CPU</a></p>
                </div>
                <div class="div-painel">
                    <p class="painel-p"><a class="style-href" href="painel_gpu.php">Painel GPU</a></p>
                </div>
                <div class="div-painel">
                    <p class="painel-p"><a class="style-href" href="painel_placa_mae.php">Painel Placa Mãe</a></p>
                </div>
                <div class="div-painel">
                    <p class="painel-p"><a class="style-href" href="painel_software.php">Painel Software</a></p>
                </div>
                <div class="div-painel">
                    <p class="painel-p"><a class="style-href" href="painel_login.php">Painel Login de Adiministrador</a>
                    </p>
                </div>
            </div>
            <button class="proximo" onclick="logout()">Deslogar</button>
        </div>
        <br>
    </main>
</body>

</html>