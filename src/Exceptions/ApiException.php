<?php

namespace EasyOfac\Api\Exceptions;

/**
*
*/
class ApiException extends \Exception
{
	/**
	* @var array
	*/
	protected $_errors; 

	public function __construct($message, $errors = [])
	{
		parent::__construct($message);
		$this->_errors = $errors;
	}
	
	/**
	* Check if any errors have been returned
	*
	* @return bool
	*/
	public function hasError()
	{
		return (count($this->_errors) > 0);
	}
	
	/**
	* Get Errors
	* 
	* @return array
	*/
	public function getErrors()
	{
		return $this->_errors;
	}
}