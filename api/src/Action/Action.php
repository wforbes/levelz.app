<?php

namespace Action;

use Model\ActionModel;
use Sec\Uuid;

class Action {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActionModel($app);
	}

	public function getActionsByActivityId($d) {
		if (gettype($d) === "string") {
			$result = $this->model->getActionsByActivityId($d);
		}
		
		return $result;
	}
}