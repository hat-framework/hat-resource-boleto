<?php

define("DIR", __DIR__);
require_once './openboleto/autoloader.php';
require_once './servico/autoload.php';


use OpenBoleto\Agente;
$get       = $_POST;
$post      = $_POST;
$cliente   = ClienteCapture::capturar($post);
$empresa   = EmpresaCapture::capturar($get);
$compra    = CompraCapture::capturar($post);
$dadoBanco = BancoCapture::capturar($get);
$dados     = array_merge($empresa, $cliente, $compra, $dadoBanco);
$class                   = "OpenBoleto\Banco\Itau";
try{
    $boleto       = new $class($dados);
    echo $boleto->getOutput();
} catch (Exception $ex) {
    die($ex->getMessage());
}
