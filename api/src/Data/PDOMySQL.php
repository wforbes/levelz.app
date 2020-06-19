<?php

namespace Data;

use Core\App;

class PDOMySQL {

	private $connection;
    private $host;
    private $rootUser;
    private $rootPass;
    private $dbUser;
    private $dbPass;
    private $dbName;

	public function __construct() {
		$this->setConfig();

		try {
            //first connection attempt
            $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->dbName;", $this->dbUser, $this->dbPass);
        }catch(\PDOException $ex){
			//check for database and user existence and attempt second connection
            $this->setUpDatabaseAndUser();
        }
	}

	private function setConfig():void {
		$config = Config::get(App::detectEnvironment());
		$this->host=$config["host"];
		$this->rootUser=$config["rootUser"];
		$this->rootPass=$config["rootPass"];
		$this->dbName=$config["dbName"];
		$this->dbUser=$config["dbUser"];
		$this->dbPass=$config["dbPass"];
	}

	//name: tableExists
	//desc: Calls the SHOW TABLES sql query to check 
	//	that the given table exists by name
	//params: n (table name)
	//return: boolean for tables existence
	//use: used by abstract class Model
	public function tableExists($n):bool {
        $stmt = $this->connection->query("SHOW TABLES LIKE '$n';");
        $all = $stmt->fetchAll();
        return(\count($all)!==0);
	}

	//name: createTable
    //desc: constructs the query string to create a table
    //  given its name and fields
    //params: t(table name), pk(primary key), f(fields),
	//  fk(foreign key constraints)
	//return: void
	//use: used by abstract class Model
    public function createTable($n,$pk,$f,$fk=[]):void {
        $a="CREATE TABLE IF NOT EXISTS `".$n."` (";
        $i=0;
        foreach($f as $k=>$v){
            $i++;
            $a.="`".$k."` "." ".$v;
            if($i !== \count($f)){
                $a.=", ";
            }else if($pk!==""){
                $a.=", PRIMARY KEY (`".$pk."`)";
            }
        }
        if(!empty($fk)){
            $a .=", ";
            $i = 0;
            foreach($fk as $k=>$v){
                $i++;
                $a .= "FOREIGN KEY (`".$k."`) REFERENCES ".$v;
                if($i !== \count($fk)){
                    $a .= ", ";
                }
            }
        }
        $a.=") ENGINE=InnoDB DEFAULT CHARSET=UTF8;";
        $stmt = $this->connection->query($a);
	}

	private function setUpDatabaseAndUser()
    {
        $this->attemptConnection("mysql:host=$this->host;",$this->rootUser,$this->rootPass);
        if(!$this->databaseExists($this->dbName)){
            $sql = "CREATE DATABASE IF NOT EXISTS `{$this->dbName}` CHARACTER SET utf8 COLLATE utf8_general_ci;";
        }

        if(!$this->dbUserExists($this->dbUser)){
            $sql.=  "CREATE USER '$this->dbUser'@'localhost' IDENTIFIED BY '$this->dbPass';";
        }
        $sql .= "GRANT ALL ON `$this->dbName`.* TO '$this->dbUser'@'localhost';";
        $sql .= "FLUSH PRIVILEGES;";
        $stmt = $this->connection->query($sql);
        $this->attemptConnection("mysql:host=$this->host;dbname=$this->dbName;", $this->dbUser, $this->dbPass);
        //$this->attemptConnection("mysql:host=$this->host;dbname=$this->dbName;", $this->dbUser, $this->dbPass);
	}
	private function attemptConnection($dsn,$u,$p){
        try {
            $this->connection = new \PDO($dsn, $u, $p);
        }catch(\PDOException $ex){
            return "";
        }
	}
	private function dbUserExists($user){
        $stmt = $this->connection->query("SELECT EXISTS(SELECT 1 FROM mysql.user WHERE user = '$user');");
        $all = $stmt->fetchAll();
        return($all[0][0]===$this->dbName);
    }
    public function databaseExists($n){
        $stmt = $this->connection->query("SHOW DATABASES LIKE '$n';");
        $all = $stmt->fetchAll();
        return(\count($all)!==0);
	}
}