<?php
  include('gerar.php');

  // Verificar se as variáveis de sessão estão definidas antes de acessá-las
  $result_cpu_final = isset($_SESSION['cpu']) ? $_SESSION['cpu'] : null;
  $result_gpu_final = isset($_SESSION['gpu']) ? $_SESSION['gpu'] : null;
  $result_mae_final = isset($_SESSION['placaMae']) ? $_SESSION['placaMae'] : null;
  $valorMenorCpu = isset($_SESSION['precoCpu']) ? $_SESSION['precoCpu'] : null;
  $valorMenorGpu = isset($_SESSION['precoGpu']) ? $_SESSION['precoGpu'] : null;
  $valorMenorMae = isset($_SESSION['precoMae']) ? $_SESSION['precoMae'] : null;
  $valor_pc = isset($_SESSION['precoPc']) ? $_SESSION['precoPc'] : null;
  $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peças</title>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
</head>

<body>
  <header>
    <a href="index.php"><button class="titulo">SóNosCompiuter</button></a>
  </header>
  <main>

    <h1>Peças</h1>

    <?php if ($result_cpu_final != null): ?>
    <div class="final">
      <div class="container-peca">
        <div class="peca">
          <p>Processador</p>
          <img src="img/ryzen.png" alt="">
          <div class="valor-container">
            <?php
              echo "<p>Preço:<span class='valor'> $valorMenorCpu </span></p><br>";
              echo "<p>CPU: $result_cpu_final</p><br>";
            ?>
          </div>
        </div>

        <div class="peca">
          <p>Placa de Vídeo</p>
          <img src="img/placa-video.png" alt="">
          <div class="valor-container">
            <?php
              if($valorMenorGpu != 0){
                echo "<p>Preço:<span class='valor'> $valorMenorGpu </span></p><br>";
              }else{
                echo "<p class='valor'>Placa gráfica integrada na CPU</p>";
              }
              echo "<p>GPU: $result_gpu_final</p><br>";
            ?>
          </div>
        </div>

        <div class="peca">
          <p>Placa-Mãe</p>
          <img src="img/placa-mae.png" alt="">
          <div class="valor-container">
            <?php
              echo "<p>Preço:<span class='valor'> $valorMenorMae </span></p><br>";
              echo "<p>CPU: $result_mae_final</p><br>";
            ?>
          </div>
        </div>
      </div>
      <div class="valorTotal-container">
        <div class="valor-total">
          <?php
            echo "Valor do PC: R$ $valor_pc<br>";
          ?>
        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="final">
      <?php echo $erro; ?>
    </div>
    <?php endif; ?>
    
  </main>
</body>

</html>