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
			$_SESSION["d"] = ["userId"=>$id, "userProfileId"=>$userProfileId];
			return $id;
		} else {
			return false;
		}
    }
}