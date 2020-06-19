<?php

namespace User;

use Model\UserModel;

class User {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new UserModel($app);
	}
}