<?php   

namespace Model;

class AvailableTime extends ActiveRecord {
    protected static $columns = ["id", "time"];
    protected static $tableName = "availabletimes";
    public $id;
    public $time;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->time = $args["time"] ?? "";
    }
}