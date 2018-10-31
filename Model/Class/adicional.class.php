<?php

require_once "conexao.class.php";

class Adicional {

    public $adicionalModel;
    public $con;

    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    
    function incluir(AdicionalModel $adicionalModel) {
        $this->adicionalModel = $adicionalModel;
        $colunas = "";
        $valores = "";
        foreach($this->adicionalModel as $key => $atr){
            if(empty($atr) || is_array($atr)){
                continue;
            } else {
                $colunas .= "$key,";
                $valores .= "'$atr',";
            }
        }
        $colunas = substr($colunas,0,-1);
        $valores = substr($valores,0,-1);
        $sql = "INSERT INTO adicional ($colunas) VALUES ($valores)";
        $retorno = $this->con->query($sql);
        $data = ['erro' => true];
        if($retorno){
            $data = ['erro' => false];
        }
        return $data;
    }

    function atualizar($adicionalModel) {
        $this->adicionalModel = $adicionalModel;
        $colunasValores = "";
        foreach($this->adicionalModel as $key => $atr){
            if(empty($atr) || is_array($atr)){
                continue;
            } else {
                $colunasValores .= "$key = '$atr',";
            }
        }
        $colunasValores = substr($colunasValores,0,-1);
        $sql = "UPDATE adicional SET $colunasValores WHERE id = {$this->adicionalModel->id}";
        $retorno = $this->con->query($sql);
        return $retorno ? ['erro' => false] : ['erro' => true];
    }

    function deletar($idUsuario, $ids) {
        $sql = "DELETE FROM adicional WHERE idUsuario = $idUsuario AND id in ($ids)";
        $retorno = $this->con->query($sql);
        return $retorno ? ['erro' => false] : ['erro' => true];
    }

    function buscarTodos($idUsuario) {
        $sql = "SELECT * FROM adicional WHERE idUsuario = {$idUsuario}";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];;
    }

    function buscar($idUsuario, $id) {
        $sql = "SELECT * FROM adicional WHERE idUsuario = {$idUsuario} AND id = {$id}";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];;
    }

    function listar($idUsuario, $pesquisa, $offset = '', $limit = '') {
        $sql = "SELECT id, descricao FROM adicional WHERE idUsuario = {$idUsuario} AND descricao LIKE '%{$pesquisa}%' ORDER BY id DESC LIMIT $offset, $limit";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];
    }
    
    function contagemListar($idUsuario, $pesquisa) {
        $sql = "SELECT count(*) as qnt FROM adicional WHERE idUsuario = {$idUsuario} AND descricao LIKE '%{$pesquisa}%'";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];
    }

}