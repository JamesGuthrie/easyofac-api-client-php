<?php

namespace EasyOfac\Api\Resources;

use EasyOfac\Api\Traits\Resources\Add;
use EasyOfac\Api\Traits\Resources\Inspect;
use EasyOfac\Api\Traits\Resources\Remove;
use EasyOfac\Api\Traits\Resources\UpdateStatus;


class Companies extends ResourceAbstract
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
}