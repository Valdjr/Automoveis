<?php
require_once "menu.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<div class="container">
    <h3 class="mt-3 mb-3">Marcas</h3>
    <form id="form" onsubmit="salvar(); return false;">
    <div class="row">
      <div class="col">
        <small class="form-text text-muted float-right">(*) Campos obrigatórios</small><br>
        <input type="hidden" value="<?= empty($id) ? '' : $id; ?>" name="id" id="id">
      </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
            <label for="descricao">Descrição*</label>
            <input required type="text" class="form-control" id="descricao" name="descricao" placeholder="Ford">
            </div>
        </div>
    </div>
    <div class="alert alert-danger" id="msg" style="display:none;"></div>
    <input type="submit" class="btn btn-success" value="Salvar">
    <a class="btn btn-secondary" onclick="window.location.href='form.marcas.php'" href="#">Cancelar</a>
    </form>
</div>


<?php
require_once "rodape.php";
?>
<script src="form.marca.js"></script>