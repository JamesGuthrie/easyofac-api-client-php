<?php

namespace EasyOfac\Api\Traits\Resources;

use EasyOfac\Api\Exceptions\RouteException;

trait Inspect
{
    /**
     * Inspect a resource
     *
     * @param array  $params
     * @param string $routeKey
     *
     * @return mixed
     */
    public function inspect(array $params = [], $routeKey = __FUNCTION__)
    {
        try 
		{
            $route = $this->getRoute($routeKey, $params);
        } 
		catch (RouteException $e) 
		{
            if (! isset($this->resourceName)) 
			{
                $this->_resourceName = $this->getResourceNameFromClass();
            }
			
            $route = "inspect" . ucfirst($this->_objectName);
            $this->setRoute(__FUNCTION__, $route);
        }
		
        return $this->_client->get(
            $route,
			$params
        );
    }

}