<?php

namespace Action;

use Model\ActionModel;
use Sec\Uuid;

class Action {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActionModel($app);
	}

	public function getActionCompletionsByActionId($actionId) {
		$result = (new ActionCompletion($this->app))->getActionCompletionsByActionId($actionId);
		return !$result? ["success" => $result] : ["success" => true, "actionCompletions" => $result];
	}

	public function completeActionById($actionId) {
		if (gettype($actionId) === "string") {
			$result = (new ActionCompletion($this->app))->addActionCompletionByActionId($actionId);
			return !$result? ["success" => $result] : ["success" => true, "actionCompletion" => $result ];
		}
		$actionData = $actionId;
		if (isset($actionData["grade"])) {
			var_dump("Got grade");
			die();
		}
		//$result = (new ActionCompletion($this->app))->addActionCompletionByActionId($actionId);
		return ["success" => $result];
	}

	//TODO: create a generic update function in model class like this using getEntityById and updateEntityById
	public function updateAction($actionFields) {
		$dbFields = $this->model->getActionById($actionFields["id"]);
		$updateFields = [];
		foreach($actionFields as $k => $v) {
			if($dbFields[$k] !== $v && $k !== "complete") {
				$updateFields[$k] = $v;
			}
		}
		$result = $this->model->updateActionById($actionFields["id"], $updateFields);
		return ["success" => $result];
	}

	public function createNewAction($newAction) {
		$activityId = $newAction["activityId"];
		$name = $newAction["name"];
		$desc = $newAction["description"];
		if (strlen($name) < 3) {
			return ["success" => false, "message" => "Error: Activity names must be longer than 2 characters."];
		}

		if (strlen($name) > 70) {
			return ["success" => false, "message" => "Error: Activity names must be shorter than 70 characters."];
		}
		
		if ($this->actionNameExists($activityId, $name)) {
			return ["success" => false, "message" => "Error: You already have an activity named '".$name."'! Try another name."];
		}

		//$descIsValid = $this->model->actionDescIsValid($desc);
		
		$id = Uuid::v4();
		$actionData = [$id, $activityId, $name, $desc];
		$result = $this->model->createNewAction($actionData);
		$returnArray = ["success" => $result];
		if ($result) {
			$returnArray["newAction"] = [
				"id" => $id,
				"activityId" => $activityId,
				"name" => $name,
				"description" => $desc
			]; 
		}
		return $returnArray;
	}

	public function actionNameExists($data, $name = "") {
		$activityId = \is_array($data) ? $data["activityId"] : $data;
		$name = \is_array($data) ? $data["name"] : $name;
		return $this->model->actionNameExists($activityId, $name);
	}

	public function getActionsByActivityId($d) {
		$response = [];
		if (gettype($d) === "string") {
			$result = $this->model->getActionsByActivityId($d);
			$actionCompletion = new ActionCompletion($this->app);
			foreach($result as &$action) {
				$action["complete"] = $actionCompletion->actionIsComplete($action["id"]);
			}
			$response["actions"] = $result;
		}
		
		$response["success"] = true;
		return $response;
	}
}