<?php

namespace Controller;

use Model\ActiveRecord;
use MVC\Router;
use Model\Role;
use Model\Employee;
use Model\User;
use Model\BookedAppointment;

class EmployeeController {
    public static function agenda(Router $router) {
        session_start();

        isType("employee");

        $id = $_SESSION["id"];
        $name = $_SESSION["name"] . " " . $_SESSION["lastname"];
        $employeeId = $_SESSION["employeeId"];

        // $query = '
        //     SELECT 
        //         appointments.id, 
        //         appointments.date,
        //         availabletimes.time,
        //         appointments.totalPrice as totalPrice,
        //         customer.id as customerId,
        //         CONCAT(customer.name, " ", customer.lastname) as customerName,
        //         customer.email as customerEmail, 
        //         customer.phone as customerPhone,
        //         services.id as serviceId,
        //         services.name as serviceName,
        //         services.price as servicePrice,
        //         employees.id as employeeId,
        //         CONCAT(employee.name, " ", employee.lastname) as employeeName,
        //         employees.roleId as employeeRoleId,
        //         roles.name as roleName
                
        //     FROM appointments

        //     LEFT JOIN users as customer ON appointments.userId = customer.id
        //     LEFT JOIN appointmentsservices ON appointmentsservices.appointmentId = appointments.id
        //     LEFT JOIN services ON appointmentsservices.serviceId = services.id
        //     LEFT JOIN availabletimes ON appointments.timeId = availabletimes.id
        //     LEFT JOIN employees ON appointments.employeeId = employees.id
        //     LEFT JOIN users as employee ON employees.userId = employee.id
        //     LEFT JOIN roles ON employees.roleId = roles.id
            
        //     WHERE employees.id = "$employeeId";
        // ';

        // $bookedAppointments = BookedAppointment::makeQueryObject($query);

        $router->render("employee/agenda", [
            "name" => $name,
            "id" => $id,
            "employeeId" => $employeeId,
            "script" => "
                <script src=\"/build/js/helper.js\"></script>  
                <script src=\"/build/js/svg.js\"></script>  
                <script src=\"/build/js/users/employee/booked-appointments.js\"></script>
                <script src=\"/build/js/appointments.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
            "
        ]);
    }

    public static function settings(Router $router) {
        session_start();

        isType("employee");

        $id = $_SESSION["id"];
        $name = $_SESSION["name"] . " " . $_SESSION["lastname"];
        $employeeId = $_SESSION["employeeId"];

        $router->render("employee/settings", [
            "name" => $name,
            "id" => $id,
            "employeeId" => $employeeId,
            "script" => "
                <script src=\"/build/js/helper.js\"></script>  
                <script src=\"/build/js/svg.js\"></script>
            "
        ]);
    }

    public static function read(Router $router) {
        isAdmin();

        session_start();

        $roles = Role::all(1000);
        $employees = ActiveRecord::makeQueryArray(
                "SELECT
                            employees.id,
                            CONCAT(users.name, ' ', users.lastname) as fullName,
                            users.email,
                            users.phone,
                            roles.name as roleName
                        FROM employees
                        INNER JOIN users ON employees.userId = users.id
                        INNER JOIN roles ON employees.roleId = roles.id
                        ORDER BY roles.name
                        LIMIT 1000;"
        );

        $router->render("crud/employees/read", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "employees" => $employees,
            "roles" => $roles,
            "script" => "<script src=\"/build/js/table.js\"></script>"
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        
        session_start();

        $employee = new Employee;
        $roles = Role::all(1000);
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $employee->sync($_POST);

            if ($employee->save()) {
                $user = User::find($employee->userId);
                $user->type = "employee";
                $user->save();

                header("Location: /administracion/empleados");
            } else {
                $alerts = $employee->getAlerts();
            }
        }
        
        $router->render("crud/employees/create", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "employee" => $employee,
            "roles" => $roles,
            "script" => "
                <script src=\"/build/js/searchbar.js\"></script>
                <script src=\"/build/js/helper.js\"></script>
            "
        ]);
    }

    public static function update(Router $router) {
        isAdmin();
        
        session_start();

        $id = $_GET["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT))
            header("Location: /administracion/empleados");

        $employee = Employee::find($id);

        if (!$employee)
            header("Location: /administracion/empleados");

        $alerts = [];
        $roles = Role::all(1000);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $employee->sync($_POST);

            if ($employee->save()) {
                header("Location: /administracion/empleados");
            } else {
                $alerts = $employee->getAlerts();
            }
        }

        $router->render("crud/employees/update", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "roles" => $roles,
            "employee" => $employee
        ]);
    }

    public static function delete(Router $router) {
        session_start();
        
        isAdmin();
    }
}