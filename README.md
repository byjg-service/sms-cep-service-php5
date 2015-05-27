[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/byjg/sms-cep-service-php5/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/byjg/sms-cep-service-php5/?branch=master)
[![Codacy Badge](https://www.codacy.com/project/badge/b983ca33369e43ebb85bc24496b03b69)](https://www.codacy.com/app/joao/sms-cep-service-php5)

byjg-service-examples
=====================

Aqui você encontrará vários exemplos de implementação dos serviços ByJG em diversas linguagens. 

Os Serviços ByJG públicos são
+ SMS - Serviço de envio de SMS por Web Service
+ CEP - Serviço de consulta de CEPs Brasileitos por Web Service

Endereços:
+ Site Principal: http://www.byjg.com.br/
+ SMS Service: http://www.byjg.com.br/site/xmlnuke.php?xml=smswebservice
+ CEP Service: http://www.byjg.com.br/site/xmlnuke.php?xml=onlinecep
+ App Facebook: http://www.smswebservice.com.br/

O repositório com os exemplos é público e quem quiser ter acesso para incluir modificações basta se cadastrar no site e solicitar o acesso através do contato. 

## Instalando

Para instalar use o composer na sua pasta de projeto:

```
composer require byjg/sms-cep-service-php5
```

## SMS: Exemplos de utilização:

```php
require "vendor/autoload.php";

// Crie o seu usuário e senha no site:
// http://www.byjg.com.br/
$usuario = 'NOMEUSUARIO';
$senha = 'SENHA';

// Enviar um SMS
$sms = new \ByJG\WebService\Sms($usuario, $senha);
$retorno = $sms->enviarSms('21', '999991234', 'Mensagem do SMS');

/***
O Retorno será um array no seguinte formato:

Array
(
	[status] => 'OK'
	[raw] => 'OK|0, Delivery'
	[data] => Array
		(
			[code] => '0'
			[info] => 'Delivery'
		)
)
*/
```

## CEP: Exemplos de utilização:

```php
require "vendor/autoload.php";

// Crie o seu usuário e senha no site:
// http://www.byjg.com.br/
$usuario = 'NOMEUSUARIO';
$senha = 'SENHA';

// Obter o Logradouro à partir do CEP
$cep = new \ByJG\WebService\Cep($usuario, $senha);
$retorno = $cep->obterLogradouro('01311000');

/***
O Retorno será um array no seguinte formato:

Array
(
    [status] => OK
    [raw] => OK|Avenida Paulista - até 609 - lado ímpar, Bela Vista, São Paulo, SP, 3550308
    [data] => Array
        (
            [code] => 0
            [info] => Array
                (
                    [logradouro] => Avenida Paulista - até 609 - lado ímpar
                    [bairro] => Bela Vista
                    [cidade] => São Paulo
                    [uf] => SP
                    [ibge] => 3550308
                )

        )

)
*/

// Obter o CEP à partir do Logradouro
$retorno = $cep->obterCEP('Avenida Paulista', 'Sao Paulo', 'SP');

/***
O Retorno será algo deste tipo (os itens foram cortados):

Array
(
    [status] => OK
    [raw] => OK|40|01311000, Avenida Paulista - até 609 - lado ímpar, Bela Vista, São Paulo, SP, 3550308|01310000, Avenida Paulista - até 610 - lado par, Bela Vista, São Paulo, SP, 3550308|...
    [data] => Array
        (
            [code] => 0
            [info] => Array
                (
                    [0] => Array
                        (
                            [logradouro] => Avenida Paulista - até 609 - lado ímpar
                            [bairro] => Bela Vista
                            [cidade] => São Paulo
                            [uf] => SP
                            [ibge] => 3550308
                            [cep] => 01311000
                        )

                    [1] => Array
                        (
                            [logradouro] => Avenida Paulista - até 610 - lado par
                            [bairro] => Bela Vista
                            [cidade] => São Paulo
                            [uf] => SP
                            [ibge] => 3550308
                            [cep] => 01310000
                        )

                )

        )

)

*/
```


## Outros Repositórios

### CSharp 

+ CEP + WebService
+ CEP + Post - Exemplo cedido gentilmento por Vitor Leal
+ SMS

### Delphi

+ CEP Example 1 - Exemplo cedido gentilmente por David Mengarda
+ CEP Example 2 (cód IBGE) - Exemplo cedido gentilmente por Andrea Kimura
+ SMS - Exemplo cedido gentilmente por Jonas Pneus, Gravataí / RS

### FoxPro

+ CEP - Exemplo cedido gentilmente por Graciano Santos Duarte

### HTML

+ CEP
+ CEP+JS

### Java

+ SMS
+ CEP

### Joomla

+ CEP - Exemplo cedido gentilmente por Ricardo Lima Caratti do Livro: "Joomla Avançado"
+ SMS - Exemplo cedido gentilmente pela Pixxis

### Objective C (IPhone)

+ CEP - Exemplo cedido gentilmente por Ricardo Lima Caratti do Livro: "Joomla Avançado 2dn Ed"

### PHP5

+ SMS
+ CEP - Exemplo cedido gentilmente por Deni Santos (NuSoap)
+ CEP - Exemplo cedido gentilmente por Marcio H V Pereira (Curl)

### SQL Server Intergration Service 11

+ CEP - Exemplo cedido gentilmento por Adauto Michelotti


### Visual Basic 6

+ CEP - Exemplo cedido gentilmente por Jorge Barros
+ CEP - Exemplo cedido gentilmente por Ari Benevenuto (SoapSDK)

### VB.Net

+ SMS

### xHarbour

+ SMS - Exemplo cedido gentilmente pela AWS Sistemas Empresarias, Sorocaba / SP
+ CEP - Exemplo cedido gentilmente por Leonardo Machado (1.0.1 Harbour + bcc51)



