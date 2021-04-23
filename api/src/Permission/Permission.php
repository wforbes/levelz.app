<?php

namespace Permission;

use Model\PermissionModel;
use Model\RolePermissionModel;

class Permission {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new PermissionModel($app);
		$this->rolePermissionModel = new RolePermissionModel($app);
	}

	public function createNewPermission($action, $object) {
		if ($this->permissionExists($action, $object)) {
			return;
		}
		$id = \Sec\UUID::v4();
		$values = [$id, $action, $object];
		$modelName = $this->model->getModelData()[0];
		$modelFields = array_keys($this->model->getModelData()[2]);
		if($this->app->db->insertNew($modelName, $modelFields, $values) === true){
			return [
				"permissionId"=>$id,
				"action"=>$action,
				"object"=>$object
			];
		} else {
			return false;
		}
	}

	public function permissionExists($action, $object) {
		return $this->model->permissionExists($action, $object);
	}

	public function setRolePermission($roleId, $permissionId) {
		$this->rolePermissionModel->setRolePermission($roleId, $permissionId);
	}

	public function getPermissionId($action, $object) {
		return $this->model->getPermissionId($action, $object);
	}

	public function roleHasPermission($roleId, $permissionId) {
		return $this->rolePermissionModel->roleHasPermission($roleId, $permissionId);
	}
}