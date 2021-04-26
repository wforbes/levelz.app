<?php

namespace User;

use Model\UserProfileModel;
use Image\ImageUploader;

class UserProfile
{
    public function __construct($app)
    {
        $this->app = $app;
		$this->profilePicturesPath = "storage/ProfilePictures";
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

	//TODO: change this to use session userId
	public function getUserProfilePicUrlByUserId($userId) {
		$profilePicSrc = $this->model->getProfilePicSrcByUserId($userId);
		$url = "storage/ProfilePictures/".$userId."/". $profilePicSrc;
		return $url;
	}

	public function getAllUserProfilePictures() {
		if (!isset($_SESSION["d"]["userId"])) {
			return ["errors" => ["Not currently logged in"]];
		}

		$userId = $_SESSION["d"]["userId"];
		$path = "./".$this->profilePicturesPath."/".$userId;

		if (!is_dir($path)) {
			return ["errors" => ["No pictures found"]];
		}

		//TODO: change urls to fileNames
		$urls = array_values(
			array_diff(
				scandir($path),
				array('.', '..')
			)
		);

		for ($i = 0; $i < count($urls); $i++) {
			$urls[$i] = substr($path, 2)."/".$urls[$i];
		}

		return ["success" => $urls];
	}

	public function updateDefaultUserProfilePic($d) {
		// if passed an empty string, array, or if user isn't logged in, return
		if ($d === "" || \is_array($d) || !isset($_SESSION["d"]["userId"])) return;
		$d = \Sec\Sec::sanitizeFileName($d);
		$userId = $_SESSION["d"]["userId"];
		$fileName = $d;
		$path = "./".$this->profilePicturesPath."/".$userId;
		
		// if this filename isn't in storage, return
		if (!in_array($fileName, array_values(
			array_diff(
				scandir($path),
				array('.', '..')
			)
		))) return;

		// if it's already the default, return
		if ($fileName === $this->model->getProfilePicSrcByUserId($userId)) return;
		
		if ($this->model->updateProfilePicSrcByUserId($fileName, $userId)){
			return ["success" => ["newDefaultPath" => substr($path, 2)."/".$fileName]];
		}
		return ["errors" => ["There was a problem updating your profile image"]];
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