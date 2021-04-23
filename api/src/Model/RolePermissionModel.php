<?php

namespace Model;

use Model\Model;

class RolePermissionModel extends Model
{
	protected $controllers = [
		"Role\Role",
		"Permission\Permission"
	];

    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "rolepermission","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "roleId"=>"VARCHAR(36) NOT NULL",
                "permissionId"=>"VARCHAR(36) NOT NULL"
            ]
        ];
	}

	public function setRolePermission($roleId, $permissionId) {
		$id = \Sec\UUID::v4();
		$values = [$id, $roleId, $permissionId];
		$modelName = $this->getModelData()[0];
		$modelFields = array_keys($this->getModelData()[2]);
		if ($this->app->db->insertNew($modelName, $modelFields, $values) === true) {
			return [
				"id"=>$id,
				"roleId"=>$roleId,
				"permissionId"=>$permissionId
			];
		} else {
			return false;
		}
	}

	public function roleHasPermission($roleId, $permissionId) {
		return $this->app->db->thisExists(
			$this->getModelData()[0],
			["roleId", "permissionId"],
			[$roleId, $permissionId]
		);
	}
}
