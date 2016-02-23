<?php

namespace EasyOfac\Api\Traits;

/**
*
*/
trait LookupService
{
	public function __call($name, $arguments)
    {
        if ((array_key_exists($name, $validSubResources = $this::getValidSubResources()))) 
		{
            $className = $validSubResources[$name];
            $client    = ($this instanceof \EasyOfac\Api\Client) ? $this : $this->_client;
            $class     = new $className($client);
        } 
		else 
		{
            throw new \Exception("No method called $name available in " . __CLASS__);
        }
		
        return $class;
    }
}