<?php

require '../autoloader.php';

use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

$cliente = array(
    'nome'     => 'Nome do Cliente',
    'cnpj'     => 'CPF cliente',
    'endereco' => 'rua das manguinhas 174',
    'cep'      => '31956-651',
    'cidade'   => 'Belo Horizonte',
    'estado'   => 'MG',
);
$sacado = new Agente($cliente['nome'], $cliente['cnpj'], $cliente['endereco'], $cliente['cep'], $cliente['cidade'], $cliente['estado']);

$empresa = require_once '../empresa/financee/itau.php';
$cedente = new Agente($empresa['nome'], $empresa['cnpj'], $empresa['endereco'], $empresa['cep'], $empresa['cidade'], $empresa['estado']);

$boleto = new BancoDoBrasil(array(
    // Parâmetros obrigatórios
    'dataVencimento' => new DateTime('2013-01-24'),
    'valor'          => 23.00,
    'sequencial'     => $empresa['sequencial'],
    'sacado'         => $sacado,
    'cedente'        => $cedente,
    'agencia'        => $empresa['agencia'], // Até 4 dígitos
    'carteira'       => $empresa['carteira'],
    'conta'          => $empresa['conta'], // Até 8 dígitos
    'convenio'       => $empresa['convenio'], // 4, 6 ou 7 dígitos

    // Caso queira um número sequencial de 17 dígitos, a cobrança deverá:
    // - Ser sem registro (Carteiras 16 ou 17)
    // - Convênio com 6 dígitos
    // Para isso, defina a carteira como 21 (mesmo sabendo que ela é 16 ou 17, isso é uma regra do banco)
    // Parâmetros recomendáveis
    'logoPath'      => $empresa['logo'], // Logo da sua empresa
    'contaDv'       => $empresa['contaDv'],
    'agenciaDv'     => $empresa['agenciaDv'],
    'descricaoDemonstrativo' => array( // Até 5
        'Compra de materiais cosméticos',
        'Compra de alicate',
    ),
    'instrucoes' => array( // Até 8
        "Após o dia vencimento cobrar {$empresa['mora']} de mora e {$empresa['juros']} de juros ao dia.",
        'Não receber após o vencimento.',
    ),

    // Parâmetros opcionais
    //'resourcePath' => '../resources',
    'moeda'             => BancoDoBrasil::MOEDA_REAL,
    'dataDocumento'     => new DateTime(),
    'dataProcessamento' => new DateTime(),
    //'contraApresentacao' => true,
    //'pagamentoMinimo' => 23.00,
    //'aceite' => 'N',
    //'especieDoc' => 'ABC',
    //'numeroDocumento' => '123.456.789',
    //'usoBanco' => 'Uso banco',
    //'layout' => 'layout.phtml',
    //'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
    //'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
    //'descontosAbatimentos' => 123.12,
    //'moraMulta' => 123.12,
    //'outrasDeducoes' => 123.12,
    //'outrosAcrescimos' => 123.12,
    'valorCobrado' => 123.12,
    //'valorUnitario' => 123.12,
    //'quantidade' => 1,
));

echo $boleto->getOutput();
