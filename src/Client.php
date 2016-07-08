<?php

namespace EasyOfac\Api;

use EasyOfac\Api\Traits\LookupService;

/**
*
*/
class Client
{
	/**
	*
	*/
	const DEFAULT_API_URL = "https://easyofac.com/";
	
	/**
	* 
	*/
	const VERSION = "1.0.0";
	
	/**
	* @var string
	*/
	protected $_email;
	
	/**
	* @var stirng
	*/
	protected $_password;
	
	/**
	* @var string
	*/
	protected $_auth;
	
	/**
	* @var string
	*/
	protected $_apiUrl;
	
	/**
	* @var string
	*/
	protected $_apiKey;
	
	/**
	* @var bool
	*/
	protected $_testMode = FALSE;

	use LookupService;
	
	/**
	*
	*/
	public function __construct($apiKey = NULL, $options = NULL)
	{
		$this->_apiKey = $apiKey;
		
		if(isset($options))
		{
			if(isset($options["email"]))
			{
				$this->_email = $options["email"];
			}
			
			if(isset($options["password"]))
			{
				$this->_password = $options["password"];
			}
			
			if(isset($options["auth"]))
			{
				$this->_auth = $options["auth"];
			}
			
			if(isset($options["testMode"]))
			{
				$this->_testMode = $options["testMode"];
			}
			
			if(isset($options["apiUrl"]))
			{
				$this->_apiUrl = $options["apiUrl"];
			}
		}
		
		if(!isset($this->_apiUrl))
		{
			$this->_apiUrl = self::DEFAULT_API_URL;
		}
	}
	
	public static function getValidSubResources()
	{
		return [
			"info" => "EasyOfac\\Api\\Resources\\Info",
			"customers" => "EasyOfac\\Api\\Resources\\Customers",
			"companies" => "EasyOfac\\Api\\Resources\\Companies",
			"ofac" => "EasyOfac\\Api\\Resources\\Ofac", 
		];
	}
	
	/**
	* Get the user agent
	*/ 
	public function getUserAgent()
	{
		return "EasyOFAC_API PHP " . self::VERSION;
	}
	
	public function getHeaders()
	{
		return [];
	}
	
	/**
	*
	*/
	public function getApiUrl()
	{
		return $this->_apiUrl . "api/";
	}
	
	
	public function get($endpoint, $query = [], $options = [])
	{
		$query = array_merge( $query, [ "api_key" => $this->_apiKey ]);
		
		if($this->_testMode)
		{
			$query["test"] = 1;
		}
		
		
		return HttpRequest::send(
			$this,
			$endpoint,
			array_merge($options, [ 
				'query' => array_merge( $query, [ "api_key" => $this->_apiKey ]),
				'method' => 'GET' 
			])
		);
		
	}
	
	public function post($endpoint, $data = [], $options = [])
	{
		$query = [ "api_key" => $this->_apiKey ];
		
		if($this->_testMode)
		{
			$query["test"] = 1;
		}
		
		return HttpRequest::send(
			$this,
			$endpoint,
			array_merge($options, 
				[ 
					'form_params' => $data,
					'query' => $query,
					'method' => 'POST' 
				]
			)
		);
	}
}