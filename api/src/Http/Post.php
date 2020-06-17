<?php

namespace Http;

use Core\App;

class Post {
	public function __construct($app)
    {
		$this->app = $app;
        
        if (empty($_POST["data"])) {
            //https://stackoverflow.com/questions/8893574/php-php-input-vs-post
            $body = file_get_contents("php://input");
			$json = json_decode($body, true);
			$_POST["data"] = $json["data"];
        }
        
        $post = $_POST;
        Post::reply($post);
        


        exit();
    }

	public static function reply($s){
        echo json_encode((is_array($s))?($s):([$s]));
    }
}