<?php

namespace Audit;

use Model\AuditActivityModel;
use Sec\Uuid;

class AuditActivity {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new AuditActivityModel($app);
	}

	public function addAuditActivity($activity) {
		$auditData = [
			"id" => Uuid::v4(),
			"activityId" => $activity["id"],
			"userId" => $activity["userId"],
			"name" => $activity["name"],
			"description" => $activity["description"],
			"created_ts" => $activity["created_ts"]
		];
		
		return $this->model->addAuditActivity($auditData);
	}
}