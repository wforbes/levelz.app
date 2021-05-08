<?php

namespace Model;

use Model\Model;

class ActionCompletionModel extends Model
{
	protected $controllers = [
		"Action\ActionCompletion"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "actioncompletion","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"actionId"=>"VARCHAR(36) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

	public function getActionCompletionsByActionId($actionId) {
		return $this->app->db->gbi("*", ["actionId" => $actionId], $this->getModelData()[0]);
	}

	public function getActionCompletionById($id) {
		return $this->app->db->gbi("*", ["id" => $id], $this->getModelData()[0])[0];
	}

	public function addActionCompletionByActionId($completionData) {
		$model = $this->getModelName();
		$fields = $this->getModelColumns();
		return $this->app->db->insertNew($model, $fields, $completionData);
	}

	public function actionAlreadyCompleted($actionId) {
		return $this->app->db->thisExists($this->getModelData()[0], "actionId", $actionId);
	}
}