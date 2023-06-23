<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melhor Aplicativo de Estudo</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/aside.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body class="flex">

  <?php
  require_once('../back-end/config.php');
  session_start();
  if(empty($_SESSION)){
    print "<script>location.href='../telas/index.php';</script>";
  }
  ?>
  <div id="sidebar" class="flex column"> 

  <div id="searchBar" class="flex center">
    <input class="buscador" onkeyup="filtrar()" type ="text" id="inputDeSearch" placeholder ="Assunto desejado">
  </div>


  <div id="barra-de-ferramentas" class="flex start">
    <button id="abreModalConfig" class="btn-transparente" onclick="mostra('config')"><i class="fa-solid fa-gear fa-lg gira" style="color: #a3a3a3;"></i></button>
    <button class="btn-transparente branco btn-branco-hover" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-circle-plus fa-lg"></i></button>
    <button hidden id="botao-magia" data-bs-toggle="modal" data-bs-target="#modalUpdate"></button>
    <button hidden id="botao-maravilha" data-bs-toggle="modal" data-bs-target="#modalDelete"></button>
    <div id="config">
      <i class="fa fa-user-circle user-botolas" data-bs-toggle="modal" data-bs-target="#modalUpdateSenha"></i>
      <a href="../back-end/logout.php"><button class="btn-cfgvermelho">Sair</button></a>
    </div>
  </div> 

  <div id="listaDeAssuntos" class="flex column">
    <?php
      $id = $_SESSION['id'];

      if($result = $conn -> query("SELECT * FROM assunto WHERE id_estudante_fk = $id")){
        while($assunto = $result -> fetch_object()){
          printf("<div value='%s'> <div class='flex'> <form action='./assunto.php' method='get'> <input hidden name='getIdAssunto' value='%d'> <button class='bts btn-preto-background-hover' type='submit'> <span>%s</span> </button> </form> <div class='edit column space-around' id='%d' style='display: none;'> <form action='./home.php' method='get'> <input hidden type='text' value='%d' name='idAssuntoDel' id='idAssuntoDel'> <input hidden type='text' value='%s' name='tituloDel' id='tituloDel'> <button type='submit' name='mostraDelete' class='btn-transparente'><i class='fa-solid fa-trash-can fa-lg icones btn-vermelho'></i></button> </form> <form action='./home.php' method='get'><input hidden name='id_assunto' type='text' value='%d'><input hidden name='titulo-btn' type='text' value='%s'><input hidden name='resumo-btn' type='text' value='%s'><button type='submit' name='mostraAtt' class='btn-transparente'><i class='fa-regular fa-pen-to-square fa-lg branco btn-branco-hover icones'></i></button></form> </div> <button class='bts-options btn-preto-background-hover' onclick='mostra(%d)'><i class='fa-solid fa-ellipsis-vertical branco'></i></button> </div> </div>", $assunto->titulo, $assunto->id_assunto, $assunto->titulo,  $assunto->id_assunto, $assunto->id_assunto, $assunto->titulo, $assunto->id_assunto, $assunto->titulo, $assunto->resumo, $assunto->id_assunto);
        }
        $result -> free_result();
      }
    ?>
      </div>
  </div>

  <img src="../img/logo.jpeg" class="flex logo">

  <!-- Modal -->
  <div class="modal fade branco" id="modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5 titulo">Adicionar Assunto</h1>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form action="../back-end/cadastro_assunto.php" method="post">
          <div class="modal-body">
            <input SIZE = 26 MAXLENGTH = 52 class ="nome-assunto" required name="titulo" id="titulo" type ="text" placeholder ="Título" aria-label ="Search">
            <input SIZE = 26 MAXLENGTH = 300 class ="descricao-assunto" name="resumo" id="resumo" type ="text" placeholder ="Descrição" aria-label ="Search">
            <input hidden type="text" name="pagina" id="pagina" value="home.php">
          </div>

          <div class="modal-footer">
            <button name="cadastrar" type="submit" class="botao-concluir">Concluir</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Modal de Update -->
  <div class="modal fade branco" id="modalUpdate">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5 titulo">Alterar Assunto</h1>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form action="../back-end/update_assunto.php" method="post">
          <div class="modal-body">
            <input SIZE = 26 MAXLENGTH = 24 class ="nome-assunto" required name="tituloAtt" id="tituloAtt" type ="text" placeholder ="Título" aria-label ="Search">
            <input SIZE = 26 MAXLENGTH = 300 class ="descricao-assunto" name="resumoAtt" id="resumoAtt" type ="text" placeholder ="Descrição" aria-label ="Search">
            <input hidden name='idAssunto' id='idAssunto' type ='text'>
            <input hidden type="text" name="pagina" id="pagina" value="home.php">
          </div>

          <div class="modal-footer">
            <button name="atualizar" type="submit" class="botao-concluir">Concluir</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Modal de Delete -->
  <div class="modal fade branco" id="modalDelete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5 titulo">Deletar o Assunto:<p id="mostraTituloDel"></p></h1>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form action="../back-end/delete_assunto.php" method="post">
          <div class="modal-body">
            <div class="flex column center">
              <p>Tenha certeza antes de deletar seu assunto! Pois, todas as anotações dele também serão excluídas!</p>
              <input hidden name='idAssuntoDelelete' id='idAssuntoDelete' type ='text'>
              <input hidden type="text" name="pagina" id="pagina" value="home.php">

              <button name="deletarAssunto" type="submit" class="vermelho btn-delete-assunto center">Apagar Assunto</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
        <!-- Modal de Trocar senha -->
  <div class="modal fade branco" id="modalUpdateSenha">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5 titulo">Alterar Senha</h1>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form action="../back-end/troca_senha.php" method="POST">
            <input required SIZE = 26 MAXLENGTH = 52 class ="nome-assunto" name="senhaAntiga" type ="password" placeholder ="Senha Antiga">
            <input required SIZE = 26 MAXLENGTH = 52 class ="nome-assunto" name="senhaNova" type ="password" placeholder ="Senha Nova">
            <input required SIZE = 26 MAXLENGTH = 52 class ="nome-assunto" name="senhaNova2" type ="password" placeholder ="Confirmar Senha Nova">
            <input hidden type="text" name="pagina" id="pagina" value="home.php">
        </div>

            <div class="modal-footer">
              <button type="submit" class="botao-concluir">Alterar</button>
          </form>
            </div>

      </div>
    </div>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script>
      var divs = ["" <?php $id = $_SESSION['id'];$sqlTitulos = "SELECT * FROM assunto WHERE id_estudante_fk = $id";if($result = $conn -> query($sqlTitulos)){ while($assunto = $result -> fetch_object()){ printf(", '%s'", $assunto->titulo);}$result -> free_result();} ?>];
      
      var idDaEditAnterior = 0;
      var editAnteriormenteAberta = document.getElementById(`${idDaEditAnterior}`)
      
      function mostra(idDaEdit) {
        var edit = document.getElementById(`${idDaEdit}`);
        var editAnterior = document.getElementById(`${idDaEditAnterior}`);
        if(idDaEditAnterior != 0){
          editAnterior.style.display = "none";
        }
        edit.style.display = "flex";
        idDaEditAnterior = idDaEdit;
      }

      var modalConfiguracoes = document.querySelector(`#config`);
      var botaoAbreConfig = document.querySelector(`#abreModalConfig`);

      function fecharModal(modal){

        var fechaModal = document.querySelector(`#${modal}`);
        fechaModal.style.display = "none";

      }

      window.addEventListener('click', (event)=>{

        if(!modalConfiguracoes.contains(event.target)){
          fecharModal('config');
        }

      })

      botaoAbreConfig.addEventListener('click', (event)=>{
        
        event.stopPropagation();
        modalConfiguracoes.display.style = "flex"
        
      })

      function filtrar(){
        var inputDaSearch = document.querySelector("#inputDeSearch")
        var input = inputDaSearch.value.toLowerCase()
        
        for(i=1; i < divs.length; i++){
          valorId = divs[i]
          var string = `div[value='${valorId}']`
          var div = document.querySelector(string)
          if(valorId.toLowerCase().indexOf(input) > -1){
            div.style.display = "flex"
          } else {
            div.style.display = "none"
          }
        }
      }
      
      // Mostra e atualiza o modal de update
      var idAssunto = document.querySelector('#idAssunto');
      var titulo = document.querySelector('#tituloAtt');
      var resumo = document.querySelector('#resumoAtt');
      var botao = document.querySelector('#botao-magia')
      idAssunto.value = '<?php if(isset($_GET['mostraAtt'])){print $_GET['id_assunto'];} ?>'
      titulo.value = '<?php if(isset($_GET['mostraAtt'])){print $_GET['titulo-btn'];} ?>'
      resumo.value = '<?php if(isset($_GET['mostraAtt'])){print $_GET['resumo-btn'];} ?>'

      var navBar = document.querySelector('nav')

      // Mostra e atualiza o modal de delete
      var idAssuntoDel = document.querySelector('#idAssuntoDelete');
      var tituloDel = document.querySelector('#mostraTituloDel');
      var botaoMaravilha = document.querySelector('#botao-maravilha');

      tituloDel.innerHTML = "<?php if(isset($_GET['mostraDelete'])){print $_GET['tituloDel'];} ?>"
      idAssuntoDel.value = "<?php if(isset($_GET['mostraDelete'])){print $_GET['idAssuntoDel'];} ?>"

      <?php
      if(isset($_GET['mostraAtt'])){
        print 'botao.click();';
      }
      if(isset($_GET['mostraDelete'])){
        print 'botaoMaravilha.click();';
      }
      ?>
  </script>
    
</body>
</html>