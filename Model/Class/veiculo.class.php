<?php

require_once "conexao.class.php";

class Veiculo {

    public $veiculoModel;
    public $con;

    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    
    function incluir(VeiculoModel $veiculoModel) {
        $this->veiculoModel = $veiculoModel;
        $colunas = "";
        $valores = "";
        foreach($this->veiculoModel as $key => $atr){
            if(empty($atr) || is_array($atr)){
                continue;
            } else {
                $colunas .= "$key,";
                $valores .= "'$atr',";
            }
        }
        $colunas = substr($colunas,0,-1);
        $valores = substr($valores,0,-1);
        $sql = "INSERT INTO veiculo ($colunas) VALUES ($valores)";
        $retorno = $this->con->query($sql);
        $data = ['erro' => true];
        if($retorno){
            $data = ['erro' => false];
            $this->veiculoModel->id = $this->con->insert_id;
        }
        return $data;
    }

    function atualizar($veiculoModel) {
        $this->veiculoModel = $veiculoModel;
        $colunasValores = "";
        foreach($this->veiculoModel as $key => $atr){
            if(empty($atr) || is_array($atr)){
                continue;
            } else {
                $colunasValores .= "$key = '$atr',";
            }
        }
        $colunasValores = substr($colunasValores,0,-1);
        $sql = "UPDATE veiculo SET $colunasValores WHERE id = {$this->veiculoModel->id}";
        $retorno = $this->con->query($sql);
        return $retorno ? ['erro' => false] : ['erro' => true];
    }
    
    function deletar($idUsuario, $ids) {
        $sql = "DELETE FROM veiculo WHERE idUsuario = $idUsuario AND id in ($ids)";
        $retorno = $this->con->query($sql);
        return $retorno ? ['erro' => false] : ['erro' => true];
    }
    
    function deleterAdicionais($id) {
        $sql = "DELETE FROM veiculo_adicional WHERE idVeiculo = $id";
        $this->con->query($sql);
    }
    
    function adicionarAdicionais($idVeiculo, $idAdicional) {
        $sql = "INSERT INTO veiculo_adicional (idVeiculo, idAdicional) VALUES ({$idVeiculo}, {$idAdicional})";
        $this->con->query($sql);
    }

    function obterAdicionais($id){
        $sql = "SELECT * FROM veiculo_adicional WHERE idVeiculo = {$id}";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];;
    }

    function buscarTodos($idUsuario) {
        $sql = "SELECT * FROM veiculo WHERE idUsuario = {$idUsuario}";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];;
    }

    function buscar($idUsuario, $id) {
        $sql = "SELECT * FROM veiculo WHERE idUsuario = {$idUsuario} AND id = {$id}";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];;
    }

    function listar($idUsuario, $pesquisa, $offset, $limit) {
        $pesquisaAux = explode(':',$pesquisa);
        if(count($pesquisaAux) > 1) {
            $campo = $pesquisaAux[0];
            $valor = "'%".$pesquisaAux[1]."%'";
        } else {
            $campo = 'descricao';
            $valor = "'%{$pesquisa}%'";
        }
        $sql = "SELECT id, descricao, marca, placa FROM veiculo WHERE idUsuario = {$idUsuario} AND $campo LIKE $valor LIMIT $offset, $limit";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];
    }

    function contagemListar($idUsuario, $pesquisa) {
        $sql = "SELECT count(*) as qnt FROM veiculo WHERE idUsuario = {$idUsuario} AND descricao LIKE '%{$pesquisa}%'";
        $retorno = $this->con->query($sql);
        $dados = [];
        while($obj = $retorno->fetch_assoc()){
            $dados[] = $obj;
        }
        return $retorno ? ['erro' => false, 'dados' => $dados] : ['erro' => true];
    }

}