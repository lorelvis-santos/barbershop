<?php

namespace Model;

class Service extends ActiveRecord {
    // Database information.
    protected static $columns = ["id", "name", "price", "roleId"];
    protected static $tableName = "services";
    public $id;
    public $name;
    public $price;
    public $roleId;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->price = $args["price"] ?? "";
        $this->roleId = $args["roleId"] ?? "";
    }

    public function validate() : bool {
        $this->alerts = [];

        if (strlen($this->name) < 2 || strlen($this->name) > 60) {
            $this->alerts["error"][] = NAME_ERROR;
        }

        if (!is_numeric($this->price)) {
            $this->alerts["error"][] = PRICE_ERROR;
        }

        if (!is_numeric($this->roleId)) {
            $this->alerts["error"][] = ROLEID_ERROR;
        }

        return empty($this->alerts);
    }
}