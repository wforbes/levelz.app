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
				"description"=>"VARCHAR(1000) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

	public function activityNameExists($userId, $name) {
		return $this->app->db->thisExists($this->getModelData()[0], ["userId", "name"], [$userId, $name]);
	}

	public function createNewActivity($data) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $data);
	}

	public function getActivitiesByUserId($userId) {
		return $this->app->db->gbi("*", ["userId"=>$userId], $this->getModelData()[0]);
	}

	public function getActivityById($id) {
		return $this->app->db->gbi("*", ["id" => $id], $this->getModelData()[0])[0];
	}
	
	public function saveActivityChanges($data) {
		$there = $this->getModelName();
		$fields = $this->getModelData()[2];
		$that = $data[0];
		$these = $data[1];
		return $this->app->db->ubi($these, $that, $there)?array_merge($that, $these):false;
	}

	public function updateActivityField($data) {
		$there = $this->getModelName();
		$that = $data[0];
		$these = $data[1];
		return $this->app->db->ubi($these, $that, $there);
	}

	public function updateActivityById($id, $updateFields) {
		$these = $updateFields;
		$that = ["id" => $id ];
		$there = $this->getModelName();
		return $this->app->db->ubi($these, $that, $there);
	}
}