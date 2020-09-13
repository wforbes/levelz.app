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

	public function getAllTableData($d) {
		return $this->app->db->getAllTableData($d['tableName']);
	}
}