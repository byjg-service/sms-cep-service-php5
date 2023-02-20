<?php

use ByJG\WebService\HttpSender;

require "vendor/autoload.php";

$usuario = '-seu-usuario-';
$senha = '-sua-senha-';

$sender = new HttpSender($usuario, $senha);

$sms = new \ByJG\WebService\Sms($sender);
print_r($sms->obterVersao());
print_r($sms->recursos());
print_r($sms->enviarSMS('11', '999999999', 'Teste de SMS'));

$cep = new \ByJG\WebService\Cep($sender);
print_r($cep->obterVersao());
print_r($cep->obterLogradouro('01311000'));
print_r($cep->obterCEP('Avenida Paulista', 'Sao Paulo', 'SP'));
