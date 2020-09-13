<?php

namespace Core;

use Http\Router;
use Data\PDOMySQL;

class App {
	public const APP_ROOT = __DIR__."/..";
	
	public function __construct() {
		$this->setup();
		$this->http = Router::route($this);
	}

	private function setup():void {
		session_start();
		$this->setDelimiter();
		$this->autoload();
		$this->setDatabase();
		$this->createToken();
	}

	private function setDelimiter():void {
		$this->dlm=(self::detectEnvironment()==='local'?'\\':'/');
	}

	public static function detectEnvironment():string {
        if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
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
                echo "Error: Can't find file $class_name - we'll be back shortly.";
            }
            return false;
        });
	}

	private function setDatabase():void {
		$this->db = new PDOMySQL($this);
	}

	//https://stackoverflow.com/questions/6287903/how-to-properly-add-cross-site-request-forgery-csrf-token-using-php
	private function createToken():void {
		if(empty($_SESSION['token'])) {
			$_SESSION['token'] = bin2hex(random_bytes(32));
		}
		$this->token = $_SESSION['token'];
	}
}