<?php
namespace Log;

class Logger {

	private $dir = "./storage/logs/";
	public $header;
	public $msg;

	public function __construct() {
		if(is_dir($this->dir) === false) {
			mkdir($this->dir, 0755, true);
		}
		$this->header  = "IP: ".$_SERVER["REMOTE_ADDR"]." - ".date("F j, Y, g:i a").PHP_EOL;
		$this->header .= (isset($_SESSION["d"]["userId"]))?("UserID: ".$_SESSION["d"]["userId"].PHP_EOL):("");
		$this->msg = "";
	}

	public function log_msg($s) {
		$this->msg .= $s.PHP_EOL;
	}

	public function post_log() {
		if ($this->msg !== "") {
			$this->msg .= "-------------------------".PHP_EOL;
			$log = $this->header.$this->msg;
			file_put_contents($this->dir."log_".date("j.n.Y").".log", $log, FILE_APPEND);
		}
	}

	public function log_error($s) {
		$error_msg = "ERROR: ".PHP_EOL.$s.PHP_EOL.
				"-------------------------".PHP_EOL;
		$log = $this->header.$error_msg;
		file_put_contents($this->dir."errors_".date("j.n.Y").".log", $log, FILE_APPEND);
	}
}