<?php

namespace Core;

class App {
	public function __construct() {
		$this->setup();
		$this->http = Router::route($this);
	}

	public function setup():void {
		session_start();
		$this->setDelimiter();
		$this->autoload();
	}

	public function setDelimiter() {
		$this->dlm=(self::detectEnvironment()==='local'?'\\':'/');
	}

	public static function detectEnvironment():string {
        if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
            return "local";
        }
        return "remote";
    }

	public function autoload():void {
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
}