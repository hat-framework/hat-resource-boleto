<?php

class boletoResource extends \classes\Interfaces\resource{
        
   /**
    * @uses Contém a instância do banco de dados
    */
    private static $instance = NULL;
    public static function getInstanceOf(){
        $class_name = __CLASS__;
        $obj = new $class_name();
        return $obj;
    }
    
    public function set($key, $valor) {
        $this->dados[$key] = $valor;
        return $this;
    }
    
    public function send(){
        $url = URL_RESOURCES . "boleto/src/index.php";
        die(simple_curl($url,$this->dados));
    }
    
}
