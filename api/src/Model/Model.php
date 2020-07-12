<?php

namespace Model;

abstract class Model {

	public $app;
	public $tableName;

	public function __construct($app){
		if ($this->callerIsController()) {
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
		} else {
			throw new \Exception("Unauthorized Object Instantiation");
		}
	}

	abstract protected function getModelData();
	
	protected function getModelName() {
		return $this->getModelData()[0];
	}

	protected function getModelColumns() {
		$keys = array_keys($this->getModelData()[2]);
		$columns = [];
		for ($i = 0; $i < count($keys); $i++) {
			if($keys[$i] !== "created_ts") {
				array_push($columns, $keys[$i]);
			}
		}
		return $columns;
	}

	protected function callerIsController() {
		return property_exists($this, "controllers") 
			&& \in_array($this->getCaller(), $this->controllers);
	}

	protected function getCaller() {
		return debug_backtrace()[4]["class"];
	}
}