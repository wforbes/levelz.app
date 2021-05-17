<?php

namespace Data;

use Core\App;

class MySQL {

	private $connection;
	private $host;
	private $rootUser;
	private $rootPass;
	private $dbUser;
	private $dbPass;
	private $dbName;
	public $freshInstall = false;

	public function __construct() {
		$this->setConfig();
		try {
			//first connection attempt
			$this->attemptConnection(
				"mysql:host=$this->host;dbname=$this->dbName;",
				$this->dbUser,
				$this->dbPass
			);
		}catch(\PDOException $ex){
			//check for database and user existence
			//	create either if they don't exist
			//	then attempt second connection
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

	private function attemptConnection($dsn,$u,$p) {
		try {
			$this->connection = new \PDO($dsn, $u, $p);
		}catch(\PDOException $ex){
			throw $ex;
		}
	}

	private function setUpDatabaseAndUser() {
		try {
			$this->attemptConnection("mysql:host=$this->host;",$this->rootUser,$this->rootPass);
		} catch (\PDOException $ex) {
			exit("unable to connect to database with root");
		}

		$sql = "";

		if(!$this->databaseExists($this->dbName)){
			$this->freshInstall = true;
			$sql = "CREATE DATABASE IF NOT EXISTS `{$this->dbName}` CHARACTER SET utf8 COLLATE utf8_general_ci;";
		}

		if(!$this->dbUserExists($this->dbUser)){
			$sql.=  "CREATE USER '$this->dbUser'@'localhost' IDENTIFIED BY '$this->dbPass';";
		}

		$sql .= "GRANT ALL ON `$this->dbName`.* TO '$this->dbUser'@'localhost';";
		$sql .= "FLUSH PRIVILEGES;";
		$stmt = $this->connection->query($sql);

		try {
			$this->attemptConnection("mysql:host=$this->host;dbname=$this->dbName;", $this->dbUser, $this->dbPass);
		} catch (\PDOException $ex) {
			exit("unable to connect to database with db user");
		}
	}

	private function dbUserExists($user) {
		$stmt = $this->connection->query("SELECT EXISTS(SELECT 1 FROM mysql.user WHERE user = '$user');");
		$all = $stmt->fetchAll();
		return($all[0][0]===$this->dbName);
	}

	public function databaseExists($n){
		$stmt = $this->connection->query("SHOW DATABASES LIKE '$n';");
		$all = $stmt->fetchAll();
		return(\count($all)!==0);
	}

	public function seedRequired($app) {
		return (new DataSeeder($app))->seedRequired();
	}

	public function seedInitialData($app) {
		(new DataSeeder($app))->seedData();
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
	
	private function bindValues($statement,$values){
		$i=1;
		foreach($values as &$param){
			$statement->bindParam($i,$param);
			$i++;
		}
	}

	//name: insertNew
	//params: m-model, f-field, v-values
	//desc: Creates a MySQL insert statement to insert data into
	//	the table specified by model param, an array of fields, 
	//	and an array of their values
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
		
		$stmt->execute();
		$result = $stmt->fetchAll();
		return ( $result[0][0] === "1");
	}

	//name: GBI (Get these, By that, In there)
	//params: These, That, There
	//desc: Retrieves fields specified by their names in the 'These' param
	//	constrained by the field names and values in the "That" param
	//	on the table specified by "There"
	//return: the MySQL result array on success or boolean false on failure
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
		
		//TODO: write helper function like bindValues for key/value array of params
		$paramCount = count($params);
		for($i=0;$i<$paramCount;$i++) {
			$pi = $i + 1;
			$param = $params[$i];
			$stmt->bindValue($pi, $param);
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
		$params = [];
		$s = "UPDATE ";
		$s .= $there." SET ";
		$i = 0;
		foreach($these as $f=>$v) {
			$s .= $f . " = ?";
			if($i !== count($these)-1){
				$s .= ", ";
			}
			$params[] = $v;
			$i++;
		}
		$s.= " WHERE ";
		$i = 0;
		foreach($that as $f=>$v) {
			$s .= $f." = ?";
			if($i !== count($that)-1) {
				$s .= ", ";
			}
			$params[] = $v;
			$i++;
		}
		$stmt = $this->connection->prepare($s);
		$paramCount = count($params);
		for($i=0;$i<$paramCount;$i++) {
			$pi = $i + 1;
			$param = $params[$i];
			$stmt->bindValue($pi, $param);
		}
		$result = $stmt->execute();
		return $result;
	}

	//name: (D)elete (F)rom There (W)here That
	//desc: Deletes rows from the table specified by the 'there' param
	//	constrained by where fields/values in the 'that param
	//return: result boolean true/false
	public function dfw($there, $that) {
		$params = [];
		$sql = "DELETE FROM `$there` WHERE ";
		$i = 0;
		foreach ($that as $f=>$v) {
			$sql .= $f . " = ?";
			$sql .= ($i !== count($that)-1) ? ", " : ";";
			$params[] = $v;
			$i++;
		}
		$stmt = $this->connection->prepare($sql);
		$paramCount = count($params);
		for($i=0;$i<$paramCount;$i++) {
			$pi = $i + 1;
			$param = $params[$i];
			$stmt->bindValue($pi, $param);
		}
		$result = $stmt->execute();
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
		//TODO: place 'hidden' specification in model class
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