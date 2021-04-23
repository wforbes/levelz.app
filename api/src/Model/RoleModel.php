<?php

namespace Model;

use Model\Model;

class RoleModel extends Model
{
	protected $controllers = [
		"Role\Role"
	];

    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "role","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "name"=>"VARCHAR(36) NOT NULL",
                "level"=>"TINYINT NOT NULL"
            ]
        ];
	}

	public function getRoleIdByName($name) {
		return $this->app->db->gbi(["id"], ["name"=>$name], "role")[0]["id"];
	}
}
