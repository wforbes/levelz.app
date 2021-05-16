<?php

namespace Model;

use Model\Model;

class AuditActivityModel extends Model
{
	protected $controllers = [
		"Audit\AuditActivity"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
		return [
			"audit_activity","id",
			[
				"id"=>"VARCHAR(36) NOT NULL",
				"activityId"=>"VARCHAR(36) NOT NULL",
				"userId"=>"VARCHAR(36) NOT NULL",
				"name"=>"VARCHAR(72) NOT NULL",
				"description"=>"VARCHAR(1000) NOT NULL",
				"created_ts"=>"TIMESTAMP NOT NULL",
				"deleted_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
			]
		];
	}

	public function addAuditActivity($data) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $data);
	}
}