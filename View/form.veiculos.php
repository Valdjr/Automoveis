<?php
require_once "menu.php";
?>

<div class="container mt-3">
    <h3 class="mb-3">Veículos</h3>
    <div class="row">
      <div class="col-4">
        <a class="btn btn-outline-dark" href="form.veiculo.php">Incluir</a>
        <a class="btn btn-outline-dark" href="#" onclick="alterar()">Alterar</a>
        <a class="btn btn-outline-danger" href="#" onclick="excluir()">Excluir</a>
      </div>
      <div class="col-8">
        <form onsubmit="pesquisar(); return false;">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" title="Por padrão a pesquisa é definida para o campo Descrição, mas também é possível pesquisar especificamente por algum campo, tente utilizar 'placa:abc'."><i class="far fa-question-circle"></i></span>
            </div>
            <input type="text" class="form-control" id="input_search" placeholder="Golf">
            <div class="input-group-append">
              <button class="btn btn-outline-dark" type="submit" id="button_search"><i class="fas fa-search"></i> Pesquisar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div id="msg" style="display: none;" class="alert mt-3 mb-3"></div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div id="conteudo"></div>
      </div>
    </div>
    <div class="row mt-3" id="paginacao" style="display: none;">
      <div class="col" style="text-align: center;">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-outline-dark" onclick="anterior()">Anterior</button>
          <button type="button" class="btn btn-outline-dark" id="paginaAtual"></button>
          <button type="button" class="btn btn-outline-dark" onclick="proxima()">Próxima</button>
        </div>
      </div>
    </div>
</div>

<?php
require_once "rodape.php";
?>
<script src="form.veiculos.js"></script>