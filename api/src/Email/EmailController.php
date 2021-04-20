<?php

namespace Email;

class EmailController {
	public function __construct($app) {
		$this->app = $app;
	}

	public function sendConfirmationEmail($userId, $userEmail) {
		(new ConfirmationEmail($this->app))->sendConfirmationEmail($userId, $userEmail);
	}

	public function verifyEmailAddress($email, $hash) {
		return (new ConfirmationEmail($this->app))->verifyEmailAddress($email, $hash);
	}

	public static function sendMail($to, $from, $subject, $msg) {
		mail($to, $subject, $msg, "FROM: ".$from);
	}
}