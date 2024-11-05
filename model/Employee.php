<?php

namespace Model;

class Employee extends ActiveRecord {
    protected static $columns = ["id", "image", "userId", "roleId"];
    protected static $tableName = "employees";
    public $id;
    public $image;
    public $userId;
    public $roleId;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->image = $args["image"] ?? "default.jpg";
        $this->userId = $args["userId"] ?? "";
        $this->roleId = $args["roleId"] ?? "";
    }
}