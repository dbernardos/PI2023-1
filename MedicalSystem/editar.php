<?php
include('protect.php');

require_once 'conexao.php';

// Verificar se foi fornecido um valor para 'relato_id'
if (isset($_GET['relato_id'])) {
  $relato_id = mysqli_real_escape_string($conexao, $_GET['relato_id']);

  // Obter as informações do relato específico usando uma declaração preparada
  $sql = "SELECT * FROM relato WHERE idR = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $relato_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Verificar se o relato foi encontrado
  if ($row) {
    $altura = $row["altura"];
    $peso = $row["peso"];
    $idade = $row["idade"];
    $sexo = $row["sexo"];
    $dataR = $row["dataR"];
    $titulo = $row["titulo"];
    $relato = $row["relatoD"];
    $observacao = $row["observacao"];
    $usuario_id = $row["doctor_id"];

    // Obter o nome do usuário usando uma declaração preparada
    if (isset($usuario_id)) {
      $sql = "SELECT * FROM usuario WHERE id = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row_usuario = $result->fetch_assoc();
      $nome = $row_usuario["nome"];
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>MedicalSystem</title>
  <link rel="icon" href="./img/M4.png" type="image/x-icon">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
  <link rel="stylesheet" type="text/css" href="./css/editar.css">
  <script src='./js/bootstrap.bundle.js'></script>
</head>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./meusRelatos.php">MedicalSystem</a>
    </nav>
</header>

<body style="background-color: #f5f5f5;">
  <div style="margin-top: 4%;">
    <div class="container backgroundR">
      <h1>Editar Relato</h1>
      <form method="POST" action="salvar_edicao.php">
        <div class="mb-3">
          <label for="altura" class="form-label">Altura</label>
          <input type="text" class="form-control" id="altura" name="altura" value="<?php echo $altura; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" required>
        </div>

        <div class="mb-3">
          <label for="peso" class="form-label">Peso</label>
          <input type="text" class="form-control" id="peso" name="peso" value="<?php echo $peso; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" required>
        </div>
        <div class="mb-3">
          <label for="idade" class="form-label">Idade</label>
          <input type="number" class="form-control" id="idade" name="idade" value="<?php echo $idade; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
        </div>

        <div class="mb-3">
          <label for="sexo" class="form-label">Sexo</label>
          <select class="form-select" id="sexo" name="sexo" required>
            <option value="Masculino" <?php if ($sexo === 'Masculino') echo 'selected'; ?>>Masculino</option>
            <option value="Feminino" <?php if ($sexo === 'Feminino') echo 'selected'; ?>>Feminino</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="titulo" class="form-label">Título</label>
          <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
        </div>
        <div class="mb-3">
          <label for="observacao" class="form-label">Observação</label>
          <textarea class="form-control" id="observacao" name="observacao" rows="6" style="resize: vertical; max-height: 6em; overflow-y: auto;" required><?php echo $observacao; ?></textarea>
        </div>

        <div class="mb-3">
          <label for="relato" class="form-label">Relato</label>
          <textarea class="form-control" id="relato" name="relato" rows="8" style="resize: vertical; max-height: 14em; overflow-y: auto;" required><?php echo $relato; ?></textarea>
        </div>

        <input type="hidden" name="relato_id" value="<?php echo $relato_id; ?>">
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Salvar mudanças</button>
          <form method="POST" action="eliminar_publicacao.php">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="margin-top: 10px;">Eliminar publicacão</button>
          </form>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Tem certeza que deseja apagar está publicação?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

          <form method="POST" action="eliminar_publicacao.php">
            <input type="hidden" name="relato_id" value="<?php echo $relato_id; ?>">
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="./js/feather.mim.js"></script>
<script type="text/javascript" src="./js/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="./js/menu.js"></script>
</html>
