<?php

namespace Model;

use Model\Model;

class ActionModel extends Model
{
	protected $controllers = [
		"Action\Action"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "action","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"activityId"=>"VARCHAR(36) NOT NULL",
				"name"=>"VARCHAR(72) NOT NULL",
				"description"=>"VARCHAR(1000) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

	public function actionNameExists($activityId, $name) {
		return $this->app->db->thisExists($this->getModelData()[0], ["activityId", "name"], [$activityId, $name]);
	}

	public function createNewAction($data) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $data);
	}

	public function getActionsByActivityId($activityId) {
		return $this->app->db->gbi("*", ["activityId"=>$activityId], $this->getModelData()[0]);
	}
	
	public function saveActionChanges($data) {
		$there = $this->getModelName();
		$fields = $this->getModelData()[2];
		$that = $data[0];
		$these = $data[1];
		return $this->app->db->ubi($these, $that, $there)?array_merge($that, $these):false;
	}

	public function updateActionField($data) {
		$there = $this->getModelName();
		$that = $data[0];
		$these = $data[1];
		return $this->app->db->ubi($these, $that, $there);
	}
}
