<?php

namespace Model;

use Model\Model;

class ConfirmationEmailModel extends Model
{
	protected $controllers = [
		"Email\ConfirmationEmail"
	];

    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "confirmationemail","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "userId"=>"VARCHAR(36) NOT NULL",
                "hash"=>"VARCHAR(32) NOT NULL",
                "email"=>"VARCHAR(255) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

	public function saveConfirmationEmail($userId, $hash, $userEmail) {
		$id = \Sec\UUID::v4();
		$modelName = $this->getModelData()[0];
		$fields = array_keys($this->getModelData()[2]);
		\array_splice($fields, 4, 1); // remove default timestamp
		$values = [$id, $userId, $hash, $userEmail];
		$this->app->db->insertNew($modelName, $fields, $values);
	}

	public function verifyEmailAddress($email, $hash) {
		$result = $this->app->db->gbi(["userId"],["email"=>$email, "hash"=>$hash], $this->getModelData()[0]);
		if (isset($result[0])){
			return $result[0]["userId"];
		}
	}
}