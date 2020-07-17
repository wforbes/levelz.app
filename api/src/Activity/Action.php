<?php

namespace Activity;

use Model\ActionModel;
use Sec\Uuid;

class Action {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActionModel($app);
	}
}