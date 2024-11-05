<?php

namespace Model;

class Role extends ActiveRecord {
    protected static $columns = ["id", "name"];
    protected static $tableName = "roles";
    public $id;
    public $name;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
    }

    public function validate() : bool {
        $this->alerts = [];

        if (strlen($this->name) < 2 || strlen($this->name) > 60) {
            $this->alerts["error"][] = NAME_ERROR;
        }

        return empty($this->alerts);
    }
}