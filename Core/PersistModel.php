<?php

namespace Core;

abstract class PersistModel {

    protected $db;

    public function __construct() {
        $this->db = new \PDO("mysql:host=mysql;dbname=dev_test", "root", "root");
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, TRUE);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

}
