<?php

require_once "conexao.class.php";

class Usuario {

    public $usuarioModel;
    public $con;

    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    public function salvar(UsuarioModel $usuarioModel) {

        $ret = $this->con->query("SELECT * FROM usuario WHERE usuario = '{$usuarioModel->usuario}'");
        $data = ['erro' => true];
        if ($ret->num_rows == 0) {
            $usuarioModel->senha = password_hash($usuarioModel->senha, PASSWORD_BCRYPT);
            $res = $this->con->query("INSERT INTO usuario (usuario, senha) VALUES ('{$usuarioModel->usuario}', '{$usuarioModel->senha}')");
            if ($res) {
                $_SESSION['usuario'] = $usuarioModel->usuario;
                $_SESSION['idUsuario'] = $this->con->insert_id;
                $data = ['erro' => false];
            }
        } else {
            $data = ['erro' => true, 'msg' => 'Usuário já cadastrado!'];
        }
        return $data;
    }

    public function alterar(UsuarioModel $usuarioModel, $novoUsuario, $novaSenha) {
        $login = $this->login($usuarioModel);
        $data = ['erro' => true, 'msg' => 'Senha atual incorreta!', 'campo' => 'senhaAtual'];
        if(!$login['erro']){
            $ret = $this->con->query("SELECT * FROM usuario WHERE usuario = '{$novoUsuario}'");
            if ($ret->num_rows == 0) {
                $novaSenha = password_hash($novaSenha, PASSWORD_BCRYPT);
                $res = $this->con->query("UPDATE usuario SET usuario = '{$novoUsuario}', senha = '{$novaSenha}' WHERE id = {$usuarioModel->id}");
                if ($res) {
                    unset($_SESSION['usuario']);
                    unset($_SESSION['idUsuario']);
                    $_SESSION['usuario'] = $novoUsuario;
                    $_SESSION['idUsuario'] = $this->con->insert_id;
                    $data = ['erro' => false];
                }
            } else {
                $data = ['erro' => true, 'msg' => 'Novo usuário já está cadastrado!', 'campo' => 'novoUsuario'];
            }
        }
        return $data;
    }

    public function login(UsuarioModel $usuarioModel) {
        $res = $this->con->query("SELECT * FROM usuario WHERE usuario = '{$usuarioModel->usuario}'");
        $data = ['erro' => true];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                if (password_verify($usuarioModel->senha, $row['senha'])) {
                    session_start();
                    $_SESSION['usuario'] = $usuarioModel->usuario;
                    $_SESSION['idUsuario'] = $row['id'];
                    $data = ['erro' => false];
                    break;
                }
            }
        }
        return $data;
    }

}
