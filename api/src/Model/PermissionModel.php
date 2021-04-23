<?php

namespace Model;

use Model\Model;

class PermissionModel extends Model
{
	protected $controllers = [
		"Permission\Permission"
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
                "action"=>"VARCHAR(64) NOT NULL",
                "object"=>"VARCHAR(64) NOT NULL"
            ]
        ];
	}
	public function permissionExists($action, $object) {
		return $this->app->db->thisExists(
			$this->getModelData()[0],
			["action", "object"],
			[$action, $object]
		);
	}
	public function getPermissionId($action, $object) {
		return $this->app->db->gbi(["id"], ["action"=>$action, "object"=>$object], "permission")[0]["id"];
	}
}
