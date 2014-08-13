<?php

class BancoCapture extends Capture{   
    public static function capturar($post) {
        if(!isset($post['empresa'])) die("Informe o nome da empresa");
        if(!isset($post['banco']))   die("Informe o nome do banco da empresa");
        $file = "empresa/{$post['empresa']}/bancos/{$post['banco']}.php";
        if(!file_exists($file)){
            $f2 = "empresa/{$post['empresa']}/{$post['empresa']}.php";
            if(!file_exists($file)){
                die("Empresa {$post['empresa']} não está registrada no sistema");
            }
            die("A Empresa {$post['empresa']} não possui o banco {$post['banco']} configurado");
        }
        return require_once "empresa/{$post['empresa']}/bancos/{$post['banco']}.php";
    }
    
    public static function getKeys(){
        return array();
    }
}