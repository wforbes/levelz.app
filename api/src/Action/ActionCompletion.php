<?php

namespace Action;

use Model\ActionCompletionModel;
use Sec\Uuid;

class ActionCompletion {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActionCompletionModel($app);
	}

	public function addActionCompletionByActionId($actionId) {
		$id = Uuid::v4();
		
		if ($this->model->actionAlreadyCompleted($actionId)) {
			return ["success" => false, "message" => "Action was already completed"];
		}

		$completionData = [$id, $actionId];
		$result = $this->model->addActionCompletionByActionId($completionData);
		return ["success" => $result];
	}

	public function actionIsComplete($actionId) {
		return $this->model->actionAlreadyCompleted($actionId);
	}
}
