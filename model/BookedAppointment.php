<?php

namespace Model;

class BookedAppointment extends ActiveRecord {
    protected static $columns = [
        "appointmentId", "appointmentDate", "appointmentTime", "totalPrice", 
        "customerId", "customerName", "customerEmail", "customerPhone", 
        "serviceId", "serviceName", "servicePrice",
        "employeeId", "employeeName", "employeeRoleId", "employeeRoleName"
    ];
    protected static $tableName = "appointments";

    public $id;
    public $date;
    public $time;
    public $totalPrice;
    public $customerId;
    public $customerName;
    public $customerEmail;
    public $customerPhone;
    public $serviceId;
    public $serviceName;
    public $servicePrice;
    public $employeeId;
    public $employeeName;
    public $employeeRoleId;
    public $employeeRoleName;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->date = $args["date"] ?? "";
        $this->time = $args["time"] ?? "";
        $this->totalPrice = $args["totalPrice"] ?? "";
        $this->customerId = $args["customerId"] ?? "";
        $this->customerName = $args["customerName"] ?? "";
        $this->customerEmail = $args["customerEmail"] ?? "";
        $this->customerPhone = $args["customerPhone"] ?? "";
        $this->serviceId = $args["serviceId"] ?? "";
        $this->serviceName = $args["serviceName"] ?? "";
        $this->servicePrice = $args["servicePrice"] ?? "";
        $this->employeeId = $args["employeeId"] ?? "";
        $this->employeeName = $args["employeeName"] ?? "";
        $this->employeeRoleId = $args["employeeRoleId"] ?? "";
        $this->employeeRoleName = $args["employeeRoleName"] ?? "";
    }
}