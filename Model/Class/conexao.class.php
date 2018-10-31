<?php

class Conexao {

    private static $con;
    private static $obj;

    static function getInstance() {
        if(self::$con == null) {
            self::$obj = new Conexao;
        }
        //caso queira metodos customizados retornar self::$obj em vez de self::$con
        return self::$con;
    }

    private function __construct() {
        self::$con = new mysqli('127.0.0.1','testephp','asdf000','veiculos');
    }

}