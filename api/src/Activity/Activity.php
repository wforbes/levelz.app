<?php

namespace Activity;

class Activity {
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