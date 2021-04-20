<?php

namespace Email;

use Core\App;
use Model\ConfirmationEmailModel;

//TODO: Implement multiple addresses on local
//	-- https://www.geeksforgeeks.org/mailer-multiple-address-in-php/

//https://stackoverflow.com/questions/15965376/how-to-configure-xampp-to-send-mail-from-localhost
//https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
//https://router.vuejs.org/guide/essentials/passing-props.html#object-mode
class ConfirmationEmail {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ConfirmationEmailModel($app);
	}

	public function sendConfirmationEmail($userId, $userEmail) {
		$confirmationUrl = $this->getConfirmationUrl($userId, $userEmail);
		$subject = "Confirm your Levelz.app account";
		$message = "
		<html>
			<head>
				<title>Confirm Your Email</title>
			</head>
			<body>
				<h3>Hey there!</h3>
				<p>
					We just got a new sign up request at <strong>levelz.app</strong>
					using your email address and we'd like to confirm that it's right!
				</p>
				<p>
					Click on the link below to verify your email and access your dashboard!
				</p>
				<p>
					<a href='".$confirmationUrl."'>CONFIRM MY ACCOUNT</a>
				</p>
				<br><br><br>
				<p>
					This message was sent automatically from levelz.app, do not reply to this email.
					If this wasn't you or you'd like to get in touch with us, send an email to 
						<a href='mailto:admin@levelz.app'>admin@levelz.app</a>.
				</p>
			</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: donotreply@levelz.app' . "\r\n";
		
		mail($userEmail, "Confirm Your Email", $message, $headers);
		$this->model->saveConfirmationEmail($userId, $this->hash, $userEmail);
	}

	private function getConfirmationUrl($userId, $userEmail) {
		$this->hash = md5(rand(0,1000));
		$domain = App::detectEnvironment() === "local" ? 
			"localhost:8080" : "https://levelz.app";
		return $domain."/verify?h=".$this->hash."&e=".$userEmail;
	}

	public function verifyEmailAddress($email, $hash) {
		return $this->model->verifyEmailAddress($email, $hash);
	}
}