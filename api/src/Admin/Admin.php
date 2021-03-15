<?php

namespace Admin;

use Model\AdminModel;

class Admin {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new AdminModel();
	}
}