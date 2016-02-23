<?php

namespace EasyOfac\Api\Exceptions;

/**
*
*/
class MissingParameterException extends \Exception
{
	public function __construct($method, array $params, $code = 0, \Exception $previous = null)
	{
		 parent::__construct(
            'Missing parameters: \'' . implode("', '", $params) . '\' must be supplied for ' . $method,
            $code,
            $previous
        );
	}
}