<?php

/**
 *
 * @category	CEP
 * @package	CepWebService
 * @version		0.2 (beta)
 * @author		Deni Santos <denixsi@gmail.com>
 * @copyright	Copyright (c) 2008 Deni Santos <http://conhecimento.static.com.br>
 * @license		GPL
 *
 * Extra :
 * @generated	PHPEclipse <http://www.phpeclipse.de/>
 *				Ecplise 3.3.1.1 <http://www.eclipse.org/>
 *				Eclipse - an open development platform!
 *				For good programmers! =)
 *
 */
class CepWebService
{	
	/**
	* CEP - armazena o numero do CEP para efetuar a pesquisa
	*
	* @var string
	*/
	protected $_cep = '';
	
	/**
	* username - armazena o nome do usu�rio usado na autentica��o do webservice
	*
	* @var string
	*/
	protected $_username = '';
	
	/**
	* password - armazena a senha do usu�rio usado na autentica��o do webservice
	*
	* @var string
	*/
	protected $_password = '';
	
	/**
	 * Construtor da classe
	 * Verifica se a extens�o SOAP est� presente no servidor
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Verifica se a extens�o SOAP est� carregada no servidor
		if(!extension_loaded("soap")) {
			throw new Exception('A extens�o "SOAP" n�o est� carregada, ative-a nas configura��es do "php.ini".');
		}
	}

	/**
	 * Seta o CEP para pesquisa
	 *
	 * @param string $cep
	 * @return CepWebService
	 */
	public function setCep($cep)
	{
		$this->_cep = (string) $cep;
		return $this;
	}

	/**
	 * Retorna o CEP da pesquisa
	 *
	 * @return string
	 */
	public function getCep()
	{
		return $this->_cep;
	}
	
	/**
	 * Seta o nome de usu�rio para autentica��o
	 *
	 * @param string $user
	 * @return CepWebService
	 */
	public function setUser($user)
	{
		$this->_username = (string) $user;
		return $this;
	}

	/**
	 * Retorna o nome de usu�rio para autentica��o
	 *
	 * @return string
	 */
	public function getUser()
	{
		return $this->_username;
	}
	
	/**
	 * Seta a senha de usu�rio para autentica��o
	 *
	 * @param string $pass
	 * @return CepWebService
	 */
	public function setPass($pass)
	{
		$this->_password = (string) $pass;
		return $this;
	}

	/**
	 * Retorna a senha de usu�rio para autentica��o
	 *
	 * @return string
	 */
	public function getPass()
	{
		return $this->_password;
	}

	/**
	 * Busca as informa��es do CEP no webservice
	 *
	 * @return array
	 */
	public function find()
	{
		// Validando CEP
		if(empty($this->_cep)) {
			throw new Exception('Par�metro "CEP" n�o foi definido.');
		}
		
		// Validando usu�rio de autentica��o
		if(empty($this->_username)) {
			throw new Exception('Par�metro "Usu�rio" n�o foi definido.');
		}
		
		// Validando senha de autentica��o
		if(empty($this->_password)) {
			throw new Exception('Par�metro "Senha" n�o foi definido.');
		}

		// Definindo o webservice
		$client = new SoapClient(NULL,
	        array(
		        "location" => "http://www.byjg.com.br/site/webservice.php/ws/cep",
		        "uri"      => "urn:xmethods-delayed-quotes",
		        "style"    => SOAP_RPC,
		        "use"      => SOAP_ENCODED
				)
			);

		// Chamando m�todo do webservice
		$result = $client->__call(
	        // Nome do m�todo
	        "obterLogradouroAuth",
	        // Par�metros
	        array(
	            new SoapParam(
	                // informando CEP
	                $this->_cep,
	                // Nome do par�mentro
	                "cep"
	        	),
	        	new SoapParam(
	                // Informando usu�rio
	                $this->_username,
	                // Nome do par�mentro
	                "usuario"
	        	),
	        	new SoapParam(
	                // Informando senha
	                $this->_password,
	                // Nome do par�mentro
	                "senha"
	        	)
	        ),
	        // Op��es
	        array(
	            "uri" => "urn:xmethods-delayed-quotes",
	            "soapaction" => "urn:xmethods-delayed-quotes#getQuote"
	        )
		);

		// Verifica o resultado retornado pelo webservice
		if(strpos($result, utf8_encode('n�o encontrado')) !== false) {
			$return = array();
		} else {
			// Converte em array
			$return = explode(', ', $result);
			
			// Verifica se a faixa de numero foi especificada
			if(strpos($return[0], '-') !== false) {
				// Adiciona os novos valores
				list($return[0], $return[]) = explode(' - ', $return[0]);
			}
			
			// Adequa os resultados
			$return = array_map('trim', $return);
			$return = array_map('utf8_decode', $return);
			$return = array_map(array($this, 'clear'), $return);
			$return = array_map('strtolower', $return);
			$return = array_map('ucwords', $return);
		}

		return $return;
	}
	
	/**
	 * Substitui caracteres com acento por caracteres sem acento
	 *
	  * @param string $string
	 * @return string
	 */
	public function clear($string)
	{
		return strtr($string, "��������������������������", "aaaaeeiooouucAAAAEEIOOOUUC");
	}
}
?>
