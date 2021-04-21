<?php

namespace Image;

class ImageUploader {
	public function __construct($app) {
		$this->app = $app;
	}

	public function uploadUserProfilePicture() {
		$errors = [];

		$target_dir = "./storage/ProfilePictures/" . $_SESSION["d"]["userId"] . "/";
		
		if(!is_dir($target_dir)){
			mkdir($target_dir, 0755, true);
		}

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["user_profile_img"]["tmp_name"]);
		if($check === false) {
			$errors[] = "There was an issue processing your image.";
		}

		// Check file size
		// TODO: Move allowed file size to config
		if ($_FILES["user_profile_img"]["size"] > 3000000) {
			$errors[] = "Your image can't be larger than 3MB.";
		}

		// Get image's file type
		$imageFileType = strtolower(pathinfo(basename($_FILES["user_profile_img"]["name"]),PATHINFO_EXTENSION));

		// Allow certain file formats
		// TODO: Move allowed file types to config
		if($imageFileType != "jpg" 
			&& $imageFileType != "png" 
			&& $imageFileType != "jpeg"
			&& $imageFileType != "gif" 
		) {
			$errors[] = "Your image must be a JPG, JPEG, PNG, or GIF file.";
		}

		// Check if there were errors
		if (count($errors) !== 0) {
			return ["errors" => $errors];
		} else { // otherwise, try to upload file
			$imgSrc = md5(rand(0,1000));
			$imgSrc = $imgSrc . "." . $imageFileType;
			$target_file = $target_dir . $imgSrc;
			if (move_uploaded_file($_FILES["user_profile_img"]["tmp_name"], $target_file)) {
				return ["success" => [
						htmlspecialchars( basename( $_FILES["user_profile_img"]["name"]))." was uploaded successfully.", 
						$imgSrc
					]
				];
			} else {
				$errors[] = "There was an issue storing your file.";
				return ["errors" => $errors];
			}
		}
	}
}