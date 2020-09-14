<?php

namespace Model;

use Model\Model;

class UserPermissionModel extends Model 
{
	protected $controllers = [
		"User\User",
		"Admin\Permission"
	];

	public function __construct($app)
	{
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "userpermission","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"userId"=>"VARCHAR(36) NOT NULL",
				"permissionId"=>"VARCHAR(36) NOT NULL"
			],
			["userId"=>"user(id)", "permissionId"=>"permission(id)"]
        ];
	}

}