<?php

header('Content-Type: application/json');
require_once "../Model/Class/marca.class.php";
require_once "../Model/Model/marca.model.php";
session_start();

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$marca = new Marca;
$marcaModel = new MarcaModel;

$marcaModel->id = isset($_POST['id']) ? $_POST['id'] : '';
$marcaModel->idUsuario = $_SESSION['idUsuario'];
$marcaModel->descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';


if ($acao == 'incluir') {
    
    $data = $marca->incluir($marcaModel);
    echo json_encode($data);
    
} else if ($acao == 'buscar') {
    
    $data = $marca->buscar($marcaModel->idUsuario, $marcaModel->id);
    echo json_encode($data);
    
} else if ($acao == 'alterar') {
    
    $data = $marca->atualizar($marcaModel);
    echo json_encode($data);
    
} else if ($acao == 'excluir') {

    $ids = isset($_POST['ids']) ? $_POST['ids'] : '';
    $data = $marca->deletar($marcaModel->idUsuario, $ids);
    echo json_encode($data);

} else if ($acao == 'listar') {

    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

    $limit = 10;

    $retorno = $marca->contagemListar($marcaModel->idUsuario, $pesquisa);
    if(!$retorno['erro']) {
        $total = $retorno['dados'][0]['qnt'];
        $paginas = ceil($total / $limit);
        $pagina = $pagina < 0 ? 1 : $pagina;
        $pagina = $pagina > $paginas ? $paginas : $pagina;
    }
    $offset = ($pagina - 1) * $limit;
    $offset = $offset < 0 ? 0 : $offset;

    $data = $marca->listar($marcaModel->idUsuario, $pesquisa, $offset, $limit);
    $data['pagina'] = $pagina;
    $data['total'] = $total;
    echo json_encode($data);

} else {
    echo json_encode(['erro' => true, 'msg' => 'Ação não definida']);
}