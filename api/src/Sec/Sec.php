<?php

namespace Sec;

class Sec
{
    public static function getPasswordHash($p){
        return password_hash($p, PASSWORD_BCRYPT,['cost'=>12]);
    }

    public static function sanitize($s){
        return filter_var($s, FILTER_SANITIZE_STRING);
	}
	
    public static function sanitizeEmail($s){
        return filter_var($s, FILTER_SANITIZE_EMAIL);
    }
}