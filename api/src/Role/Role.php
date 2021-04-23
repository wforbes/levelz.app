<?php

namespace Role;

use Model\RoleModel;
use Model\UserRoleModel;

class Role {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new RoleModel($app);
		$this->userRoleModel = new UserRoleModel($app);
	}

	public function createNewRole($name, $level) {
		if($this->roleExistsByName($name)) {
			return;
		}
		$id = \Sec\UUID::v4();
		$values = [$id, $name, $level];
		$modelName = $this->model->getModelData()[0];
		$modelFields = array_keys($this->model->getModelData()[2]);
		if($this->app->db->insertNew($modelName, $modelFields, $values) === true){
			return [
				"roleId"=>$id,
				"name"=>$name,
				"level"=>$level
			];
		} else {
			return false;
		}
	}

	public function roleExistsByName($name) {
		return $this->app->db->thisExists($this->model->getModelData()[0], "name", $name);
	}

	public function getRoleIdByName($name) {
		return $this->model->getRoleIdByName($name);
	}

	public function setUserRole($userId, $roleId) {
		$this->userRoleModel->setUserRole($userId, $roleId);
	}

	public function getUserRoleByUserId($d) {
		if (\is_array($d) && isset($d["userId"])) {
			return $this->userRoleModel->getUserRoleByUserId($d["userId"]);
		}
		return $this->userRoleModel->getUserRoleByUserId($d);
	}

	//	Notes:
	//	Roles have a name and level, as level increases the seniority and access decreases
	//		Wizard - someone who can do literally anything and might break stuff
	//		Developer - someone who codes the app and should have very wide access
	//		Moderator - someone who moderates content on the app and should have elevated access 
	//		User - an average user on the app and should have limited access
	//		Deactivated - an average user who has had their account temporarily or permanently deactivated
	//		Banned - a user who should not have access to the app
}