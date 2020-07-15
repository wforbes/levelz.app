<?php

namespace Activity;

use Model\ActivityModel;
use Sec\Uuid;

class Activity {
	public function __construct($app) {
		$this->app = $app;
		$this->model = new ActivityModel($app);
	}

	public function saveActivityChanges($activityData) {
		$updateData = [
			[//keys
				"id"=>$activityData["id"],
				"userId"=>$_SESSION["d"]["userId"]
			],
			[//fields
				"name"=>$activityData["name"],
				"description"=>$activityData["description"]
			]
		];
		$result = $this->model->saveActivityChanges($updateData);
		return ["success" => $result];
	}

	public function createNewActivity($newActivity) {
		$id = Uuid::v4();
		$userId = $_SESSION["d"]["userId"];
		$name = $newActivity["name"];
		$desc = $newActivity["description"];
		$activityData = [$id, $userId, $name, $desc];
		$result = $this->model->createNewActivity($activityData);
		return ["success" => $result];
	}

	public function getAllMyActivities() {
		$userId = $_SESSION["d"]["userId"];
		$activities = $this->model->getActivitiesByUserId($userId);
		return [ "success" => $activities ];
	}

	public function getActivitySuggestions() {
		//TODO: Move these to the database with a ui to administrate them!
		$suggestions = [
			"Clean the House",
			"Do Home Repairs",
			"Mow the Lawn",
			"Vacuum the House",
			"Write in Journal",
			"Read a Book",
			"Study History",
			"Do Math Homework",
			"Practice Coding",
			"Do the Dishes",
			"Do the Laundry",
			"Practice Singing",
			"Practice Guitar",
			"Practice Piano",
			"Draw a Picture",
			"Paint a Painting",
			"Do Crochet project",
			"Do Knitting project",
			"Do Sewing project",
			"Call Family",
			"Go to the Gym",
			"Go for a Run",
			"Go for a Walk",
			"Practice Meditation",
			"Go Hiking",
			"Go Shopping",
		];
		return ["success"=> $suggestions ];
	}
}