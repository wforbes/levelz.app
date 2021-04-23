<?php

namespace Model;

use Model\Model;

class UserRoleModel extends Model
{
	protected $controllers = [
		"User\User",
		"Role\Role"
	];

    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "userrole","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "userId"=>"VARCHAR(36) NOT NULL",
                "roleId"=>"VARCHAR(36) NOT NULL"
            ]
        ];
	}

	public function setUserRole($userId, $roleId) {
		$id = \Sec\UUID::v4();
		$values = [$id, $userId, $roleId];
		$modelName = $this->getModelData()[0];
		$modelFields = array_keys($this->getModelData()[2]);
		if ($this->app->db->insertNew($modelName, $modelFields, $values) === true) {
			return [
				"id"=>$id,
				"userId"=>$userId,
				"roleId"=>$roleId
			];
		} else {
			return false;
		}
	}
	public function getUserRoleByUserId($userId){
        return $this->app->db->gbi(['*'],['userId'=>$userId],'userrole');
	}
}