<?php

namespace Core;

use Http\Router;
use Data\MySQL;
use Log\Logger;

class App {
	public const APP_ROOT = __DIR__."/..";
	public $logger;
	
	public function __construct() {
		$this->setup();
		$this->http = Router::route($this);
	}

	private function setup():void {
		session_start();
		$this->setDelimiter();
		$this->autoload();
		$this->initLogger();
		$this->setDatabase();
		$this->createToken();
	}

	//TODO: Can use DIRECTORY_SEPARATOR php constant instead
	private function setDelimiter():void {
		$this->dlm=(self::detectEnvironment()==='local'?'\\':'/');
	}

	public static function detectEnvironment():string {
        if(isset($_SERVER['REMOTE_ADDR']) 
			&& ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' 
				|| $_SERVER['REMOTE_ADDR'] === '::1')
		) {
            return "local";
        }
        return "remote";
    }

	private function autoload():void {
		$d = $this->dlm;
		require_once __DIR__.$d."..".$d."..".$d."vendor".$d."autoload.php";
        spl_autoload_register(function ($class_name) {
            $d = $this->dlm;
            $class_name= __DIR__.$d."..".$d.str_replace('\\', '/', $class_name);
            if(file_exists("$class_name.php")){
                require_once $class_name.".php";
                return true;
            }else{
                $this->logger->log_error("Error: Can't find file $class_name - we'll be back shortly.");
            }
            return false;
        });
	}

	private function initLogger() {
		$this->logger = new Logger();
	}

	private function setDatabase():void {
		$this->db = new MySQL($this);
		if($this->db->freshInstall || $this->db->seedRequired($this)) {
			$this->db->seedInitialData($this);
		}
	}

	//https://stackoverflow.com/questions/6287903/how-to-properly-add-cross-site-request-forgery-csrf-token-using-php
	private function createToken():void {
		if(empty($_SESSION['token'])) {
			$_SESSION['token'] = bin2hex(random_bytes(32));
		}
		$this->token = $_SESSION['token'];
	}
}