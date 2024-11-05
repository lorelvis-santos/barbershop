<?php

namespace Controller;

use Model\ActiveRecord;
use Model\Appointment;
use Model\AppointmentService;
use Model\Employee;
use Model\Role;
use Model\Service;
use Model\User;

class APIController
{
    public static function availableTimes() {
        $id = ActiveRecord::escapeString($_GET["id"]);
        $date = ActiveRecord::escapeString($_GET["date"]);

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "error" => "invalid id"
            ]);

            return false;
        }

        $query = "
            SELECT
                availabletimes.id,
                availabletimes.time
            FROM 
                availabletimes
            LEFT JOIN 
                appointments ON appointments.timeId = availabletimes.id
                AND appointments.employeeId = '$id'
                AND appointments.date = '$date'
            WHERE
                appointments.timeId IS NULL;
        ";

        $result = ActiveRecord::makeQueryArray($query);

        echo json_encode($result);
    }

    public static function employees() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            self::getEmployees();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $method = $_POST["method"] ?? null;

            switch ($method) {
                case "PUT":
                    self::putEmployees();
                    break;
    
                case "DELETE":
                    self::deleteEmployees();
                    break;
    
                default:
                    self::postEmployees();
                    break;
            }
        }
    }

    public static function getEmployees() {
        $query = "
            SELECT 
                employees.id, 
                CONCAT(users.name, ' ', users.lastname) as name,
                users.phone,
                users.email,
                roles.id as roleId,
                roles.name as role,
                employees.image 
                        
            FROM employees 
                    
            INNER JOIN users ON users.id = employees.userId 
            INNER JOIN roles ON roles.id = employees.roleId
        ";

        if (!$_GET["id"]) {
            $result = ActiveRecord::makeQueryArray($query . ";");

            echo json_encode($result);
        } else {
            $id = $_GET["id"];

            if (!filter_var($id, FILTER_VALIDATE_INT))
                return;

            $query .= "WHERE employees.id = '$id';";

            $result = ActiveRecord::makeQueryArray($query);

            echo json_encode($result[0]);
        }
    }

    public static function postEmployees() {
        echo "POST";
    }

    public static function putEmployees() {
        echo "PUT";
    }

    public static function deleteEmployees() {
        $id = $_POST["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo "invalid id provided";

            return false;
        }

        $employee = Employee::find($id);

        if ($employee === null) {
            echo "employee not found";

            return false;
        }

        if ($employee->delete()) {
            $user = User::find($employee->userId);
            $user->type = "customer";
            $user->save();
        }

        echo json_encode([
            "result" => true
        ]);
    }

    public static function roles() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            self::getRoles();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $method = $_POST["method"] ?? null;

            switch ($method) {
                case "PUT":
                    self::putRoles();
                    break;
    
                case "DELETE":
                    self::deleteRoles();
                    break;
    
                default:
                    self::postRoles();
                    break;
            }
        }
    }

    public static function getRoles() {
        $roles = Role::all(1000);

        echo json_encode($roles);
    }

    public static function postRoles() {
        echo "POST";
    }

    public static function putRoles() {
        echo "PUT";
    }

    public static function deleteRoles() {
        $id = $_POST["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo "invalid id provided";

            return false;
        }

        $role = Role::find($id);

        if ($role === null) {
            echo "role not found";

            return false;
        }

        echo json_encode([
            "result" => $role->delete()
        ]);
    }

    public static function services() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            self::getServices();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $method = $_POST["method"] ?? null;

            switch ($method) {
                case "PUT":
                    self::putServices();
                    break;
    
                case "DELETE":
                    self::deleteServices();
                    break;
    
                default:
                    self::postServices();
                    break;
            }
        }
    }

    public static function getServices() {
        $id = ActiveRecord::escapeString($_GET["id"]);

        // Verificamos que el id otorgado sea un número y no otra cosa.
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "error" => "invalid id provided"
            ]);

            return false;
        }

        // Verificar que obtengamos resultados de los servicios en base al id del empleado.
        // En caso de que no hayan, retornar error.
        // En caso de que si, retornar los servicios.
        $services = Service::where("roleId", $id);

        echo json_encode($services);
    }

    public static function postServices() {
        echo "POST";
    }

    public static function putServices() {
        echo "PUT";
    }

    public static function deleteServices() {
        $id = $_POST["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo "invalid id provided";

            return false;
        }

        $service = Service::find($id);

        if ($service === null) {
            echo "service not found";

            return false;
        }

        echo json_encode([
            "result" => $service->delete()
        ]);
    }

    public static function bookedAppointments() {
        $id = ActiveRecord::escapeString($_GET["id"]);

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "error" => "invalid id"
            ]);

            return false;
        }

        $field = ActiveRecord::escapeString($_GET["field"]);

        $allowedFields = ["employees", "customer"];

        if (!in_array($field, $allowedFields)) {
            echo "invalid field provided";

            return false;
        }

        $query = "
            SELECT 
                appointments.id, 
                appointments.date,
                availabletimes.time,
                appointments.totalPrice as totalPrice,
                customer.id as customerId,
                CONCAT(customer.name, ' ', customer.lastname) as customerName,
                customer.email as customerEmail, 
                customer.phone as customerPhone,
                services.id as serviceId,
                services.name as serviceName,
                services.price as servicePrice,
                employees.id as employeeId,
                CONCAT(employee.name, ' ', employee.lastname) as employeeName,
                employees.roleId as employeeRoleId,
                roles.name as employeeRoleName
                
            FROM appointments

            LEFT JOIN users as customer ON appointments.userId = customer.id
            LEFT JOIN appointmentsservices ON appointmentsservices.appointmentId = appointments.id
            LEFT JOIN services ON appointmentsservices.serviceId = services.id
            LEFT JOIN availabletimes ON appointments.timeId = availabletimes.id
            LEFT JOIN employees ON appointments.employeeId = employees.id
            LEFT JOIN users as employee ON employees.userId = employee.id
            LEFT JOIN roles ON employees.roleId = roles.id
            
            WHERE $field.id = '$id'

            ORDER BY appointments.date, availabletimes.time;
        ";

        $result = ActiveRecord::makeQueryArray($query);

        echo json_encode($result);
    }

    public static function appointments() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            self::getAppointments();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $method = $_POST["method"] ?? null;

            switch ($method) {
                case "PUT":
                    self::putAppointments();
                    break;
    
                case "DELETE":
                    self::deleteAppointments();
                    break;
    
                default:
                    self::postAppointments();
                    break;
            }
        }
    } 

    public static function getAppointments() {
        echo json_encode("get");
    }

    public static function postAppointments() {
        $appointment = new Appointment($_POST);

        // Verificando que se haya guardado la cita correctamente.
        // Si es así, me retornará un array con la información del resultado y la id en que
        // fue insertada la cita a la base de datos.
        $result = $appointment->save();

        // En caso de que no, salimos de la función.
        // En caso de que si, obtenemos el id de la cita guardada.
        if (!$result) {
            echo json_encode([
                "error" => "didn't insert in the database"
            ]);

            return false;
        }   

        $appointmentId = $result["id"];

        // Ya que el array de los servicios viene del estilo ["1,2,3,4,5"] lo que haremos es:
        //      1. Separar cada id de los servicios en base a la coma. El resultado si usamos el array anterior sería:
        //         ["1", "2", "3", "4", "5"]
        //      2. Recorrer el array que contiene los servicios ya separados y guardarlos en la base de
        //         datos, haciendo referencia a la cita ya registrada por el usuario. 

        // Paso 1.
        $servicesId = explode(",", $_POST["services"]);

        // Paso 2.
        foreach ($servicesId as $serviceId) {
            $appointmentService = new AppointmentService([
                "appointmentId" => $appointmentId,
                "serviceId" => $serviceId
            ]);

            $appointmentService->save();
        }

        echo json_encode([
            "result" => true
        ]);
    }

    public static function putAppointments() {
        echo json_encode("put");
    }

    public static function deleteAppointments() {
        $id = ActiveRecord::escapeString($_POST["id"]);

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "error" => "invalid id"
            ]);

            return false;
        }

        $appointment = Appointment::find($id);

        if (!$appointment)
            return false;

        return $appointment->delete();
    }

    // SEARCH.

    public static function searchEmployees() {
        $query = ActiveRecord::escapeString($_GET["query"]);

        $result = ActiveRecord::makeQueryArray("
            SELECT
                users.id,
                CONCAT(users.name, ' ', users.lastname) as data

            FROM users

            WHERE CONCAT(users.name, ' ', users.lastname)
            LIKE '%$query%' 
            AND users.type != 'employee'
            AND users.type != 'admin';
        ");

        echo json_encode($result);

        // $allowedTables = ["users"];
        // $allowedFields = ['name', 'role', 'email'];

        // Verifica que la tabla y el campo sean válidos
        // if (!in_array($table, $allowedTables) || !in_array($field, $allowedFields)) {
        //     throw new Exception("Parámetro inválido.");
        // }
    }
}