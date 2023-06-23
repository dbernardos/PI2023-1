<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Games</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/horta" type="text/css" />
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type="text/javascript" src="./js/buscajs.js"></script>
  <script src="./js/selecionar_software.js"></script>
</head>

<body>
  <header>
    <a href="index.php"><button class="titulo">SóNosCompiuter</button></a>
  </header>

  <main>
    <h1>Especificações</h1>
    <form method="post" id="form-pesquisa" action="final.php">
      <div class="games">
        <p class="pgames">Orçamento:</p>
        <input id="orcamento" class="label orçamento" type="number" name="orcamento" placeholder="R$"></input>
        <br>
        <p class="pgames">Desempenho geral:</p>

        <select name="desempenho" id="btnDesempenhoGeral">
          <option value="Alto">Alto</option>
          <option value="Médio">Médio</option>
          <option value="Baixo">Baixo</option>
        </select>
        <br>
        <p class="pgames">Configurações avançadas:</p>
        <select id="onOff">
          <option value="Off" selected>Off</option>
          <option value="On">On</option>
        </select>

        <div class="avançado">
          <p class="pavançado">FPS:</p>
          <select name="fps" class="selectavançado" id="btnFps">
            <option value="60" selected>60</option>
            <option value="144">144</option>
            <option value="240">240</option>
            <option value="360">360</option>
          </select>
          <div class="selected-graficos">
            <p class="pavançado">Gráficos:</p>
            <select name="grafico" class="selectavançado" id="btnGrafico">
              <option value="ultra" selected>Ultra</option>
              <option value="Alto">Alto</option>
              <option value="Médio">Médio</option>
              <option value="Baixo">Baixo</option>
            </select>
          </div>
        </div>

        <div id="demo"></div>

        <div class="submit-container">
          <div class="submit-line">
            <input class="busca" type="text" placeholder="Jogo desejado" name="pesquisaApp" id="pesquisa">
            <button class="submit-lente" type="submit" value="pesquisar">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>



        <ul class="resultado" id="lista-software"></ul>
        <div class="output-container">
          <ul id="output"></ul>
        </div>
        <button class="proximo" type="submit" name="Próximo" id="proximo" onclick="validarCampo(event)">Próximo</button>
      </div>
    </form>
  </main>
  <script src="./js/games.js"></script>
  <script src="./js/avisoFps.js"></script>
</body>

</html>