<?php

namespace Model;

use Model\Model;

class ActivityModel extends Model
{
	protected $controllers = [
		"Activity\Activity"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "activity","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"userId"=>"VARCHAR(36) NOT NULL",
				"name"=>"VARCHAR(72) NOT NULL",
				"description"=>"VARCHAR(MAX) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

	public function createNewActivity($data) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $data);
	}

	public function getActivitiesByUserId($userId) {
		return $this->app->db->gbi("*",["userId"=>$userId],"activity");
	}
	
}