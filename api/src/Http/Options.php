<?php

namespace Http;

use Core\App;

class Options {
	public function __construct($app)
    {
		$this->app = $app;
        exit();
    }

	public static function reply($s){
        echo json_encode((is_array($s))?($s):([$s]));
    }
}