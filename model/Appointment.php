<?php

namespace Model;

class Appointment extends ActiveRecord {
    protected static $tableName = "appointments";
    protected static $columns = ["id", "date", "totalPrice", "timeId", "userId", "employeeId"];
    public $id;
    public $date;
    public $totalPrice;
    public $timeId;
    public $userId;
    public $employeeId;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->date = $args["date"] ?? "";
        $this->totalPrice = $args["totalPrice"] ?? "";
        $this->timeId = $args["timeId"] ?? "";
        $this->userId = $args["userId"] ?? "";
        $this->employeeId = $args["employeeId"] ?? "";
    }
}