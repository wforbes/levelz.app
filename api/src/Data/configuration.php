<?php

include "password.php";
$c = [
    "host"=>"",
    "rootUser"=>"",
    "rootPass"=>"",
    "dbName"=>"",
    "dbUser"=>"",
    "dbPass"=>""
];
$local = function()use($pw){
    $c["host"]="localhost";
    $c["rootUser"]="root";
    $c["rootPass"]=$pw()['root'];
    $c["dbName"]="levelz";
    $c["dbUser"]='wfuser';
    $c["dbPass"]=$pw()['user'];
    return $c;
};

/*
$remote = function()use($pw){
    $c["host"]="localhost";
    $c["rootUser"]="";
    $c["rootPass"]=$pw()['root'];
    $c["dbName"]="<<REMOTE DB NAME>>";
    $c["dbUser"]='<<REMOTE DB USER>>';
    $c["dbPass"]=$pw()['user'];
    return $c;
};
*/