<?php

namespace Auth;

use User\User;
use User\UserProfile;
use Sec\Sec;

class LoginController {

	private $loginErrors = [];

	private $loginEmail = "";
	private $loginUsername = "";
	private $loginPassword = "";

	public function __construct($app) {
		$this->app = $app;
		$this->user = new User($app);
	}

	public function submitLogin($d):array {
		if ($this->loginIsValid($d)) {
			$userPasswordHash = ($this->loginEmail === "") ? 
				$this->user->getPasswordHashByUsername($this->loginUsername)[0]["passhash"] :
				$this->user->getPasswordHashByEmail($this->loginEmail)[0]["passhash"];

			if(password_verify($this->loginPassword,$userPasswordHash)){
				if ($this->loginEmail !== "") {
					$_SESSION["d"]["userId"] = $userId = 
						$this->user->getIdByEmail($this->loginEmail);
					$_SESSION["d"]["username"] = $this->user->getUsernameById($userId);
					$_SESSION["d"]["userEmail"] = $this->loginEmail;
				} else {
					$_SESSION["d"]["userId"] = $userId =
						$this->user->getIdByUsername($this->loginUsername);
					$_SESSION["d"]["username"] = $this->loginUsername;
					$_SESSION["d"]["userEmail"] = $this->user->getEmailById($userId);
				}
				$profile = ($userProfile = new UserProfile($this->app))->getUserProfileByUserId($userId);
				if($profile){
					$_SESSION['d']['userProfileId'] = $profile[0]['id'];
				}else{
					$_SESSION['d']['userProfileId'] = $userProfile->createNewProfile($userId);
				}
				return ['success' =>
					[
						"userId" => $_SESSION["d"]["userId"],
						"username" => $_SESSION["d"]["username"],
						"userEmail" => $_SESSION["d"]["userEmail"],
						"userProfileId" => $_SESSION["d"]["userProfileId"],
					]
				];
			} else {
				$this->loginErrors[] = "There was a problem with that password";
				return ["errors" => $this->loginErrors];
			}
		} else {
			return ["errors" => $this->loginErrors];
		}
	}

	private function loginIsValid($d):bool {
		if ($d['u'] === "") {
			$this->loginErrors[] = "Username cannot be blank";
		}
		if ($d['p'] === "") {
			$this->loginErrors[] = "Password cannot be blank";
		}
		
		$this->loginEmail = filter_var($d["u"], FILTER_VALIDATE_EMAIL)?Sec::sanitizeEmail($d["u"]):"";
		$this->loginUsername = ($this->loginEmail === "")?Sec::sanitize($d["u"]):"";
		$this->loginPassword = Sec::sanitize($d['p']);
		if($this->loginUsername !== "" && !$this->user->userExistsByName($this->loginUsername)){
			$this->loginErrors[] = "We don't have an account with that name.";
		} else if($this->loginEmail !== "" && !$this->user->userExistsByEmail($this->loginEmail)){
			$this->loginErrors[] = "We don't have an account with that email.";
		}
		return ( \count($this->loginErrors) == 0 );
	}
}