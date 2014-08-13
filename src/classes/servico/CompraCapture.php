<?php

class CompraCapture extends Capture{
    public static function capturar($post) {
        self::$keys = self::getKeys();
        $out = parent::capturar($post);
        if(isset($out['dataVencimento']))        $out['dataVencimento']         = new DateTime($out['dataVencimento']);
        $out['dataProcessamento'] = new DateTime();
        if(!isset($out['numeroDocumento']) || !isset($out['valor']) || !isset($out['dataVencimento']) || !isset($out['descricaoDemonstrativo']))
                die("Informe os dados da compra: doc, valor, vencimento, descricao, mora(opcional)");
        if(isset($out['descricaoDemonstrativo']))$out['descricaoDemonstrativo'] = explode(";", $out['descricaoDemonstrativo']);
        $out['sequencial'] = $out['numeroDocumento'];
        return $out;
    }
    
    public static function getKeys(){
        return array(
            'doc' => 'numeroDocumento', 'valor' => 'valor', 'vencimento' => 'dataVencimento', 
            'descricao' => 'descricaoDemonstrativo', 'mora' => 'mora', 
        );
    }
}