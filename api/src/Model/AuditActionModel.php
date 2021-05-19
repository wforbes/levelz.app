<?php

namespace Model;

use Model\Model;

class AuditActionModel extends Model
{
	protected $controllers = [
		"Audit\AuditAction"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
		return [
			"audit_action","id",
			[
				"id"=>"VARCHAR(36) NOT NULL",
				"actionId"=>"VARCHAR(36) NOT NULL",
				"activityId"=>"VARCHAR(36) NOT NULL",
				"name"=>"VARCHAR(72) NOT NULL",
				"description"=>"VARCHAR(1000) NOT NULL",
				"repeatable"=>"TINYINT NOT NULL",
				"created_ts"=>"TIMESTAMP NOT NULL",
				"deleted_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
			]
		];
	}

	public function addAuditAction($data) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $data);
	}
}