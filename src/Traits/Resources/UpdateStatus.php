<?php

namespace EasyOfac\Api\Traits\Resources;

use EasyOfac\Api\Exceptions\RouteException;

trait UpdateStatus
{
    /**
     * Add a new resource
     *
     * @param array  $params
     * @param string $routeKey
     *
     * @return mixed
     */
    public function updateStatus(array $params = [], $routeKey = __FUNCTION__)
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
			
            $route = "update" . ucfirst($this->_objectName) . "Status";
            $this->setRoute(__FUNCTION__, $route);
        }
		
        return $this->_client->post(
            $route,
			$params 
        );
    }

}