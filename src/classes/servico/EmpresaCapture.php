<?php

use OpenBoleto\Agente;
class EmpresaCapture extends Capture{
    public static function capturar($post) {
        self::$keys = self::getKeys();
        if(!isset($post['empresa'])) die("Informe o nome da empresa");
        $file = DIR . "/empresa/{$post['empresa']}/{$post['empresa']}.php";
        if(!file_exists($file)) die("empresa {$post['empresa']} não configurada no sistema");
        $empresa           = require $file;
        $empresa['cedente'] = new Agente($empresa['nome'], $empresa['cnpj'], $empresa['endereco'], $empresa['cep'], $empresa['cidade'], $empresa['estado']);
        return $empresa;
    }
    
    public static function getKeys(){
        return array();
    }
}
