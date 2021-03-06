<?php

namespace Auth;

use Sec\Sec;
use User\User;
use Email\EmailController;

class SignupController {
	//signup rules and error messages
	//  username must not already be in use
	private $usernameExistsMsg = "Username is already in use";

	//  username must match min/max character requirements
	private $minUsernameLength=3;
	private $maxUsernameLength=32;
	private $usernameLengthMsg; //Message defined in helper function
	
	//  username must start with A-Za-z
	private $usernameFirstCharErrorMsg = "Username can't begin with a number";
	
	//  username can't contain spaces
	private $usernameSpaceErrorMsg = "Username can't contain spaces";
	
	// username can't contain symbols except period or underscore
	private $usernameContainSymbolsErrorMsg = "Username can't contain any symbols except . or _";
	
	// password must match min/max character requirements
	private $minPasswordLength=6;
	private $maxPasswordLength=255;
	private $passwordLengthMsg; //Message defined in helper function

	//  password must contain at least one A-Z,a-z,0-9 and one symbol like:
	//      ( ) ` ~ ! @ # $ % ^ & * - + = | \ { } [ ] : ; " ' < > , . ? /
	private $passwordContainUpperErrorMsg = "Password must contain at least 1 symbol";
	private $passwordContainSymbolErrorMsg = "Password must contain at least 1 (A-Z)";
	private $passwordContainLowerErrorMsg = "Password must contain at least 1 (a-z)";
	private $passwordContainNumberErrorMsg = "Password must contain at least 1 (0-9)";
	//  passwords must match
	private $passwordsMatchMsg = "Password fields must match";
	
	//  email must match regex
	private $invalidEmailErrorMsg = "Email is not valid.";
	
	// email must not already be in use
	private $emailExistsMsg = "Email is already in use";

	private $signupErrors = [];

	public function __construct($app) {
		$this->app = $app;
		$this->setLengthMessages();
		$this->user = new User($app);
	}

	private function setLengthMessages():void {
		$this->usernameLengthMsg = "Username must be "
			.($this->minUsernameLength)." - "
			.($this->maxUsernameLength)." characters";
		$this->passwordLengthMsg = "Password must be "
			.$this->minPasswordLength." - "
			.$this->maxPasswordLength." characters";
	}

	public function submitSignup($d):array {
		$d['u'] = Sec::sanitize($d['u']);
		$d['p'] = Sec::sanitize($d['p']);
		$d['r'] = Sec::sanitize($d['r']);
		$d['e'] = Sec::sanitizeEmail($d['e']);

		if ($this->signupIsValid($d['u'],$d['p'],$d['r'],$d['e'])){
			$newUser = $_SESSION["d"] = $this->user->createNewUser($d['u'],$d['p'],$d['e']);
			(new EmailController($this->app))->sendConfirmationEmail($newUser["userId"], $newUser["userEmail"]);
			$this->app->logger->log_msg("New user signed up: ".$d['u']);
			return [ "success"=> $newUser ];
		} else {
			$this->logSignupErrors();
			return ["errors" => $this->signupErrors];
		}
	}

	//name: signupIsValid
	//desc: takes the username, password, repeatPassword and email
	//	and runs a series of checks on them through helper functions,
	//	when a problem is found a error string is pushed to the 
	//	signupErrors array, returns true if no errors were found
	//return: boolean
	private function signupIsValid($u, $p, $r, $e):bool {
		$this->checkUsername($u);
		$this->checkPasswords($p,$r);
		$this->checkEmail($e);
		$this->signupErrors = $this->reIndexArray($this->signupErrors);
		return (\count($this->signupErrors)===0);
	}

	private function checkUsername($u):void{
		$this->signupErrors[]=$this->checkUsernameExists($u);
		$this->signupErrors[]=$this->checkUsernameLength($u);
		$this->signupErrors[]=$this->checkUsernameSpaces($u);
		$this->signupErrors[]=$this->checkUsernameFirstChar($u);
		$this->signupErrors[]=$this->checkUsernameContainSymbol($u);
		$this->signupErrors = $this->clearEmptyElements($this->signupErrors);
	}
	//checkUsername helpers
	private function checkUsernameExists($u):string{
		$e = $this->user->userExistsByName($u);
		$msg = $this->usernameExistsMsg." ($u)";
		return $e?$msg:'';
	}
	private function checkUsernameLength($u):string{
		return strlen($u) < $this->maxUsernameLength 
			&& strlen($u) >= $this->minUsernameLength?'':
			$this->usernameLengthMsg;
	}
	private function checkUsernameSpaces($u):string{
		preg_match("/\s/",$u,$matches);
		return(isset($matches[0])&&$matches[0]===' ')?
			($this->usernameSpaceErrorMsg):
			("");
	}
	private function checkUsernameFirstChar($u):string{
		return is_numeric(substr($u,0,1))?$this->usernameFirstCharErrorMsg:'';
	}
	private function checkUsernameContainSymbol($p):string{
		preg_match("/[^a-zA-Z\d._]/",$p,$matches);
		return (isset($matches[0])?$this->usernameContainSymbolsErrorMsg:'');
	}
	//end checkUsername helpers

