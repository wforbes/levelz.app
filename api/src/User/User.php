<?php

namespace User;

use Model\UserModel;
use Sec\Uuid;
use Sec\Sec;
use Permission\Permission;
use Role\Role;

class User {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new UserModel($app);
	}

	//TODO: add protection to ensure this is only called by auth signup function
	public function createNewUser($u,$p,$e){
        $id = Uuid::v4();
        $passhash = Sec::getPasswordHash($p);
        $values = [$id,$u,$passhash,$e,0];
        $model = $this->model->getModelData()[0];
        $fields = array_keys($this->model->getModelData()[2]);
		\array_splice($fields, 4, 1);
		if ($this->app->db->insertNew($model, $fields, $values) === true) {
			$userProfileId = (new UserProfile($this->app))->createNewProfile($id);
			$role = new \Role\Role($this->app);
			$roleId = $role->getRoleIdByName("user");
			$role->setUserRole($id, $roleId);
			return [ 
				"userId"=>$id, 
				"username"=>$u, 
				"userEmail"=>$e, 
				"userProfileId"=>$userProfileId 
			];
		} else {
			return false;
		}
	}

	public function userExistsByName($u){
        return $this->model->userExistsByName($u);
	}
	
    public function userExistsByEmail($e){
        return $this->model->userExistsByEmail($e);
	}
	
	public function getPasswordHashByUsername($u){
        return $this->model->getPasswordHashByUsername($u);
	}
	
    public function getPasswordHashByEmail($u){
        return $this->model->getPasswordHashByEmail($u);
	}
	
	public function getIdByUsername($u){
        return $this->model->getIdByUsername($u);
	}
	
    public function getIdByEmail($u){
        return $this->model->getIdByEmail($u);
    }

    public function getUsernameById($id) {
        return $this->model->getUsernameById($id);
	}

	public function getEmailById($id) {
		return $this->model->getEmailById($id);
	}
	
	public function verifyUser($userId) {
		return $this->model->verifyUser($userId);
	}

	public function isVerified($userId) {
		return $this->model->isVerified($userId);
	}

	public function userHasPermission($d) {
		$permission = new Permission($this->app);
		$permissionId = $permission->getPermissionId($d["action"], $d["object"]);
		if (isset($permissionId)) {
			$role = new Role($this->app);
			$userRole = $role->getUserRoleByUserId($_SESSION['d']['userId']);
			if (count($userRole) == 1) {
				$hasPermission = $permission->roleHasPermission($userRole[0]["roleId"], $permissionId);
				if(isset($hasPermission)) {
					return $hasPermission;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
}