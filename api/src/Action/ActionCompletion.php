<?php

namespace Action;

use Model\ActionCompletionModel;
use Sec\Uuid;

class ActionCompletion {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActionCompletionModel($app);
	}

	public function getActionCompletionsByActionId($actionId) {
		return $this->model->getActionCompletionsByActionId($actionId);
	}

	public function addActionCompletionByActionId($actionId) {
		$id = Uuid::v4();
		/* // actions repeatable by default?
		if ($this->model->actionAlreadyCompleted($actionId)) {
			return ["success" => false, "message" => "Action was already completed"];
		}
		*/

		$completionData = [$id, $actionId];
		$this->model->addActionCompletionByActionId($completionData);
		return $this->model->getActionCompletionById($id);
	}

	public function actionIsComplete($actionId) {
		return $this->model->actionAlreadyCompleted($actionId);
	}
}
