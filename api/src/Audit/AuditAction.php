<?php

namespace Audit;

use Model\AuditActionModel;
use Sec\Uuid;

class AuditAction {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new AuditActionModel($app);
	}

	public function addAuditAction($action) {
		$auditData = [
			"id" => Uuid::v4(),
			"actionId" => $action["id"],
			"activityId" => $action["activityId"],
			"name" => $action["name"],
			"description" => $action["description"],
			"repeatable" => $action["repeatable"],
			"created_ts" => $action["created_ts"]
		];
		
		return $this->model->addAuditAction($auditData);
	}
}