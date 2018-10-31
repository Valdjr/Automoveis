<?php

header('Content-Type: application/json');
require_once "../Model/Class/adicional.class.php";
require_once "../Model/Model/adicional.model.php";
session_start();

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$adicional = new Adicional;
$adicionalModel = new AdicionalModel;

$adicionalModel->id = isset($_POST['id']) ? $_POST['id'] : '';
$adicionalModel->idUsuario = $_SESSION['idUsuario'];
$adicionalModel->descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';



if ($acao == 'incluir') {
    
    $data = $adicional->incluir($adicionalModel);
    echo json_encode($data);
    
} else if ($acao == 'buscar') {
    
    $data = $adicional->buscar($adicionalModel->idUsuario, $adicionalModel->id);
    echo json_encode($data);
    
} else if ($acao == 'alterar') {
    
    $data = $adicional->atualizar($adicionalModel);
    echo json_encode($data);
    
} else if ($acao == 'excluir') {
    
    $ids = isset($_POST['ids']) ? $_POST['ids'] : '';
    $data = $adicional->deletar($adicionalModel->idUsuario, $ids);
    echo json_encode($data);
    
} else if ($acao == 'listar') {
    
    $pagina = isset($_POST['pagina']) ? intval($_POST['pagina']) : 1;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';


    $retorno = $adicional->contagemListar($adicionalModel->idUsuario, $pesquisa);
    if(!$retorno['erro']) {
        $total = $retorno['dados'][0]['qnt'];
        $paginas = ceil($total / $limit);
        $pagina = $pagina < 0 ? 1 : $pagina;
        $pagina = $pagina > $paginas ? $paginas : $pagina;
    }
    $offset = ($pagina - 1) * $limit;
    $offset = $offset < 0 ? 0 : $offset;
    
    $data = $adicional->listar($adicionalModel->idUsuario, $pesquisa, $offset, $limit);
    $data['pagina'] = $pagina;
    $data['total'] = $total;
    echo json_encode($data);

} else {
    echo json_encode(['erro' => true, 'msg' => 'Ação não definida']);
}