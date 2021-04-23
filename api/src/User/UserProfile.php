<?php

namespace User;

use Model\UserProfileModel;
use Image\ImageUploader;

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

	public function submitUserProfilePicture($d) {
		if(!isset($_FILES["user_profile_img"])) {
			return ["errors" => ["There was a problem recieving your image."]];
		} else {
			$result = (new ImageUploader($this->app))->uploadUserProfilePicture();
			if(isset($result["success"])) {
				$profilePicSrc = $result["success"][1];
				array_pop($result["success"]); // pop imgSrc off result success array
				$this->model->updateProfilePicSrcByUserId($profilePicSrc, $_SESSION["d"]["userId"]);
				return $result;
			} else if (isset($result["errors"])) {
				return $result;
			} else {
				return ["errors" => ["There was an unknown problem with your upload, try again."]];
			}
		}
	}

	public function getUserProfilePicUrlByUserId($userId) {
		$profilePicSrc = $this->model->getProfilePicSrcByUserId($userId);
		$url = "/storage/ProfilePictures/".$userId."/". $profilePicSrc;
		return $url;
	}

    public function getUserProfileByUserId($d){
		if (\is_array($d) && isset($d["userId"])) {
			return $this->model->getUserProfileByUserId($d["userId"]);
		}
		return $this->model->getUserProfileByUserId($d);
	}

	public function getUserProfileById($d){
		if (\is_array($d) && isset($d["userProfileId"])) {
			return $this->model->getUserProfileById($d["userProfileId"]);
		}
		return $this->model->getUserProfileById($d);
    }
}