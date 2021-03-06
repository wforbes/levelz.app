<?php
ob_start();
// part of initial CORS check on local dev environment
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
	header("Access-Control-Allow-Origin: https://localhost:8080");
	header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, token, Content-Type");
	header("Access-Control-Allow-Credentials: true"); //https://forum.vuejs.org/t/no-session-cookies-on-localhost-apache-with-vue-axios/84903/4
	header("Access-Control-Max-Age: 1728000");
	header("Content-Length: 0");
	header("Content-Type: text/plain");
	ob_end_flush();
	die();
}
// allow local dev environment requests
header("Access-Control-Allow-Origin: https://localhost:8080");
header("Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true"); //https://forum.vuejs.org/t/no-session-cookies-on-localhost-apache-with-vue-axios/84903/4
header("Content-Type: application/json");
ob_end_flush();