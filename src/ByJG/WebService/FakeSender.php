<?php

namespace ByJG\WebService;

/**
 * Classe Base com todas as funcionalidades para acessar o serviço ByJG
 */
class FakeSender extends AbstractSender
{

    public function conectarServer($httpmethod, $params)
    {
        if ($this->_service == "sms") {
            return $this->parseContents($this->processSMS(strtolower($httpmethod), $params));
        } elseif ($this->_service == "cep") {
            return $this->parseContents($this->processCEP(strtolower($httpmethod), $params));
        } else {
            throw new \Exception("Service not found");
        }
    }

    protected function processCEP($httpmethod, $params)
    {
        switch ($httpmethod) {
            case "obterversao":
                return "OK|3.5.1-fake";
            case "obterlogradouroauth":
                return "OK|Rua das Flores , Centro, Rio de Janeiro, RJ, 000000";
            case "obtercepauth":
                return "OK|2|12345678, Rua das Flores, Centro, Rio de Janeiro, RJ, 000000|87654321, Rua das Roupas, Centro, São Paulo, SP, 999999";
            default:
                throw new \Exception("Method not found");
        }
        return;
        

    }

    protected function processSMS($httpmethod, $params)
    {
        switch ($httpmethod) {
            case "obterversao":
                return "OK|0.7.1-fake";
            case "recursos":
                return "OK|0, Tim:Oi:Claro:Vivo:nSMS:Fast:1SMS:SenderID";
            case "enviarsms":
                return "OK|0, Delivery";
        }
        
        return "ERR|Method not found";
    }

}