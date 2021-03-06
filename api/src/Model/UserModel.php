<?php

namespace Model;

use Model\Model;

class UserModel extends Model
{
	protected $controllers = [
		"User\User"
	];

    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "user","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "username"=>"VARCHAR(36) NOT NULL",
                "passhash"=>"VARCHAR(255) NOT NULL",
                "email"=>"VARCHAR(255) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
                "verified"=>"TINYINT"
            ]
        ];
	}

	public function userExistsByName($u){
        return $this->app->db->thisExists($this->getModelData()[0], "username", $u);
	}
	
    public function userExistsByEmail($e){
        return $this->app->db->thisExists($this->getModelData()[0], "email", $e);
	}
	
	public function getPasswordHashByUsername($u){
        return $this->app->db->gbi(['passhash'],['username'=>$u],'user');
	}
	
    public function getPasswordHashByEmail($e){
        return $this->app->db->gbi(['passhash'],['email'=>$e],'user');
	}
	
	public function getIdByUsername($u){
        return $this->app->db->gbi(['id'],['username'=>$u],'user')[0]["id"];
	}
	
    public function getIdByEmail($e){
        return $this->app->db->gbi(['id'],['email'=>$e],'user')[0]["id"];
    }

    public function getUsernameById($id){
        return $this->app->db->gbi(['username'],['id'=>$id],'user')[0]["username"];
	}
	
	public function getEmailById($id) {
		return $this->app->db->gbi(['email'],['id'=>$id],'user')[0]["email"];
	}

	public function verifyUser($userId) {
		return $this->app->db->ubi(["verified"=>1], ["id"=>$userId], $this->getModelData()[0]);
	}

	public function isVerified($userId) {
		$result = $this->app->db->gbi(["verified"], ["id" => $userId], $this->getModelData()[0]);
		return filter_var($result[0]["verified"], FILTER_VALIDATE_BOOLEAN);
	}
}