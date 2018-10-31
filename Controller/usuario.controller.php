<?php


header('Content-Type: application/json');
require_once "../Model/Class/usuario.class.php";
require_once "../Model/Model/usuario.model.php";
session_start();

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
$usuario = new Usuario;
$usuarioModel = new UsuarioModel;

$user = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$pass = isset($_POST['senha']) ? $_POST['senha'] : '';
$usuarioModel->usuario = $user;
$usuarioModel->senha = $pass;
$usuarioModel->id = $_SESSION['idUsuario'];


if ($acao == 'cadastrar') {
    
    $data = $usuario->salvar($usuarioModel);
    echo json_encode($data);
    
} else if ($acao == 'entrar') {
    
    $data = $usuario->login($usuarioModel);
    echo json_encode($data);
    
} else if ($acao == 'alterar') {
    
    $novoUsuario = isset($_POST['novoUsuario']) ? $_POST['novoUsuario'] : '';
    $novaSenha = isset($_POST['novaSenha']) ? $_POST['novaSenha'] : '';
    $usuarioModel->id = $_SESSION['idUsuario'];
    $usuarioModel->usuario = $_SESSION['usuario'];
    
    $data = $usuario->alterar($usuarioModel, $novoUsuario, $novaSenha);
    echo json_encode($data);

} else if ($acao == 'sair') {
    unset($_SESSION['usuario']);
    session_destroy();
}