	private function checkPasswords($p,$r):void{
		$this->signupErrors[]=$this->checkPasswordLength($p);
		$this->signupErrors[]=$this->checkPasswordContainUpper($p);
		$this->signupErrors[]=$this->checkPasswordContainLower($p);
		$this->signupErrors[]=$this->checkPasswordContainNumber($p);
		$this->signupErrors[]=$this->checkPasswordContainSymbol($p);
		$this->signupErrors[]=$this->checkPasswordsMatch($p,$r);
		$this->signupErrors = $this->clearEmptyElements($this->signupErrors);
	}
	//checkPasswords helpers
	private function checkPasswordLength($p):string{
		return \strlen($p) < $this->maxPasswordLength && \strlen($p) >= $this->minPasswordLength ? '':
			$this->passwordLengthMsg;
	}
	private function checkPasswordContainUpper($p):string{
		preg_match("/^(?=.*[A-Z]).+$/",$p,$matches);
		return isset($matches[0])?'':$this->passwordContainUpperErrorMsg;
	}
	private function checkPasswordContainLower($p):string{
		preg_match("/^(?=.*[a-z]).+$/",$p,$matches);
		return isset($matches[0])?(''):($this->passwordContainLowerErrorMsg);
	}
	private function checkPasswordContainNumber($p):string{
		preg_match("/^(?=.*[0-9]).+$/",$p,$matches);
		return isset($matches[0])? '':$this->passwordContainNumberErrorMsg;
	}
	private function checkPasswordContainSymbol($p):string{
		preg_match("/[^a-zA-Z\d]/",$p,$matches);
		return isset($matches[0])?'':$this->passwordContainSymbolErrorMsg;
	}
	private function checkPasswordsMatch($p,$r):string{
		return ($p===$r)?'':$this->passwordsMatchMsg;
	}
	//end checkPasswords helpers

	private function checkEmail($e):void{
		$this->signupErrors[]=$this->checkEmailExists($e);
		$this->signupErrors[]=$this->checkEmailStructure($e);
		$this->signupErrors = $this->clearEmptyElements($this->signupErrors);
	}
	//checkEmail helpers
	private function checkEmailStructure($e):string{
		return filter_var($e, FILTER_VALIDATE_EMAIL) ? "" : $this->invalidEmailErrorMsg;
	}

	private function checkEmailExists($e):string{
		$msg = $this->emailExistsMsg." ($e)";
		return $this->user->userExistsByEmail($e)?$msg:"";
	}
	//end checkEmail helpers

	private function logSignupErrors() {
		$error_log = "Sign up errors (server-side): ".PHP_EOL;
		foreach($this->signupErrors as $msg) {
			$error_log .= $msg.PHP_EOL;
		}
		$this->app->logger->log_error($error_log);
	}

	//Frontend @ src/auth/components/VerifyView.vue
	//Name: verifyEmailAddress
	//Params: email, hash
	//Desc: Takes the email and hash data created at signup
	//	and verifies that they're correct in the Email lib,
	//	then sets the User associated with them as being Verified
	public function verifyEmailAddress($d) {
		$d['email'] = Sec::sanitize($d['email']);
		$d['hash'] = Sec::sanitize($d['hash']);
		$userId = (new EmailController($this->app))->verifyEmailAddress($d["email"], $d["hash"]);
		if (isset($userId)) {
			if($this->user->isVerified($userId)){
				return ["errors" => [[ "code"=> 1, "message" => "This email was already verified"]]];
			} else {
				$result = $this->user->verifyUser($userId);
				return [ "success" => $result ];
			}
		} else {
			return [ "errors" => [["code"=> 0, "message"=>"We couldn't find record of that verification email"]]];
		}
	}

	//name: clearEmptyElements
	//desc: filters out the elements in a given array that are empty strings
	//	and returns the filtered array
	private function clearEmptyElements($a):array{
		return array_filter($a, static function($value) { return $value !== ''; });
	}
	
	//name: reIndexArray
	//desc: 
	private function reIndexArray($a):array{
		$b = [];
		foreach($a as $i){
			$b[] = $i;
		}
		return $b;
	}
}