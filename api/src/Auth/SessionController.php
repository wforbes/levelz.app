<?php

namespace Auth;

class SessionController {
	public function checkSession($d) {
		if (!empty($_SESSION["d"])) {
			return [ "sessionData" => $_SESSION["d"] ];
		} else {
			return "";
		}
	}

	public function logout($d) {
		session_unset();
		session_destroy();
		if (session_id() === ""){
			return ["success" => []];
		} else {
			return ["errors" => []];
		}
	}
}