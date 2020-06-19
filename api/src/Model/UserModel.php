<?php
/**
 * Created by PhpStorm.
 * User: Finite
 * Date: 3/16/2019
 * Time: 6:40 AM
 */

namespace Model;

use Model\Model;

class UserModel extends Model
{
	
    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    protected function getModelData():array {
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
}