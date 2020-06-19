<?php

namespace Auth;

use User\User;

class Auth {

	public function __construct($app) {
		
		$this->app = $app;
		$this->user = new User($app);
	}

	public function signup($d) {
		return $this->notDoneMsg($d);
	}

	private function notDoneMsg($d) {
		return ["response" =>["We received your signup request for username: '"
			.$d["username"]."', but we're not quite done with that feature yet. "
			."Check back in a few days!"]];
		
		exit();
	}
}