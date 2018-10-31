<?php

header('Content-Type: application/json');
require_once "../Model/Class/veiculo.class.php";
require_once "../Model/Model/veiculo.model.php";
session_start();

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$veiculo = new Veiculo;
$veiculoModel = new VeiculoModel;

$veiculoModel->id = isset($_POST['id']) ? $_POST['id'] : '';
$veiculoModel->idUsuario = $_SESSION['idUsuario'];
$veiculoModel->descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$veiculoModel->placa = isset($_POST['placa']) ? $_POST['placa'] : '';
$veiculoModel->codigoRenavam = isset($_POST['codigoRenavam']) ? $_POST['codigoRenavam'] : '';
$veiculoModel->anoModelo = isset($_POST['anoModelo']) ? $_POST['anoModelo'] : '';
$veiculoModel->anoFabricacao = isset($_POST['anoFabricacao']) ? $_POST['anoFabricacao'] : '';
$veiculoModel->cor = isset($_POST['cor']) ? $_POST['cor'] : '';
$veiculoModel->km = isset($_POST['km']) ? $_POST['km'] : '';
$veiculoModel->marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$veiculoModel->preco = isset($_POST['preco']) ? $_POST['preco'] : '';
$veiculoModel->precoFipe = isset($_POST['precoFipe']) ? $_POST['precoFipe'] : '';
$adicionais = isset($_POST['adicional']) ? $_POST['adicional'] : '';

if ($acao == 'incluir') {

    $data = $veiculo->incluir($veiculoModel);
    foreach($adicionais as $adc) {
        $veiculo->adicionarAdicionais($veiculo->veiculoModel->id, $adc);
    }
    echo json_encode($data);
    
} else if ($acao == 'buscar') {
    
    $data = $veiculo->buscar($veiculoModel->idUsuario, $veiculoModel->id);
    echo json_encode($data);
    
} else if ($acao == 'alterar') {
    
    $veiculo->deleterAdicionais($veiculoModel->id);
    foreach($adicionais as $adc) {
        $veiculo->adicionarAdicionais($veiculoModel->id, $adc);
    }
    $data = $veiculo->atualizar($veiculoModel);
    echo json_encode($data);
    
} else if ($acao == 'excluir') {

    $ids = isset($_POST['ids']) ? $_POST['ids'] : '';
    $data = $veiculo->deletar($veiculoModel->idUsuario, $ids);
    echo json_encode($data);
    
} else if ($acao == 'listar') {
    
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

    $limit = 10;

    $retorno = $veiculo->contagemListar($veiculoModel->idUsuario, $pesquisa);
    if(!$retorno['erro']) {
        $total = $retorno['dados'][0]['qnt'];
        $paginas = ceil($total / $limit);
    }
    $pagina = $pagina > $paginas ? $paginas : $pagina;
    $pagina = $pagina < 1 ? 1 : $pagina;
    $offset = ($pagina - 1) * $limit;
    $offset = $offset < 0 ? 0 : $offset;

    $data = $veiculo->listar($veiculoModel->idUsuario, $pesquisa, $offset, $limit);
    $data['pagina'] = $pagina;
    $data['total'] = $total;
    echo json_encode($data);

} else if ($acao == 'obterAdicionais') {

    $data = $veiculo->obterAdicionais($veiculoModel->id);
    echo json_encode($data);

} else {
    echo json_encode(['erro' => true, 'msg' => 'Ação não definida']);
}