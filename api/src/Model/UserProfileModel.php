<?php

namespace Model;

use Model\Model;

class UserProfileModel extends Model
{
	protected $controllers = [
		"User\UserProfile"
	];
    public function __construct($app)
    {
		parent::__construct($app);
	}
	
    public function getModelData():array {
        return [
            "userprofile","id",
            [
                "id"=>"VARCHAR(36) NOT NULL",
                "userId"=>"VARCHAR(36) NOT NULL",
                "profilePicSrc"=>"VARCHAR(255) NOT NULL",
                "title"=>"VARCHAR(50) NOT NULL",
                "location"=>"VARCHAR(80) NOT NULL",
                "joinedDate"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
                "headline"=>"VARCHAR(255) NOT NULL",
                "bio"=>"TEXT NOT NULL",
                "public"=>"TINYINT"
            ],
            [
                "userId"=>"`user`(`id`)"
            ]
        ];
	}

	public function getUserProfileByUserId($id){
        return $this->app->db->gbi(['*'],['userId'=>$id],'userprofile');
	}

	public function getUserProfileById($id){
        return $this->app->db->gbi(['*'],['id'=>$id],'userprofile');
    }

	public function updateProfilePicSrcByUserId($profilePicSrc, $userId) {
		return $this->app->db->ubi(["profilePicSrc"=>$profilePicSrc], ["userId"=>$userId], $this->getModelData()[0]);
	}
	
	public function getProfilePicSrcByUserId($userId) {
		return $this->app->db->gbi(
			"profilePicSrc", 
			["userId"=>$userId], 
			$this->getModelData()[0]
		)[0]["profilePicSrc"];
	}
}