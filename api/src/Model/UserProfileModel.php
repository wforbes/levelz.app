<?php

namespace Model;

use Model\Model;

class UserProfileModel extends Model
{
	
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

	public function getProfileByUserId($id){
        return $this->app->db->gbi(['*'],['userId'=>$id],'userprofile');
    }
}