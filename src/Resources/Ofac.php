<?php

namespace EasyOfac\Api\Resources;


class Ofac extends ResourceAbstract
{

	public function searchByName($params)
	{
		return $this->_client->post(
			"nameSearch",
			$params
		);
	}
	
	public function searchByFullName($params)
	{
		return $this->_client->post(
			"fullNameSearch",
			$params
		);
	}
	
	public function searchByAddress($params)
	{
		return $this->_client->post(
			"addSearch",
			$params
		);
	}
	
	public function searchByCompany($params)
	{
		return $this->_client->post(
			"companySearch",
			$params
		);
	}
	
	public function searchForAlternateNames($params)
	{
		return $this->_client->post(
			"altSearch",
			$params
		);
	}
	
	public function searchForSDNs($params)
	{
		return $this->_client->post(
			"sdnSearch",
			$params
		);
	}
}


