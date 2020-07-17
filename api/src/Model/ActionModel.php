<?php
namespace Model;

use Model\Model;

class ActionModel extends Model {
	protected $controllers = [
		"Activity\Action"
	];

	public function __construct($app) {
		parent::__construct($app);
	}

	public function getModelData():array {
        return [
            "action","id",
            [
				"id"=>"VARCHAR(36) NOT NULL",
				"activityId"=>"VARCHAR(36) NOT NULL",
				"ordinal"=>"TINYINT NOT NULL",
				"name"=>"VARCHAR(72) NOT NULL",
				"description"=>"VARCHAR(1000) NOT NULL",
                "created_ts"=>"TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP"
            ]
        ];
	}

}