<?php

require "vendor/autoload.php";

$usuario = '-seu-usuario-';
$senha = '-sua-senha-';

$sms = new \ByJG\WebService\Sms($usuario, $senha);
print_r($sms->obterVersao());
print_r($sms->recursos());

$cep = new \ByJG\WebService\Cep($usuario, $senha);
print_r($cep->obterVersao());
print_r($cep->obterLogradouro('01311000'));
print_r($cep->obterCEP('Avenida Paulista', 'Sao Paulo', 'SP'));
