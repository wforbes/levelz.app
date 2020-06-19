<?php

namespace Model;

abstract class Model {

	public $app;
	public $tableName;

	public function __construct($app){
		$this->app = $app;
		$modelData = $this->getModelData();
		if (\count($modelData) > 2) {
			$this->tableName = $modelData[0];
			if(!$this->app->db->tableExists($this->tableName)){
				$this->app->db->createTable($modelData[0],
					$modelData[1], $modelData[2],
					(isset($modelData[3])?($modelData[3]):([]))
				);
			}
		}
	}

	abstract protected function getModelData();
	
}