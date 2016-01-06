<?php

namespace ByJG\WebService;

/**
 * Classe para consulta de CEP utilizaçao o WebService ByJG
 * 2009-01-19
 * 2014-10-17
 *
 * Joao Gilberto Magalhaes
 * http://www.byjg.com.br/
 */
class Cep extends BaseService
{

    /**
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        $this->_service = "cep";
    }

    /**
     * Obter a versão do WebService
     * 
     * @return string
     */
    public function obterVersao()
    {
        return $this->conectarServer("obterversao", array());
    }

    protected function parseCep($linha, $cep)
    {
        $inc = $cep ? 1 : 0;

        $info   = explode(', ', $linha);
        $result = array(
            'logradouro' => str_replace('OK|', '', isset($info[0 + $inc]) ? $info[0 + $inc] : ""),
            'bairro'     => isset($info[1 + $inc]) ? $info[1 + $inc] : "",
            'cidade'     => isset($info[2 + $inc]) ? $info[2 + $inc] : "",
            'uf'         => isset($info[3 + $inc]) ? $info[3 + $inc] : "",
            'ibge'       => isset($info[4 + $inc]) ? $info[4 + $inc] : ""
        );

        if ($cep) {
            $result['cep'] = $info[0];
        }

        return $result;
    }

    /**
     * Obter o Logradouro à partir de um CEP
     *
     * @param string $cep
     * @return string
     */
    public function obterLogradouro($cep)
    {
        $params = array(
            "cep" => $cep
        );

        $result = $this->conectarServer("obterlogradouroauth", $params);
        if ($result['status'] == 'OK') {
            $result['data']['code'] = 0;

            $result['data']['info'] = $this->parseCep($result['raw'], false);
        }

        return $result;
    }

    /**
     * Retorna o CEP à partir do nome do logradouro, localidade e unidade federativa. Esse método requer autenticação de usuário. Se autenticado, retorna as 20 primeiras linhas encontradas.
     *
     * @param string $logradouro
     * @param string $localidade
     * @param string $uf
     * @return string
     */
    public function obterCEP($logradouro, $localidade, $uf)
    {
        $params = array(
            "logradouro" => $logradouro,
            "localidade" => $localidade,
            "UF"         => $uf
        );

        $result = $this->conectarServer("obtercepauth", $params);

        if ($result["status"] == 'OK') {
            $result['data']['code'] = 0;

            $info                   = explode('|', $result['raw']);
            $result['data']['info'] = array();
            foreach (array_slice($info, 2) as $linha) {
                $result['data']['info'][] = $this->parseCep($linha, true);
            }
        }

        return $result;
    }
}
