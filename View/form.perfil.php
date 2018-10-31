<?php
require_once "menu.php";
session_start();
$usuario = $_SESSION['usuario'];
?>

<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <h3 class="mt-3 mb-3">Perfil</h3>
      <form id="form" onsubmit="alterar(); return false;">
          <div class="form-group">
            <label for="descricao">Novo Usuário*</label>
            <input required type="text" class="form-control" id="novoUsuario" name="novoUsuario" required>
          </div>
          <div class="form-group">
            <label for="descricao">Nova Senha*</label>
            <div class="input-group">
              <input required type="password" class="form-control" id="novaSenha" name="novaSenha" required>
              <div class="input-group-append">
                <span class="input-group-text" onclick="mostarOcultarSenha($('#novaSenha'))"><i class="far fa-eye"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="descricao">Usuário Atual</label>
            <input required type="text" class="form-control" value="<?=$usuario?>" disabled>
          </div>
          <div class="form-group">
            <label for="descricao">Senha Atual*</label>
            <div class="input-group">
              <input required type="password" class="form-control" id="senha" name="senha" required>
              <div class="input-group-append">
                <span class="input-group-text" onclick="mostarOcultarSenha($('#senha'))"><i class="far fa-eye"></i></span>
              </div>
            </div>
          </div>
          <div class="alert alert-danger" id="msg" style="display:none;"></div>
          <input type="submit" class="btn btn-success" value="Salvar">
          <a class="btn btn-secondary" onclick="window.location.href='home.php'" href="#">Cancelar</a>
        </form>
    </div>
      <div class="col-md-2"></div>
    </div>
</div>
<?php
require_once "rodape.php";
?>
<script src="login.js"></script>