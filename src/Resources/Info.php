<?php

namespace EasyOfac\Api\Resources;


class Info extends ResourceAbstract
{

	public function quota($params = [])
	{
		return $this->_client->get(
			"quota",
			$params
		);
	}
	
	public function stats($params = [])
	{
		return $this->_client->get(
			"stats"
		);
	}
	
	public function addresses($params = [])
	{
		return $this->_client->get(
			"adds",
			$params
		);
	}
	
	public function alternateNames($params = [])
	{
		return $this->_client->get(
			"companySearch",
			$params
		);
	}
	
	public function sdns($params = [])
	{
		return $this->_client->get(
			"altSearch",
			$params
		);
	}
	
}


