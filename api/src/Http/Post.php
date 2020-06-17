<?php

namespace Http;

use Core\App;

class Post {
	public function __construct($app)
    {
		$this->app = $app;
		Post::reply(["The server received your request, but signups aren't implemented yet!"]);

        exit();
    }

	public static function reply($s){
        echo json_encode((is_array($s))?($s):([$s]));
    }
}