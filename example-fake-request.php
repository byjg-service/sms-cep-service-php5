<?php

use ByJG\WebService\FakeSender;

require "vendor/autoload.php";

$sender = new FakeSender();

$sms = new \ByJG\WebService\Sms($sender);
print_r($sms->obterVersao());
print_r($sms->recursos());
print_r($sms->enviarSMS('11', '999999999', 'Teste de SMS'));

$cep = new \ByJG\WebService\Cep($sender);
print_r($cep->obterVersao());
print_r($cep->obterLogradouro('01311000'));
print_r($cep->obterCEP('Avenida Paulista', 'Sao Paulo', 'SP'));
