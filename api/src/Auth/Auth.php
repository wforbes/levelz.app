<?php

namespace Auth;

class Auth {

	public function signup($d):array {
		return ["response" =>["We received your signup request for '"
			.$d["username"]."', but the signup code isn't quite done yet. "
			."Check back in a few days!"]];
	}
}