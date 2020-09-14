<?php

namespace Admin;

use Model\PermissionModel;

class Permission {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new PermissionModel($app);
	}

	public function createNewPermission($d) {
		$model = $this->model->getModelData()[0];
		$fields = array_keys($this->model->getModelData()[2]);
		$id = \Sec\Uuid::v4();
		$values = [
			$id,
			$d["ordinal"],
			$d["name"],
			$d["description"]
		];
		if ($this->app->db->insertNew($model, $fields, $values) === true) {
			return ["permissionId"=>$id];
		} else {
			return false;
		}
		/*
		$model = $this->model->getModelData()[0];
		$fields = array_keys($this->model->getModelData()[2]);
		$id = \Sec\Uuid::v4();
		$values = [$id, $o, $n, $d];
		if ($this->app->db->insertNew($model, $fields, $values) === true) {
			return ["permissionId"=>$id];
		} else {
			return false;
		}*/
	}
}