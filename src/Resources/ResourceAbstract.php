<?php

namespace EasyOfac\Api\Resources;

use Inflect\Inflect;
use EasyOfac\Api\Exceptions\RouteException;

class ResourceAbstract
{

	/**
	* @var string
	*/
	protected $_resourceName;
	
	/* 
	* @var string
	*/
	protected $_objectName;
	
	/*
	* @var string
	*/
	protected $_objetNamePlural;
	
	/**
	* @var Client
	*/
	protected $_client;
	
	/**
	* @var array
	*/
	protected $_routes;
	
	/**
	* @var array
	*/ 
	protected $_additionalRouteParameters = [];
	

	public function __construct($client)
	{
		$this->_client = $client;
		
		if(!isset($this->_resourceName))
		{
			$this->_resourceName = $this->getResourceNameFromClass();
		}
		
		if(! isset($this->objectName))
		{
			$this->_objectName = Inflect::singularize($this->_resourceName);
		}
		
		if(! isset($this->_objectNamePlural))
		{
			$this->_objectNamePlural = Inflect::pluralize($this->_resourceName);
		}
	}
	
	/**
     * Return the resource name using the name of the class (used for endpoints)
     *
     * @return string
     */
    protected function getResourceNameFromClass()
    {
        $namespacedClassName = get_class($this);
        $resourceName        = join('', array_slice(explode('\\', $namespacedClassName), -1));
      
	  // This converts the resource name from camel case to underscore case.
        // e.g. MyClass => my_class
        $dashed = strtolower(preg_replace('/(?<!^)([A-Z])/', '-$1', $resourceName));
      
		return strtolower($dashed);
	}
	
	/**
	* Get the name of the resource
	*
	* @return string
	*/
	public function getResourceName()
	{
		return $this->_resourceName;
	}
	
	/**
	* Set up routes for the resource
	*/
	protected function setupRoutes()
	{
	}
	
	/**
	* Get the list of routes
	* 
	* @return array
	*/
	public function getRoutes()
	{
		return $this->_routes;
	}
	
    /**
	* Setup aroute
	* 
	* @param string $name
	* @param string $route
	*/
    public function setRoute($name, $route)
    {
        $this->_routes[$name] = $route;
    }
	
	/**
	* Returns a route and replaces tokenized parts of the string with
	* the passed params
	*
	* @param       $name
	* @param array $params
	*
	* @return mixed
	* @throws RouteException
	*/
    public function getRoute($name, array $params = [])
    {
        if (! isset($this->_routes[$name])) 
		{
            throw new RouteException('Route not found.');
        }
		
        $route = $this->routes[$name];
		
        $substitutions = array_merge($params, $this->getAdditionalRouteParams());
        
		foreach ($substitutions as $name => $value) 
		{
            if (is_scalar($value)) 
			{
                $route = str_replace('{' . $name . '}', $value, $route);
            }
        }
		
        return $route;
    }
	
	/**
	* Set a single additional parameter
	*
	* @param string $name
	* @param mixed $value
	*/
	public function setAdditionalRouteParam($name, $value)
	{
		$this->_additionalRouteParams[$name] = $value;
		
		return $this;
	}
	
	/**
	* Set additional parameters
	*
	* @param array $additionalRouteParams
	*/
    public function setAdditionalRouteParams($additionalRouteParams)
    {
        $this->_additionalRouteParams = $additionalRouteParams;
		
		return $this;
    }
	
	/**
	* Get the list of addiontal route parameters
	*
	* @return array
	*/
    public function getAdditionalRouteParams()
    {
        return $this->additionalRouteParams;
    }
}