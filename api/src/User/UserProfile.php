<?php

namespace User;

use Model\UserProfileModel;

class UserProfile
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->model = new UserProfileModel($app);
    }

    public function createNewProfile($u){
        $id = \Sec\Uuid::v4();
        $model = $this->model->getModelData()[0];
        $values = [$id, $u, '', '' , '', '', '', 0];
        $fields = array_keys($this->model->getModelData()[2]);
        \array_splice($fields, 5, 1);
        return $this->app->db->insertNew($model, $fields, $values)?$id:false;
    }

    public function getProfileByUserId($id){
        return $this->model->getProfileByUserId($id);
    }
}