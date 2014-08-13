<?php

use OpenBoleto\Agente;
class ClienteCapture extends Capture{
    public static function capturar($post) {
        self::$keys = self::getKeys();
        $out = parent::capturar($post);
        if(!isset($out['nome']) || !isset($out['cnpj']) || !isset($out['endereco']) || !isset($out['cep']) || !isset($out['cidade']) || !isset($out['estado']))
            die("Informe todos os dados do cliente: nome, cnpj, endereco, cep, cidade, estado");
        $out['sacado'] = new Agente($out['nome'], $out['cnpj'], $out['endereco'], $out['cep'], $out['cidade'], $out['estado']);
        return $out;
    }
    
    public static function getKeys(){
        return array(
            'cod_usuario' => 'codigoCliente', 'nome' => 'nome', 'cnpj' => 'cnpj', 'cpf' => 'cnpj', 
            'endereco' => 'endereco', 'cep' => 'cep', 'cidade' => 'cidade', 'uf' => 'estado'
        );
    }
}