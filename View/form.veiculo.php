<?php
require_once "menu.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<div class="container">
  <h3 class="mt-3 mb-3">Veículos</h3>
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
              <input required type="text" class="form-control" id="descricao" name="descricao" placeholder="Golf GTI">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="placa">Placa*</label>
                <input required type="text" class="form-control" id="placa" name="placa" placeholder="abc1234">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="codigoRenavam">Código RENAVAM*</label>
                <input required type="text" class="form-control" id="codigoRenavam" name="codigoRenavam" placeholder="12312312312" > 
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
              <label for="anoModelo">Ano modelo*</label>
              <input required type="number" class="form-control" id="anoModelo" name="anoModelo" placeholder="2019">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
              <label for="anoFabriacao">Ano fabricação*</label>
              <input required type="number" class="form-control" id="anoFabricacao" name="anoFabricacao" placeholder="2018">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
              <label for="cor">Cor*</label>
              <input required type="text" class="form-control" id="cor" name="cor" placeholder="Preto">
          </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="km">KM*</label>
                <input required type="text" class="form-control" id="km" name="km" placeholder="60000">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="marca">Marca</label>
                <select type="text" class="form-control" id="marca" name="marca">
                  <option value="">Selecione</option>
                </select>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col">
          <div class="form-group">
            <label for="preco">Preço*</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input required type="number" class="form-control" id="preco" name="preco" placeholder="150000">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="precoFipe">Preço FIPE*</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input required type="number" class="form-control" id="precoFipe" name="precoFipe" placeholder="145000">
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <div id="adicional"></div>
        </div>
      </div>
      <div class="alert alert-danger" id="msg" style="display:none;"></div>
      <input type="submit" class="btn btn-success" value="Salvar">
      <a class="btn btn-secondary" onclick="window.location.href='form.veiculos.php'" href="#">Cancelar</a>
      </form>
    </div>
</div>

<?php
require_once "rodape.php";
?>
<script src="form.veiculo.js"></script>