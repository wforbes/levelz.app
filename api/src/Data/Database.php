<?php

namespace Data;

class Database {
    public function __construct($app)
    {
        $this->app = $app;
	}

	public function getDatabaseTables() {
		return $this->app->db->showTables();
	}
}