<?php

namespace ByJG\WebService;

/**
 * Classe Base com todas as funcionalidades para acessar o serviço ByJG
 */
abstract class AbstractSender
{
    protected $_service    = "";

    public function setService($service)
    {
        $this->_service = $service;
    }

    abstract public function conectarServer($httpmethod, $params);

    protected function parseContents($responseBody)
    {
        $firstData = explode('|', $responseBody);
        $result    = array(
            'status' => $firstData[0],
            'raw'    => $responseBody
        );

        if (isset($firstData[1])) {
            $parsedData = explode(', ', $firstData[1]);

            if (!isset($parsedData[1])) {
                $parsedData[0] = null;
                $parsedData[1] = $firstData[1];
            }

            $result['data'] = $parsedData;
        }

        return $result;
    }
}
