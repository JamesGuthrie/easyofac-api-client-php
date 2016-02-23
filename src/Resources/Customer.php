<?php

namespace EasyOfac\Api\Resources;

use EasyOfac\Api\Traits\Resources\Add;
use EasyOfac\Api\Traits\Resources\Inspect;
use EasyOfac\Api\Traits\Resources\Remove;
use EasyOfac\Api\Traits\Resources\UpdateStatus;


class Customers extends ResourceAbstract
{
	use Add;
	use Inspect;
	use Remove;
	use UpdateStatus;
	
	/**
	* {@inheritdoc}
	*/
    protected function setUpRoutes()
    {
        parent::setUpRoutes();
    }
	
	
    /**
     * Add a customer by full name
     *
     * @param array  $params
     * @param string $routeKey
     *
     * @return mixed
     */
    public function addFullName(array $params = [], $routeKey = __FUNCTION__)
    {
        $route = "addCustomerFullName";
		
        return $this->_client->post(
            $route,
			$params 
        );
    }


}