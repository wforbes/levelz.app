<?php

namespace Data;

class Config
{
    public static function get($type){
        include "configuration.php";
        return $$type();
    }
}