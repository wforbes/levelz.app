<?php

namespace Model;

use Model\Model;

class PermissionModel extends Model 
{
	protected $controllers = [
		"Admin\Permission"
	];

	public function __construct($app)
	{
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "permission","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"ordinal"=>"TINYINT NOT NULL",
				"name"=>"VARCHAR(64) NOT NULL",
				"description"=>"VARCHAR(255)"
            ]
        ];
	}
}