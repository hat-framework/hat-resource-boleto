<?php

abstract class Capture{
    public static $keys;
    public static function capturar($post){
        $out = array();
        if(empty(self::$keys)) die("Chaves de captura dos dados não configurada na classe: " . get_called_class());
        if(empty($post)) return array();
        foreach (self::$keys as $keyname => $keydst){
            if(!isset($post[$keyname])) continue;
            $out[$keydst] = $post[$keyname];
        }
        return $out;
    }
    
    abstract public static function getKeys();
}

