<?php

namespace ByJG\WebService;

/**
 * Classe para envio de SMS utilizaçao o WebService ByJG
 * 2009-01-19
 * 2014-10-17
 *
 * Joao Gilberto Magalhaes
 * http://www.byjg.com.br/
 */
class Sms extends BaseService
{

	/**
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password, $curlParams = [CURLOPT_TIMEOUT => 5])
	{
		parent::__construct($username, $password, $curlParams);
		$this->_service = "sms";
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

	/**
	 * Enviar um SMS
	 *
	 * @param string $ddd
	 * @param string $celular
	 * @param string $mensagem
	 * @return string
	 */
	public function enviarSMS($ddd, $celular, $mensagem)
	{
		$params = array(
			"ddd" => $ddd,
			"celular" => $celular,
			"mensagem" => utf8_encode($mensagem)
		);

		return $this->conectarServer("enviarsms", $params);
	}

	//

	/**
	 * Envia SMS para um lista.
	 * Os números da lista deve ter o seguinte formato: DDPPPPNNNN Onde DD é o DDD, PPPPNNNN é o número do celular.
	 *
	 * @param array $lista
	 * @param strign $mensagem
	 * @return string
	 */
	public function enviarListaSMS($lista, $mensagem)
	{
		$params = array(
			"lista" => implode('|', $lista),
			"mensagem" => $mensagem
		);

		return $this->conectarServer("enviarListaSMS", $params);
	}

	/**
	 * Agenda o envio de SMS.
	 * Data no formato YYYY/MM/DD.
	 * Hora no formato HH:MM.
	 * Periodo: Unidade de Repeticao (H - Horas, D - Dias).
	 * Frequencia: O intervalo em 'periodos' entre as repetições.
	 * Repeticoes: número de vezes a repetir o envio. Deixar vazio periodo, frequencia e repeticoes caso não queira repeticoes.
	 *
	 * @param string $ddd
	 * @param string $celular
	 * @param string $mensagem
	 * @param string $data
	 * @param string $hora
	 * @param string $periodo
	 * @param int $frequencia
	 * @param int $repeticoes
	 * @return string
	 */
	public function agendarEnvio($ddd, $celular, $mensagem, $data, $hora, $periodo = "", $frequencia = "", $repeticoes = "")
	{
		$params = array(
			"ddd" => $ddd,
			"celular" => $celular,
			"mensagem" => utf8_encode($mensagem),
			"data" => $data,
			"hora" => $hora,
			"periodo" => $periodo,
			"frequencia" => $frequencia,
			"repeticoes" => $repeticoes
		);

		return $this->conectarServer("agendarEnvio", $params);
	}

	/**
	 * Obter os recursos disponíveis para envio de SMS
	 *
	 * @return string
	 */
	public function recursos()
	{
		return $this->conectarServer("recursos", array());
	}

	/**
	 * Obter a quantidade de créditos disponíveis para envio de SMS
	 *
	 * @return string
	 */
	public function creditos()
	{
		return $this->conectarServer("creditos", array());
	}

}
