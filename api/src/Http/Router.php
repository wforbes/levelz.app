<?php

namespace Http;

class Router
{
    public static function route($app){
        $request_method_class = "Http\\".ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        return new $request_method_class($app);
    }
}