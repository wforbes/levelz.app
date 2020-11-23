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
			$this->connection = 
				new \PDO("mysql:host=$this->host;dbname=$this->dbName;",
					$this->dbUser,
					$this->dbPass
				);
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

	//name: thisExists
	//params: m-model, f-field, v-value
	//desc: Checks to see if this value exists in this field on this model's table
	//	IMPORTANT: if the $f and $v params is an array it checks with AND's in the where clause
	//	forms a sql statement like: "SELECT EXISTS(SELECT * from <model> where <field>=? AND <field>=? LIMIT 1);
	//	!! Doesn't detect if duplicates exist
	//return: true if value only exists once
	public function thisExists($m, $f, $v):bool {
		$s = "SELECT EXISTS(SELECT * from `$m` where ";
		if(\is_array($f)) {
			foreach ($f as $a) {
				$s .= "`$a`=?";
				if ($a !== end($f)) {
					$s .= " AND ";
				} else {
					$s .= " LIMIT 1);";
				}
			}
			$stmt = $this->connection->prepare($s);
			$this->bindValues($stmt, $v);
		} else {
			$s .= "`$f`=? LIMIT 1);";
			$stmt = $this->connection->prepare($s);
			$stmt->bindParam(1,$v);
		}
		
		//$stmt = $this->connection->prepare("SELECT EXISTS(SELECT * from `$m` where `$f`=? LIMIT 1);");
		
		$stmt->execute();
		$result = $stmt->fetchAll();
		return ( $result[0][0] === "1");
	}
	
	//name: insertNew
	//params: m-model, f-field, v-values
	//desc: Creates a MySQL insert statement to insert data into
	//	the table specified by model param, an array of fields, 
	//	and an array of values
	public function insertNew($m, $f, $v){
		$s = "INSERT INTO ";
		$s .= "`$m` (";
		if (!\is_array($f)) {
			$s.=(string)$f." ";
		} else {
			foreach ($f as $a) {
				$s .= $a;
				if ($a !== end($f)) {
					$s .= ", ";
				} else {
					$s .= ") ";
				}
			}
		}
		$s .= "VALUES (";

		foreach($f as $field){
			$s .= "?";
			if ($field !== end($f)) {
				$s .= ", ";
			} else {
				$s .= ");";
			}
		}

		$stmt = $this->connection->prepare($s);
		$this->bindValues($stmt, $v);
		return $stmt->execute();
	}
	private function bindValues($statement,$values){
		$i=1;
		foreach($values as &$param){
			$statement->bindParam($i,$param);
			$i++;
		}
	}

	//name: GBI (Get these, By that, In there)
	//params: These, That, There
	//desc: creates a sql string, prepares a pdo:statement, pdo:bindParams and pdo:executes; returns a fetchAll array
	public function gbi($these, $that, $there){
		$s = "SELECT ";
		if(!is_array($these)) {
			$s.=(string)$these." ";
		}else {
			foreach ($these as $a) {
				$s .= $a;
				if ($a !== end($these)) {
					$s .= ", ";
				} else {
					$s .= " ";
				}
			}
		}
		$s.= "FROM `".$there."` WHERE ";
		$i=0;
		$params = [];
		foreach($that as $b=>$c){
			$s .= "$b = ?";
			if($i === count($that)){
				$s.=" AND ";
			}else{
				$s .= ";";
			}
			$params[] = $c;
			$i++;
		}
		$stmt = $this->connection->prepare($s);
		$paramCount = count($params);
		for($i=0;$i<$paramCount;$i++) {
			$pi = $i + 1;
			$param = $params[$i];
			$stmt->bindParam($pi, $param);
		}
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	//name: UBI (Update these, By that, In there)
	//desc: updates fields specified by key/values in 'These' param
	//	where fields specified by key/values in "That" exist
	//	on the table specified by "There"
	//return: boolean of success/fail
	public function ubi($these, $that, $there) {
		$s = "UPDATE ";
		$s .= $there." SET ";
		if (!is_array($these)) {
			$s.=(string)$these." ";
		} else {
			foreach ($these as $f=>$v) {
				$s .= $f."=:".$f."";
				if ($f !== key(array_slice($these, -1, 1, true))) {
					$s .= ", ";
				}
			}
		}
		$s.= " WHERE ";
		foreach($that as $f=>$v) {
			$s .= $f."=:".$f;
			if ($f !== key(array_slice($that, -1, 1, true))) {
				$s .= " AND ";
			} else {
				$s .= " ";
			}
		}
		$s.=";";
		$data = array_merge($these, $that);
		$result = $this->connection->prepare($s)->execute($data);
		return $result;
	}

	public function showTables() {
		$s = "SHOW TABLES;";
		$statement = $this->connection->prepare($s);
		$statement->execute();
		$tables = $statement->fetchAll(\PDO::FETCH_NUM);
		/*
		foreach($tables as $table) {
			for($i = 0; i < count($table); $i++) {
				echo $table[i]." ";
			}
			echo " - ";
		}*/
		return $tables;
	}

	public function getAllTableData($tableName) {
		$s = "SELECT * FROM `".$tableName."`;";
		$statement = $this->connection->prepare($s);
		$statement->execute();
		$data = $statement->fetchAll(\PDO::FETCH_ASSOC);
		$hiddenTableFields = [
			"user" => "passhash"
		];
		foreach($hiddenTableFields as $t=>$f) {
			if ($tableName === $t) {
				for ($i = 0; $i < count($data); $i++) {
					if (isset($data[$i][$f])){
						$data[$i][$f] = "(hidden)";
					}// TODO: do a/b testing between isset and array_key_exists
					/*if (array_key_exists($f, $data[$i]) ) {
						$data[$i][$f] = "(hidden)";
					}*/
				}
			}
		}
		return $data;
	}
}