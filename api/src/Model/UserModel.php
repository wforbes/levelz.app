<?php

namespace Model;

use Model\Model;

class UserModel extends Model
{
	
    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "user","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "username"=>"VARCHAR(36) NOT NULL",
                "passhash"=>"VARCHAR(255) NOT NULL",
                "email"=>"VARCHAR(255) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
                "verified"=>"TINYINT"
            ]
        ];
	}

	public function userExistsByName($u){
        return $this->app->db->thisExists($this->getModelData()[0], "username", $u);
	}
	
    public function userExistsByEmail($e){
        return $this->app->db->thisExists($this->getModelData()[0], "email", $e);
    }
}