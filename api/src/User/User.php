<?php

namespace User;

use Model\UserModel;

class User {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new UserModel($app);
	}

	public function userExistsByName($u){
        return $this->model->userExistsByName($u);
	}
	
    public function userExistsByEmail($e){
        return $this->model->userExistsByEmail($e);
	}
	
	public function createNewUser($u,$p,$e){
        $id = \Sec\Uuid::v4();
        $passhash = \Sec\Sec::getPasswordHash($p);
        $values = [$id,$u,$passhash,$e,0];
        $model = $this->model->getModelData()[0];
        $fields = array_keys($this->model->getModelData()[2]);
		\array_splice($fields, 4, 1);
		if ($this->app->db->insertNew($model, $fields, $values) === true) {
			$userProfileId = (new UserProfile($this->app))->createNewProfile($id);
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
}