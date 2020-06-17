<?php
// part of initial CORS check on local dev environment
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Origin: http://localhost:8080');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');
	header('Content-Length: 0');
	header('Content-Type: text/plain');
	die();
}
// allow local dev environment requests
header('Access-Control-Allow-Origin:  http://localhost:8080');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Content-Type: application/json');

require "src/Core/App.php";
$app = new Core\App();