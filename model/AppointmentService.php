<?php

namespace Model;

class AppointmentService extends ActiveRecord
{
    protected static $tableName = "appointmentsservices";
    protected static $columns = ["id", "appointmentId", "serviceId"];
    public $id;
    public $appointmentId;
    public $serviceId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->appointmentId = $args["appointmentId"] ?? "";
        $this->serviceId = $args["serviceId"] ?? "";
    }
}