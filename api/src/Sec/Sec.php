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

	public static function sanitizeFileName($filename) {
		//https://stackoverflow.com/questions/2021624/string-sanitizer-for-filename
		//return mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $s);

		//https://sandbox.onlinephpfunctions.com/code/76c2b08763b47d822d6c9c204dc9e976c2582fb3
		mb_regex_encoding("UTF-8");
		$fixedfilename=mb_ereg_replace('^[\s]+|[^\P{C}]|[\\\\\/\*\:\?\"\>\<\|\%\&\=\'\;\`]+|[\s\.]+$','',$filename);
		return mb_ereg_replace('[^\w\.\-]+','_',$fixedfilename);
	}
	
    public static function sanitizeEmail($s){
        return filter_var($s, FILTER_SANITIZE_EMAIL);
    }
}